<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\peminjam;
use App\Models\adm;
use App\Models\buku_kondisi;
use App\Models\buku_penerbit;
use App\Models\buku_status;
use App\Models\trx_pinjaman_detail_status;
use App\Models\trx_pinjaman_detail;
use App\Models\buku;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;


class landingController extends Controller
{
    public function landing()
    {
        // if ($peminjam = Auth::guard('peminjam')->user()) {
        //     return redirect()->intended('dashboard');
        // }
        // if ($adm = Auth::guard('adm')->user()) {
        //     return redirect()->intended('/adm/dashboard');
        // }
        return view('landing');
    }

    public function login()
    {
        return view('login');
    }

    public function dashboard()
    {
        $auth = Auth::guard('peminjam');
        $id = $auth->user()->id;

        $peminjaman = DB::table('trx_pinjaman_details')
            ->join('trx_pinjamans', 'trx_pinjamans.id', '=', 'trx_pinjaman_details.trx_id')
            ->join('peminjams', 'peminjams.id', '=', 'trx_pinjamans.peminjam_id')
            ->where('peminjams.id', '=', $id)
            ->get()
            ->count();

        $pengembalian = DB::table('trx_pinjaman_details')
            ->join('trx_pinjamans', 'trx_pinjamans.id', '=', 'trx_pinjaman_details.trx_id')
            ->join('peminjams', 'peminjams.id', '=', 'trx_pinjamans.peminjam_id')
            ->where('peminjams.id', '=', $id)
            ->where('trx_pinjaman_details.status_id', '=', 2)
            ->get()
            ->count();

        if (!$peminjaman) {
            $peminjaman = 0;
        }

        if (!$pengembalian) {
            $pengembalian = 0;
        }

        $daftar_buku = buku::count();
        if (!$daftar_buku) {
            $daftar_buku = 0;
        }
        $daftar_penerbit = buku_penerbit::count();
        if (!$daftar_penerbit) {
            $daftar_penerbit = 0;
        }
        return view('dashboard', compact(
            'peminjaman',
            'pengembalian',
            'daftar_buku',
            'daftar_penerbit'
        ));
    }

    public function login_auth(Request $request)
    {
        $kondisi = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $peminjam = peminjam::where('email', '=', $request->email)->first();
        if ($peminjam) {
            $pass = Hash::check($request->password, $peminjam->password);
        } else {
            $pass = null;
        }

        if ($peminjam && $pass) {
            if ($peminjam->status == '0') {
                return back()->with(['warning' => 'Menunggu Approval']);
            } else {
                $auth = Auth::guard('peminjam');
                if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard) {

                    if ($auth->attempt($request->only('email', 'password'))) {
                        $request->session()->regenerate();
                        return redirect()->intended('dashboard');
                    } else {
                        return back()->with(['error' => 'Login Gagal']);
                    }
                }
            }
        } else {
            return back()->with(['error' => 'Login Gagal']);
        }
    }

    public function register()
    {
        return view('register');
    }

    public function register_submit(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|min:3|max:80',
            'alamat' => 'required|min:5|max:100',
            'telepon' => 'required|numeric|digits_between:10,20',
            'tanggal' => 'required',
            'email' => 'required|unique:peminjams',
            'password' => 'required|min:8|max:20',
            'konfirmasi' => 'required|min:8|max:20',
            'foto' => 'file|image|max:4096'
        ]);

        if ($request->password == $request->konfirmasi) {
            if (!empty($request->foto)) {
                $validatedData['foto'] = $request->file('foto')->store('foto', ['disk' => 'public']);
                $peminjam_data = array(
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'telepon' => $request->telepon,
                    'tanggal_lahir' => $request->tanggal,
                    'email' => $request->email,
                    'password' => $request->password,
                    'foto' => $validatedData['foto'],
                    'status' => 0
                );
            } else {
                $peminjam_data = array(
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'telepon' => $request->telepon,
                    'tanggal_lahir' => $request->tanggal,
                    'email' => $request->email,
                    'password' => $request->password,
                    'status' => 0
                );
            }

            $peminjam_data['password'] = Hash::make($peminjam_data['password']);
            peminjam::create($peminjam_data);
            return redirect()->route('register')->with(['success' => 'Berhasil Register']);
        } else {
            return redirect()->route('register')->with(['error' => 'Password Dan Konfirmasi Tidak Sesuai']);
        }
    }

    public function logout(Request $request)
    {
        $auth = Auth::guard('peminjam');
        if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard) {
            $auth->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('landing');
        }
    }
}

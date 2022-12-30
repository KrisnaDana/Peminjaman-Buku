<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\peminjam;
use App\Models\buku_penerbit;
use App\Models\trx_pinjaman;
use App\Models\trx_pinjaman_detail;
use App\Models\trx_pinjaman_detail_status;
use Illuminate\Pagination\Paginator;
use App\Models\buku;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


class peminjamController extends Controller
{
    public function penerbit()
    {
        return view('penerbit');
    }

    public function profil()
    {
        $id_peminjam = Auth::guard('peminjam')->user()->id;
        $profil = peminjam::find($id_peminjam);
        return view('profil', compact('profil'));
    }

    public function profil_ubah(Request $request)
    {
        if ($request->password || $request->konfirmasi) {
            $validatedData = $request->validate([
                'nama' => 'required|min:3|max:80',
                'alamat' => 'required|min:5|max:100',
                'telepon' => 'required|numeric|digits_between:10,20',
                'tanggal' => 'required',
                'password' => 'required|min:8|max:20',
                'konfirmasi' => 'required|min:8|max:20',
                'foto' => 'file|image|max:4096'
            ]);
            if ($request->password == $request->konfirmasi) {
                $id_peminjam = Auth::guard('peminjam')->user()->id;
                $profil = peminjam::find($id_peminjam);

                $profil->nama = $request->nama;
                $profil->alamat = $request->alamat;
                $profil->telepon = $request->telepon;
                $profil->tanggal_lahir = $request->tanggal;
                $profil->password = Hash::make($request->password);
                if (!empty($request->foto)) {
                    $foto = $request->file('foto')->store('foto', ['disk' => 'public']);
                    $profil->foto = $foto;
                }
                $profil->save();
                return redirect()->route('profil')->with(['success' => 'Berhasil Ubah Profil']);
            } else {
                return redirect()->route('profil')->with(['error' => 'Password Dan Konfirmasi Tidak Sesuai']);
            }
        } else {
            $validatedData = $request->validate([
                'nama' => 'required|min:3|max:80',
                'alamat' => 'required|min:5|max:100',
                'telepon' => 'required|numeric|digits_between:10,20',
                'tanggal' => 'required',
                'foto' => 'file|image|max:4096'
            ]);

            $id_peminjam = Auth::guard('peminjam')->user()->id;
            $profil = peminjam::find($id_peminjam);

            $profil->nama = $request->nama;
            $profil->alamat = $request->alamat;
            $profil->telepon = $request->telepon;
            $profil->tanggal_lahir = $request->tanggal;
            if (!empty($request->foto)) {
                $foto = $request->file('foto')->store('foto', ['disk' => 'public']);
                $profil->foto = $foto;
            }
            $profil->save();
            return redirect()->route('profil')->with(['success' => 'Berhasil Ubah Profil']);
        }
    }

    public function daftar_penerbit()
    {
        $daftar = buku_penerbit::orderBy('penerbit')->paginate(5);
        Paginator::useBootstrap();
        // dd($daftar->daftar);
        return view('adm-daftar-penerbit', compact('daftar'));
    }

    public function daftar_buku()
    {
        $daftar = buku::orderBy('judul')->paginate(5);
        Paginator::useBootstrap();
        // dd($daftar->daftar);
        return view('adm-daftar-buku', compact('daftar'));
    }

    public function daftar_buku_detail($id)
    {
        $daftars = buku::find($id);

        return view('adm-daftar-buku-setting', compact('daftars'))->with('detail', 'detail');
    }

    public function peminjaman()
    {
        $id_peminjam = Auth::guard('peminjam')->user()->id;
        $daftar = DB::table('trx_pinjaman_details')
            ->select('judul', 'penerbit', 'tanggal', 'bukus.id as id')
            ->join('trx_pinjamans', 'trx_pinjaman_details.trx_id', '=', 'trx_pinjamans.id')
            ->join('peminjams', 'peminjams.id', '=', 'trx_pinjamans.peminjam_id')
            ->join('bukus', 'bukus.id', '=', 'trx_pinjaman_details.buku_id')
            ->join('buku_penerbits', 'buku_penerbits.id', '=', 'bukus.penerbit_id')
            ->where('peminjams.id', '=', $id_peminjam)
            ->orderBy('trx_pinjaman_details.id', 'DESC')
            ->paginate(5);

        Paginator::useBootstrap();

        return view('peminjaman', compact('daftar'))->with('detail', 'detail');
    }

    public function peminjaman_buku($id)
    {
        $daftars = buku::find($id);

        return view('peminjaman', compact('daftars'))->with('buku', 'buku');
    }

    public function pengembalian()
    {
        $id_peminjam = Auth::guard('peminjam')->user()->id;
        $daftar = DB::table('trx_pinjaman_details')
            ->select('judul', 'penerbit', 'tanggal', 'kembali', 'bukus.id as id')
            ->join('trx_pinjamans', 'trx_pinjaman_details.trx_id', '=', 'trx_pinjamans.id')
            ->join('peminjams', 'peminjams.id', '=', 'trx_pinjamans.peminjam_id')
            ->join('bukus', 'bukus.id', '=', 'trx_pinjaman_details.buku_id')
            ->join('buku_penerbits', 'buku_penerbits.id', '=', 'bukus.penerbit_id')
            ->where('peminjams.id', '=', $id_peminjam)
            ->where('trx_pinjaman_details.status_id', '=', 2)
            ->orderBy('trx_pinjaman_details.id', 'DESC')
            ->paginate(5);

        Paginator::useBootstrap();

        return view('pengembalian', compact('daftar'))->with('detail', 'detail');
    }

    public function pengembalian_buku($id)
    {
        $daftars = buku::find($id);

        return view('pengembalian', compact('daftars'))->with('buku', 'buku');
    }
}

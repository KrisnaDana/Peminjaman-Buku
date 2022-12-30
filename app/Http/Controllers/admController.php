<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\adm;
use App\Models\buku_kondisi;
use App\Models\buku_penerbit;
use App\Models\buku_status;
use App\Models\trx_pinjaman_detail_status;
use App\Models\trx_pinjaman_detail;
use App\Models\trx_pinjaman;
use App\Models\buku;
use App\Models\peminjam;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class admController extends Controller
{
    public function login()
    {
        // if ($adm = Auth::guard('adm')->user()) {
        //     return redirect()->intended('/adm/dashboard');
        // }
        // if ($peminjam = Auth::guard('peminjam')->user()) {
        //     return redirect()->intended('dashboard');
        // }
        return view('adm-login');
    }

    public function login_auth(Request $request)
    {
        $kondisi = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $auth = Auth::guard('adm');
        if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard) {
            if ($auth->attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();
                return redirect()->intended('/adm/dashboard');
            } else {
                return back()->with(['error' => 'Login Gagal']);
            }
        }
    }

    public function dashboard()
    {
        $kelola_akun = peminjam::count();
        if (!$kelola_akun) {
            $kelola_akun = 0;
        }
        $daftar_pinjaman = trx_pinjaman_detail::count();
        if (!$daftar_pinjaman) {
            $daftar_pinjaman = 0;
        }
        $daftar_buku = buku::count();
        if (!$daftar_buku) {
            $daftar_buku = 0;
        }
        $daftar_penerbit = buku_penerbit::count();
        if (!$daftar_penerbit) {
            $daftar_penerbit = 0;
        }
        $kondisi_buku = buku_kondisi::count();
        if (!$kondisi_buku) {
            $kondisi_buku = 0;
        }
        $status_buku = buku_status::count();
        if (!$status_buku) {
            $status_buku = 0;
        }
        $status_pinjaman = trx_pinjaman_detail_status::count();
        if (!$status_pinjaman) {
            $status_pinjaman = 0;
        }
        $register_admin = adm::count();
        if (!$register_admin) {
            $register_admin = 0;
        }
        return view('dashboard', compact(
            'kelola_akun',
            'daftar_pinjaman',
            'daftar_buku',
            'daftar_penerbit',
            'kondisi_buku',
            'status_buku',
            'status_pinjaman',
            'register_admin',
        ));
    }

    public function logout(Request $request)
    {
        $auth = Auth::guard('adm');
        if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard) {
            $auth->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('adm-login');
        }
    }

    public function profil()
    {
        $id_adm = Auth::guard('adm')->user()->id;
        $profil = adm::find($id_adm);
        return view('profil', compact('profil'));
    }

    public function profil_ubah(Request $request)
    {
        if ($request->password || $request->konfirmasi) {
            $id_adm = Auth::guard('adm')->user()->id;
            $profil = adm::find($id_adm);

            $validatedData = $request->validate([
                'email' => 'required',
                'password' => 'required|min:8|max:20',
                'konfirmasi' => 'required|min:8|max:20'
            ]);
            if ($request->password == $request->konfirmasi) {

                $profil->email = $request->email;
                $profil->password = Hash::make($request->password);

                $profil->save();
                return redirect()->route('adm-profil')->with(['success' => 'Berhasil Ubah Profil']);
            } else {
                return redirect()->route('adm-profil')->with(['error' => 'Password Dan Konfirmasi Tidak Sesuai']);
            }
        } else {
            $validatedData = $request->validate([
                'email' => 'required'
            ]);

            $id_adm = Auth::guard('adm')->user()->id;
            $profil = adm::find($id_adm);

            $profil->email = $request->email;

            $profil->save();
            return redirect()->route('adm-profil')->with(['success' => 'Berhasil Ubah Profil']);
        }
    }

    public function register_admin()
    {
        return view('adm-register-admin');
    }

    public function register_admin_submit(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:adms',
            'password' => 'required|min:8|max:20',
            'konfirmasi' => 'required|min:8|max:20'
        ]);

        if ($request->password == $request->konfirmasi) {
            $admin_data = array(
                'email' => $request->email,
                'password' => $request->password
            );

            $admin_data['password'] = Hash::make($admin_data['password']);
            adm::create($admin_data);
            return redirect()->route('adm-register-admin')->with(['success' => 'Berhasil Register']);
        } else {
            return redirect()->route('adm-register-admin')->with(['error' => 'Password Dan Konfirmasi Tidak Sesuai']);
        }
    }

    public function kondisi_buku()
    {
        $kondisi = buku_kondisi::orderBy('kondisi')->paginate(5);
        Paginator::useBootstrap();
        // dd($kondisi->kondisi);
        return view('adm-kondisi-buku', compact('kondisi'));
    }

    public function kondisi_buku_hapus($id)
    {
        $kondisi = buku_kondisi::find($id);

        $detail = buku::where('kondisi_id', '=', $id)->get();

        if (count($detail) > 0) {
            return redirect()->route('adm-kondisi-buku')->with(['error' => 'Tidak dapat dihapus']);
        } else {
            $kondisi->delete();
            return redirect()->route('adm-kondisi-buku');
        }

        return redirect()->route('adm-kondisi-buku');
    }

    public function kondisi_buku_tambah()
    {
        return view('adm-kondisi-buku-setting')->with('tambah', 'tambah');
    }

    public function kondisi_buku_tambah_submit(Request $request)
    {
        $validatedData = $request->validate([
            'kondisi' => 'required|max:20'
        ]);

        $tambah = array(
            'kondisi' => $request->kondisi
        );

        buku_kondisi::create($tambah);
        return redirect()->route('adm-kondisi-buku');
    }

    public function kondisi_buku_ubah($id)
    {
        $kondisis = buku_kondisi::find($id);
        // dd($kondisis->id);
        return view('adm-kondisi-buku-setting', compact('kondisis'))->with('ubah', 'ubah');
    }

    public function kondisi_buku_ubah_submit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kondisi' => 'required|max:20'
        ]);

        $kondisi_buku = buku_kondisi::find($id);

        $kondisi_buku->kondisi = $request->kondisi;
        $kondisi_buku->save();
        return redirect()->route('adm-kondisi-buku');
    }

    public function status_buku()
    {
        $status = buku_status::orderBy('status')->paginate(5);
        Paginator::useBootstrap();
        // dd($status->status);
        return view('adm-status-buku', compact('status'));
    }

    public function status_buku_hapus($id)
    {
        $status = buku_status::find($id);

        $detail = buku::where('status_id', '=', $id)->get();

        if (count($detail) > 0) {
            return redirect()->route('adm-status-buku')->with(['error' => 'Tidak dapat dihapus']);
        } else {
            $status->delete();
            return redirect()->route('adm-status-buku');
        }
    }

    public function status_buku_tambah()
    {
        return view('adm-status-buku-setting')->with('tambah', 'tambah');
    }

    public function status_buku_tambah_submit(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|max:20'
        ]);

        $tambah = array(
            'status' => $request->status
        );

        buku_status::create($tambah);
        return redirect()->route('adm-status-buku');
    }

    public function status_buku_ubah($id)
    {
        $statuss = buku_status::find($id);
        // dd($statuss->id);
        return view('adm-status-buku-setting', compact('statuss'))->with('ubah', 'ubah');
    }

    public function status_buku_ubah_submit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|max:20'
        ]);

        $status_buku = buku_status::find($id);

        $status_buku->status = $request->status;
        $status_buku->save();
        return redirect()->route('adm-status-buku');
    }

    // Status Pinjaman

    public function status_pinjaman()
    {
        $status = trx_pinjaman_detail_status::orderBy('status')->paginate(5);
        Paginator::useBootstrap();
        // dd($status->status);
        return view('adm-status-pinjaman', compact('status'));
    }

    public function status_pinjaman_hapus($id)
    {
        $status = trx_pinjaman_detail_status::find($id);

        $detail = trx_pinjaman_detail::where('status_id', '=', $id)->get();


        if (count($detail) > 0) {
            return redirect()->route('adm-status-pinjaman')->with(['error' => 'Tidak dapat dihapus']);
        } else {
            $status->delete();
            return redirect()->route('adm-status-pinjaman');
        }
    }

    public function status_pinjaman_tambah()
    {
        return view('adm-status-pinjaman-setting')->with('tambah', 'tambah');
    }

    public function status_pinjaman_tambah_submit(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|max:20'
        ]);

        $tambah = array(
            'status' => $request->status
        );

        trx_pinjaman_detail_status::create($tambah);
        return redirect()->route('adm-status-pinjaman');
    }

    public function status_pinjaman_ubah($id)
    {
        $statuss = trx_pinjaman_detail_status::find($id);
        // dd($statuss->id);
        return view('adm-status-pinjaman-setting', compact('statuss'))->with('ubah', 'ubah');
    }

    public function status_pinjaman_ubah_submit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|max:20'
        ]);

        $status_pinjaman = trx_pinjaman_detail_status::find($id);

        $status_pinjaman->status = $request->status;
        $status_pinjaman->save();
        return redirect()->route('adm-status-pinjaman');
    }

    //Daftar Penerbit

    public function daftar_penerbit()
    {
        $daftar = buku_penerbit::orderBy('penerbit')->paginate(5);
        Paginator::useBootstrap();
        // dd($daftar->daftar);
        return view('adm-daftar-penerbit', compact('daftar'));
    }

    public function daftar_penerbit_hapus($id)
    {
        $daftar = buku_penerbit::find($id);
        $detail = buku::where('penerbit_id', '=', $id)->get();

        if (count($detail) > 0) {
            return redirect()->route('adm-daftar-penerbit')->with(['error' => 'Tidak dapat dihapus']);
        } else {
            $daftar->delete();
            return redirect()->route('adm-daftar-penerbit');
        }

        if ($daftar) {
            $daftar->delete();
        }

        return redirect()->route('adm-daftar-penerbit');
    }

    public function daftar_penerbit_tambah()
    {
        return view('adm-daftar-penerbit-setting')->with('tambah', 'tambah');
    }

    public function daftar_penerbit_tambah_submit(Request $request)
    {
        $validatedData = $request->validate([
            'daftar' => 'required|max:50'
        ]);

        $tambah = array(
            'penerbit' => $request->daftar
        );

        buku_penerbit::create($tambah);
        return redirect()->route('adm-daftar-penerbit');
    }

    public function daftar_penerbit_ubah($id)
    {
        $daftars = buku_penerbit::find($id);
        // dd($daftars->id);
        return view('adm-daftar-penerbit-setting', compact('daftars'))->with('ubah', 'ubah');
    }

    public function daftar_penerbit_ubah_submit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'daftar' => 'required|max:50'
        ]);

        $daftar_penerbit = buku_penerbit::find($id);

        $daftar_penerbit->penerbit = $request->daftar;
        $daftar_penerbit->save();
        return redirect()->route('adm-daftar-penerbit');
    }

    //Daftar Penerbit

    public function daftar_buku()
    {
        $daftar = buku::orderBy('judul')->paginate(5);
        Paginator::useBootstrap();
        // dd($daftar->daftar);
        return view('adm-daftar-buku', compact('daftar'));
    }

    public function daftar_buku_hapus($id)
    {
        $daftar = buku::find($id);
        if ($daftar) {
            $daftar->delete();
        }

        return redirect()->route('adm-daftar-buku');
    }

    public function daftar_buku_tambah()
    {
        $kondisi = buku_kondisi::all();
        $penerbit = buku_penerbit::all();
        $status = buku_status::all();

        return view('adm-daftar-buku-setting', compact('kondisi', 'penerbit', 'status'))->with('tambah', 'tambah');
    }

    public function daftar_buku_tambah_submit(Request $request)
    {
        // return $request->all();
        $buku = $request->validate([
            'judul' => 'required|max:100',
            'kode' => 'required|unique:bukus|max:10',
            'deskripsi' => 'required|max:255',
            'tahun' => 'required|numeric|digits_between:4, 4',
            'pengarang' => 'required|max:100',
            'halaman' => 'required|numeric|digits_between:1, 11',
            'sampul' => 'required|image|file|max:4096'
        ]);
        $buku['sampul'] = $request->file('sampul')->store('sampul', ['disk' => 'public']);

        // dd('validate lolos');
        $tambah = array(
            'judul' => $request->judul,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi,
            'penerbit_id' => $request->penerbit,
            'tahun_terbit' => $request->tahun,
            'pengarang' => $request->pengarang,
            'jumlah_halaman' => $request->halaman,
            'kondisi_id' => $request->kondisi,
            'status_id' => $request->status,
            'foto_sampul' => $buku['sampul']
        );

        buku::create($tambah);
        return redirect()->route('adm-daftar-buku');
    }

    public function daftar_buku_ubah($id)
    {
        $kondisi = buku_kondisi::all();
        $penerbit = buku_penerbit::all();
        $status = buku_status::all();
        $daftars = buku::find($id);
        $pinjam = trx_pinjaman_detail::where('buku_id', '=', $id)->orderBy('id', 'DESC')->first();

        // dd($daftars->id);
        return view('adm-daftar-buku-setting', compact('daftars', 'kondisi', 'penerbit', 'status', 'pinjam'))->with('ubah', 'ubah');
    }

    public function daftar_buku_ubah_submit(Request $request, $id)
    {
        $daftar_buku = buku::find($id);
        if ($request->sampul) {
            if (strcmp($request->kode, $daftar_buku->kode) == 0) {
                $buku = $request->validate([
                    'judul' => 'required|max:100',
                    'kode' => 'required|max:10',
                    'deskripsi' => 'required|max:255',
                    'tahun' => 'required|numeric|digits_between:4, 4',
                    'pengarang' => 'required|max:100',
                    'halaman' => 'required|numeric|digits_between:1, 11',
                    'sampul' => 'required|image|file|max:4096'
                ]);
            } else {
                $buku = $request->validate([
                    'judul' => 'required|max:100',
                    'kode' => 'required|unique:bukus|max:10',
                    'deskripsi' => 'required|max:255',
                    'tahun' => 'required|numeric|digits_between:4, 4',
                    'pengarang' => 'required|max:100',
                    'halaman' => 'required|numeric|digits_between:1, 11',
                    'sampul' => 'required|image|file|max:4096'
                ]);
            }
            $buku['sampul'] = $request->file('sampul')->store('sampul', ['disk' => 'public']);
        } else {
            if (strcmp($request->kode, $daftar_buku->kode) == 0) {
                $buku = $request->validate([
                    'judul' => 'required|max:100',
                    'kode' => 'required|max:10',
                    'deskripsi' => 'required|max:255',
                    'tahun' => 'required|numeric|digits_between:4, 4',
                    'pengarang' => 'required|max:100',
                    'halaman' => 'required|numeric|digits_between:1, 11'
                ]);
            } else {
                $buku = $request->validate([
                    'judul' => 'required|max:100',
                    'kode' => 'required|unique:bukus|max:10',
                    'deskripsi' => 'required|max:255',
                    'tahun' => 'required|numeric|digits_between:4, 4',
                    'pengarang' => 'required|max:100',
                    'halaman' => 'required|numeric|digits_between:1, 11'
                ]);
            }
        }

        $daftar_buku->judul = $request->judul;
        $daftar_buku->kode = $request->kode;
        $daftar_buku->deskripsi = $request->deskripsi;
        $daftar_buku->penerbit_id = $request->penerbit;
        $daftar_buku->tahun_terbit = $request->tahun;
        $daftar_buku->pengarang = $request->pengarang;
        $daftar_buku->jumlah_halaman = $request->halaman;
        $daftar_buku->kondisi_id = $request->kondisi;
        $daftar_buku->status_id = $request->status;
        if ($request->sampul) {
            $daftar_buku->foto_sampul = $buku['sampul'];
        }

        $daftar_buku->save();
        return redirect()->route('adm-daftar-buku');
    }

    public function daftar_buku_detail($id)
    {
        $daftars = buku::find($id);

        return view('adm-daftar-buku-setting', compact('daftars'))->with('detail', 'detail');
    }

    //Daftar Pinjaman
    public function daftar_pinjaman()
    {
        $daftar = trx_pinjaman::orderBy('tanggal', 'DESC')->get();
        foreach ($daftar as $daftars) {
            $detail = trx_pinjaman_detail::where('trx_id', '=', $daftars->id)->get();
            if (count($detail) == '0' || empty($detail) || !$detail) {
                $daftars->delete();
            }
        }
        $daftar = trx_pinjaman::orderBy('id', 'DESC')->paginate(5);
        Paginator::useBootstrap();
        return view('adm-daftar-pinjaman', compact('daftar'));
    }

    public function daftar_pinjaman_hapus($id)
    {
        $daftar = trx_pinjaman::find($id);
        $buku = buku::all();

        $daftar_pinjaman_detail = trx_pinjaman_detail::where('trx_id', '=', $daftar->id);

        if ($daftar_pinjaman_detail->count() > 0) {
            return back()->with(['danger' => 'Hapus Detail Pinjaman Terlebih Dahulu']);
        } else {
            $daftar->delete();
            return back()->with(['success' => 'Berhasil Menghapus']);
        }


        return redirect()->route('adm-daftar-pinjaman');
    }

    public function daftar_pinjaman_tambah()
    {
        $daftar = peminjam::where('status', '>', 0)->paginate(5);
        Paginator::useBootstrap();
        return view('adm-daftar-pinjaman-setting', compact('daftar'))->with('tambah', 'tambah');
    }

    public function daftar_pinjaman_tambah_info($id)
    {
        $profil = peminjam::find($id);
        return view('adm-daftar-pinjaman-setting', compact('profil'))->with('info', 'info');
    }

    public function daftar_pinjaman_transaksi($id)
    {
        $waktu = Carbon::today()->toDateString();
        $tambah = array(
            'peminjam_id' => $id,
            'tanggal' => $waktu
        );
        trx_pinjaman::create($tambah);
        $trx = trx_pinjaman::where('peminjam_id', '=', $id)
            ->where('tanggal', '=', $waktu)
            ->orderBy('id', 'DESC')->first();

        $trx_id = $trx['id'];

        return redirect()->route('adm-daftar-pinjaman-detail', ['id' => $id, 'trx_id' => $trx_id]);
    }

    public function daftar_pinjaman_detail($id, $trx_id)
    {

        $daftar = trx_pinjaman_detail::where('trx_id', '=', $trx_id)->paginate(5);
        $trx = trx_pinjaman::find($trx_id);
        Paginator::useBootstrap();

        return view('adm-daftar-pinjaman-detail', compact('daftar', 'trx'))->with('detail', 'detail');
    }

    public function daftar_pinjaman_detail_info($id, $trx_id)
    {
        $daftar = trx_pinjaman_detail::where('trx_id', '=', $trx_id)->paginate(5);
        $trx = trx_pinjaman::find($trx_id);
        Paginator::useBootstrap();

        return view('adm-daftar-pinjaman-detail', compact('daftar', 'trx'))->with('info', 'info');
    }

    public function daftar_pinjaman_detail_info_buku($id, $trx_id, $buku_id)
    {
        $daftars = buku::find($buku_id);
        return view('adm-daftar-pinjaman-detail', compact('daftars', 'id', 'trx_id'))->with('buku', 'buku');
    }

    public function daftar_pinjaman_detail_dikembalikan($id)
    {
        $pinjaman = trx_pinjaman_detail::find($id);
        $pinjaman->status_id = 2;
        $pinjaman->kembali = Carbon::today()->toDateString();;
        $pinjaman->save();

        $buku = buku::find($pinjaman->buku_id);
        $buku->status_id = 1;
        $buku->save();

        return back();
    }

    public function daftar_pinjaman_detail_hapus($id)
    {
        $pinjaman = trx_pinjaman_detail::find($id);
        $pinjaman->delete();

        $buku = buku::find($pinjaman->buku_id);
        $buku->status_id = 1;
        $buku->save();

        return back();
    }

    public function daftar_pinjaman_detail_pengembalian($id, $trx_id)
    {
        $daftar = trx_pinjaman_detail::where('trx_id', '=', $trx_id)->where('status_id', '=', 2)->paginate(5);
        $trx = trx_pinjaman::find($trx_id);
        Paginator::useBootstrap();

        return view('adm-daftar-pinjaman-detail', compact('daftar', 'trx'))->with('kembali', 'kembali');
    }

    public function daftar_pinjaman_detail_pengembalian_buku($id, $trx_id, $buku_id)
    {
        $daftars = buku::find($buku_id);
        return view('adm-daftar-pinjaman-detail', compact('daftars', 'id', 'trx_id'))->with('kembali_buku', 'kembali_buku');
    }

    public function daftar_pinjaman_detail_tambah($id, $trx_id)
    {
        $daftar = buku::where('status_id', '=', 1)->orderBy('judul')->paginate(5);
        Paginator::useBootstrap();

        return view('adm-daftar-pinjaman-detail-tambah', compact('daftar', 'id', 'trx_id'))->with('tambah', 'tambah');
    }

    public function daftar_pinjaman_detail_tambah_buku($id, $trx_id, $buku_id)
    {
        $daftars = buku::find($buku_id);
        return view('adm-daftar-pinjaman-detail-tambah', compact('daftars', 'id', 'trx_id'))->with('detail', 'detail');
    }

    public function daftar_pinjaman_detail_tambah_submit($id, $trx_id, $buku_id)
    {
        $bukus = buku::find($buku_id);
        $pinjaman = array(
            'trx_id' => $trx_id,
            'buku_id' => $buku_id,
            'status_id' => 1
        );

        trx_pinjaman_detail::create($pinjaman);
        $bukus->status_id = 2;
        $bukus->save();

        return redirect()->route('adm-daftar-pinjaman-detail', ['id' => $id, 'trx_id' => $trx_id]);
    }

    public function kelola_akun()
    {
        $daftar = peminjam::orderBy('status', 'asc')->paginate(5);
        Paginator::useBootstrap();

        return view('adm-kelola-akun', compact('daftar'));
    }

    public function kelola_akun_approve($id)
    {
        $peminjam = peminjam::find($id);

        $peminjam->status = 1;
        $peminjam->save();

        return back()->with('success', 'Akun Approved');
    }

    public function kelola_akun_hapus($id)
    {
        $transaksi_detail = DB::table('trx_pinjaman_details')
            ->join('trx_pinjamans', 'trx_pinjaman_details.trx_id', '=', 'trx_pinjamans.id')
            ->join('peminjams', 'peminjams.id', '=', 'trx_pinjamans.peminjam_id')
            ->where('peminjams.id', '=', $id)
            ->get();
        $transaksi = DB::table('trx_pinjamans')
            ->join('peminjams', 'peminjams.id', '=', 'trx_pinjamans.peminjam_id')
            ->where('peminjams.id', '=', $id)
            ->get();
        if (count($transaksi) == 0 && count($transaksi_detail) == 0) {
            $peminjam = peminjam::find($id);
            $peminjam->delete();
            return back()->with('success', 'Berhasil Hapus Akun');
        } else {
            return back()->with('danger', 'Hapus Peminjaman Terlebih Dahulu');
        }
    }

    public function kelola_akun_ubah($id)
    {
        $profil = peminjam::find($id);

        return view('adm-kelola-akun-setting', compact('profil'))->with('ubah', 'ubah');
    }

    public function kelola_akun_ubah_submit(Request $request, $id)
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
                $profil = peminjam::find($id);

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
                return back()->with(['success' => 'Berhasil Ubah Profil']);
            } else {
                return back()->with(['danger' => 'Password Dan Konfirmasi Tidak Sesuai']);
            }
        } else {
            $validatedData = $request->validate([
                'nama' => 'required|min:3|max:80',
                'alamat' => 'required|min:5|max:100',
                'telepon' => 'required|numeric|digits_between:10,20',
                'tanggal' => 'required',
                'foto' => 'file|image|max:4096'
            ]);
            $profil = peminjam::find($id);

            $profil->nama = $request->nama;
            $profil->alamat = $request->alamat;
            $profil->telepon = $request->telepon;
            $profil->tanggal_lahir = $request->tanggal;
            if (!empty($request->foto)) {
                $foto = $request->file('foto')->store('foto', ['disk' => 'public']);
                $profil->foto = $foto;
            }
            $profil->save();
            return back()->with(['success' => 'Berhasil Ubah Profil']);
        }
    }

    public function kelola_akun_detail($id)
    {
        $profil = peminjam::find($id);

        return view('adm-kelola-akun-setting', compact('profil'))->with('detail', 'detail');
    }

    public function kelola_akun_tambah()
    {
        return view('adm-kelola-akun-setting')->with('tambah', 'tambah');
    }

    public function kelola_akun_tambah_submit(Request $request)
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
                    'status' => 1
                );
            } else {
                $peminjam_data = array(
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'telepon' => $request->telepon,
                    'tanggal_lahir' => $request->tanggal,
                    'email' => $request->email,
                    'password' => $request->password,
                    'status' => 1
                );
            }

            $peminjam_data['password'] = Hash::make($peminjam_data['password']);
            peminjam::create($peminjam_data);
            return back()->with(['success' => 'Berhasil Register']);
        } else {
            return back()->with(['danger' => 'Password Dan Konfirmasi Tidak Sesuai']);
        }
    }
}

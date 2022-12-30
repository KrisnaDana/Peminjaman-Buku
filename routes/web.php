<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingController;
use App\Http\Controllers\peminjamController;
use App\Http\Controllers\admController;
use App\Http\Middleware\publik;
use App\Http\Middleware\peminjam;
use App\Http\Middleware\adm;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([publik::class])->group(function () {
    Route::get('/', [landingController::class, 'landing'])->name('landing');
    Route::get('/login', [landingController::class, 'login'])->name('login');
    Route::post('/login', [landingController::class, 'login_auth'])->name('login-auth');
    Route::get('/register', [landingController::class, 'register'])->name('register');
    Route::post('/register', [landingController::class, 'register_submit'])->name('register-submit');
    Route::get('/adm', [admController::class, 'login'])->name('adm-login');
    Route::post('/adm-login-auth', [admController::class, 'login_auth'])->name('adm-login-auth');
});

Route::middleware([peminjam::class])->group(function () {
    Route::get('/dashboard', [landingController::class, 'dashboard'])->name('dashboard');
    Route::post('/', [landingController::class, 'logout'])->name('logout');
    Route::get('/profil', [peminjamController::class, 'profil'])->name('profil');
    Route::post('/profil', [peminjamController::class, 'profil_ubah'])->name('profil-ubah');
    Route::get('/daftar-penerbit', [peminjamController::class, 'daftar_penerbit'])->name('daftar-penerbit');
    Route::get('/daftar-buku', [peminjamController::class, 'daftar_buku'])->name('daftar-buku');
    Route::get('/daftar-buku-detail/{id}', [peminjamController::class, 'daftar_buku_detail'])->name('daftar-buku-detail');
    Route::get('/peminjaman', [peminjamController::class, 'peminjaman'])->name('peminjaman');
    Route::get('/{id}/peminjaman-buku', [peminjamController::class, 'peminjaman_buku'])->name('peminjaman-buku');
    Route::get('/pengembalian', [peminjamController::class, 'pengembalian'])->name('pengembalian');
    Route::get('/{id}/pengembalian-buku', [peminjamController::class, 'pengembalian_buku'])->name('pengembalian-buku');
});

Route::middleware([adm::class])->group(function () {
    Route::get('/adm/dashboard', [admController::class, 'dashboard'])->name('adm-dashboard');
    Route::post('/adm', [admController::class, 'logout'])->name('adm-logout');
    Route::get('/adm/profil', [admController::class, 'profil'])->name('adm-profil');
    Route::post('/adm/profil', [admController::class, 'profil_ubah'])->name('adm-profil-ubah');
    Route::get('/adm/register-admin', [admController::class, 'register_admin'])->name('adm-register-admin');
    Route::post('/adm/register-admin', [admController::class, 'register_admin_submit'])->name('adm-register-admin-submit');

    Route::get('/adm/kondisi-buku', [admController::class, 'kondisi_buku'])->name('adm-kondisi-buku');
    Route::post('/adm/kondisi-buku/{id}', [admController::class, 'kondisi_buku_hapus'])->name('adm-kondisi-buku-hapus');
    Route::get('/adm/kondisi-buku/tambah', [admController::class, 'kondisi_buku_tambah'])->name('adm-kondisi-buku-tambah');
    Route::post('/adm/kondisi-buku-tambah', [admController::class, 'kondisi_buku_tambah_submit'])->name('adm-kondisi-buku-tambah-submit');
    Route::get('/adm/kondisi-buku/ubah/{id}', [admController::class, 'kondisi_buku_ubah'])->name('adm-kondisi-buku-ubah');
    Route::post('/adm/kondisi-buku-ubah/{id}', [admController::class, 'kondisi_buku_ubah_submit'])->name('adm-kondisi-buku-ubah-submit');

    Route::get('/adm/status-buku', [admController::class, 'status_buku'])->name('adm-status-buku');
    Route::post('/adm/status-buku/{id}', [admController::class, 'status_buku_hapus'])->name('adm-status-buku-hapus');
    Route::get('/adm/status-buku/tambah', [admController::class, 'status_buku_tambah'])->name('adm-status-buku-tambah');
    Route::post('/adm/status-buku-tambah', [admController::class, 'status_buku_tambah_submit'])->name('adm-status-buku-tambah-submit');
    Route::get('/adm/status-buku/ubah/{id}', [admController::class, 'status_buku_ubah'])->name('adm-status-buku-ubah');
    Route::post('/adm/status-buku-ubah/{id}', [admController::class, 'status_buku_ubah_submit'])->name('adm-status-buku-ubah-submit');

    Route::get('/adm/status-pinjaman', [admController::class, 'status_pinjaman'])->name('adm-status-pinjaman');
    Route::post('/adm/status-pinjaman/{id}', [admController::class, 'status_pinjaman_hapus'])->name('adm-status-pinjaman-hapus');
    Route::get('/adm/status-pinjaman/tambah', [admController::class, 'status_pinjaman_tambah'])->name('adm-status-pinjaman-tambah');
    Route::post('/adm/status-pinjaman-tambah', [admController::class, 'status_pinjaman_tambah_submit'])->name('adm-status-pinjaman-tambah-submit');
    Route::get('/adm/status-pinjaman/ubah/{id}', [admController::class, 'status_pinjaman_ubah'])->name('adm-status-pinjaman-ubah');
    Route::post('/adm/status-pinjaman-ubah/{id}', [admController::class, 'status_pinjaman_ubah_submit'])->name('adm-status-pinjaman-ubah-submit');

    Route::get('/adm/daftar-penerbit', [admController::class, 'daftar_penerbit'])->name('adm-daftar-penerbit');
    Route::post('/adm/daftar-penerbit/{id}', [admController::class, 'daftar_penerbit_hapus'])->name('adm-daftar-penerbit-hapus');
    Route::get('/adm/daftar-penerbit/tambah', [admController::class, 'daftar_penerbit_tambah'])->name('adm-daftar-penerbit-tambah');
    Route::post('/adm/daftar-penerbit-tambah', [admController::class, 'daftar_penerbit_tambah_submit'])->name('adm-daftar-penerbit-tambah-submit');
    Route::get('/adm/daftar-penerbit/ubah/{id}', [admController::class, 'daftar_penerbit_ubah'])->name('adm-daftar-penerbit-ubah');
    Route::post('/adm/daftar-penerbit-ubah/{id}', [admController::class, 'daftar_penerbit_ubah_submit'])->name('adm-daftar-penerbit-ubah-submit');

    Route::get('/adm/daftar-buku', [admController::class, 'daftar_buku'])->name('adm-daftar-buku');
    Route::post('/adm/daftar-buku/{id}', [admController::class, 'daftar_buku_hapus'])->name('adm-daftar-buku-hapus');
    Route::get('/adm/daftar-buku/tambah', [admController::class, 'daftar_buku_tambah'])->name('adm-daftar-buku-tambah');
    Route::post('/adm/daftar-buku-tambah', [admController::class, 'daftar_buku_tambah_submit'])->name('adm-daftar-buku-tambah-submit');
    Route::get('/adm/daftar-buku/ubah/{id}', [admController::class, 'daftar_buku_ubah'])->name('adm-daftar-buku-ubah');
    Route::post('/adm/daftar-buku-ubah/{id}', [admController::class, 'daftar_buku_ubah_submit'])->name('adm-daftar-buku-ubah-submit');
    Route::get('/adm/daftar-buku-detail/{id}', [admController::class, 'daftar_buku_detail'])->name('adm-daftar-buku-detail');

    Route::get('/adm/daftar-pinjaman', [admController::class, 'daftar_pinjaman'])->name('adm-daftar-pinjaman');
    Route::post('/adm/daftar-pinjaman/{id}', [admController::class, 'daftar_pinjaman_hapus'])->name('adm-daftar-pinjaman-hapus');
    Route::get('/adm/daftar-pinjaman/tambah', [admController::class, 'daftar_pinjaman_tambah'])->name('adm-daftar-pinjaman-tambah');
    Route::get('/adm/daftar-pinjaman/transaksi/{id}', [admController::class, 'daftar_pinjaman_transaksi'])->name('adm-daftar-pinjaman-transaksi');
    Route::get('/adm/daftar-pinjaman/tambah/info/{id}', [admController::class, 'daftar_pinjaman_tambah_info'])->name('adm-daftar-pinjaman-tambah-info');

    Route::get('/adm/daftar-pinjaman-detail/{id}/{trx_id}', [admController::class, 'daftar_pinjaman_detail'])->name('adm-daftar-pinjaman-detail');
    Route::post('/adm/daftar-pinjaman-detail-dikembalikan/{id}', [admController::class, 'daftar_pinjaman_detail_dikembalikan'])->name('adm-daftar-pinjaman-detail-dikembalikan');
    Route::post('/adm/daftar-pinjaman-detail-hapus/{id}', [admController::class, 'daftar_pinjaman_detail_hapus'])->name('adm-daftar-pinjaman-detail-hapus');
    Route::get('/adm/daftar-pinjaman-detail-tambah/{id}/{trx_id}', [admController::class, 'daftar_pinjaman_detail_tambah'])->name('adm-daftar-pinjaman-detail-tambah');
    Route::get('/adm/daftar-pinjaman-detail-tambah/{id}/{trx_id}/{buku_id}', [admController::class, 'daftar_pinjaman_detail_tambah_buku'])->name('adm-daftar-pinjaman-detail-tambah-buku');
    Route::post('/adm/daftar-pinjaman-detail-tambah-submit/{id}/{trx_id}/{buku_id}', [admController::class, 'daftar_pinjaman_detail_tambah_submit'])->name('adm-daftar-pinjaman-detail-tambah-submit');
    Route::get('/adm/daftar-pinjaman-detail-info/{id}/{trx_id}', [admController::class, 'daftar_pinjaman_detail_info'])->name('adm-daftar-pinjaman-detail-info');
    Route::get('/adm/daftar-pinjaman-detail-info/{id}/{trx_id}/{buku_id}', [admController::class, 'daftar_pinjaman_detail_info_buku'])->name('adm-daftar-pinjaman-detail-info-buku');
    Route::get('/adm/daftar-pinjaman-detail-pengembalian/{id}/{trx_id}', [admController::class, 'daftar_pinjaman_detail_pengembalian'])->name('adm-daftar-pinjaman-detail-pengembalian');
    Route::get('/adm/daftar-pinjaman-detail-pengembalian-buku/{id}/{trx_id}/{buku_id}', [admController::class, 'daftar_pinjaman_detail_pengembalian_buku'])->name('adm-daftar-pinjaman-detail-pengembalian-buku');

    Route::get('/adm/kelola-akun', [admController::class, 'kelola_akun'])->name('adm-kelola-akun');
    Route::post('/adm/kelola-akun/approve/{id}', [admController::class, 'kelola_akun_approve'])->name('adm-kelola-akun-approve');
    Route::post('/adm/kelola-akun/hapus/{id}', [admController::class, 'kelola_akun_hapus'])->name('adm-kelola-akun-hapus');
    Route::get('/adm/kelola-akun-ubah/{id}', [admController::class, 'kelola_akun_ubah'])->name('adm-kelola-akun-ubah');
    Route::post('/adm/kelola-akun-ubah/{id}/submit', [admController::class, 'kelola_akun_ubah_submit'])->name('adm-kelola-akun-ubah-submit');
    Route::get('/adm/kelola-akun-detail/{id}', [admController::class, 'kelola_akun_detail'])->name('adm-kelola-akun-detail');
    Route::get('/adm/kelola-akun-tambah', [admController::class, 'kelola_akun_tambah'])->name('adm-kelola-akun-tambah');
    Route::post('/adm/kelola-akun-tambah/submit', [admController::class, 'kelola_akun_tambah_submit'])->name('adm-kelola-akun-tambah-submit');
});

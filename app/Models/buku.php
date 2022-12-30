<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;
    protected $fillable = ["kode", "judul", "deskripsi", "penerbit_id", "tahun_terbit", "pengarang", "jumlah_halaman", "kondisi_id", "status_id", "foto_sampul"];

    public function buku_penerbit()
    {
        return $this->belongsTo(buku_penerbit::class, 'penerbit_id');
    }

    public function buku_kondisi()
    {
        return $this->belongsTo(buku_kondisi::class, "kondisi_id");
    }

    public function buku_status()
    {
        return $this->belongsTo(buku_status::class, "status_id");
    }

    public function trx_pinjaman_detail()
    {
        return $this->hasMany(trx_pinjaman_detail::class, "buku_id");
    }
}

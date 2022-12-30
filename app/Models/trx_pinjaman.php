<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_pinjaman extends Model
{
    protected $table = 'trx_pinjamans';
    use HasFactory;
    protected $fillable = ["peminjam_id", "tanggal"];

    public function peminjam()
    {
        return $this->belongsTo(peminjam::class, "peminjam_id");
    }

    public function trx_pinjaman_detail()
    {
        return $this->hasMany(trx_pinjaman_detail::class, "trx_id");
    }
}

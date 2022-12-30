<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_pinjaman_detail extends Model
{
    use HasFactory;
    protected $fillable = ["trx_id", "buku_id", "status_id", "kembali"];

    public function trx_pinjaman()
    {
        return $this->belongsTo(trx_pinjaman::class, "trx_id");
    }

    public function buku()
    {
        return $this->belongsTo(buku::class, "buku_id");
    }

    public function trx_pinjaman_detail_status()
    {
        return $this->belongsTo(trx_pinjaman_detail_status::class, "status_id");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_pinjaman_detail_status extends Model
{
    use HasFactory;
    protected $fillable = ["status"];

    public function trx_pinjaman_detail()
    {
        return $this->hasMany(trx_pinjaman_detail::class, "status_id");
    }
}

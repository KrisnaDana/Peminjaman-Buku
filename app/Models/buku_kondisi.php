<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku_kondisi extends Model
{
    use HasFactory;
    protected $fillable = ["kondisi"];

    public function buku()
    {
        return $this->hasMany(buku::class, 'kondisi_id');
    }
}

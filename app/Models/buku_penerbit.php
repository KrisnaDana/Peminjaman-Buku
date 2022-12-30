<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku_penerbit extends Model
{
    use HasFactory;
    protected $fillable = ["penerbit"];

    public function buku()
    {
        return $this->hasMany(buku::class, "penerbit_id");
    }
}

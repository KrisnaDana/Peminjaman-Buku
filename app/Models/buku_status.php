<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku_status extends Model
{
    use HasFactory;
    protected $fillable = ["status"];

    public function buku()
    {
        return $this->hasMany(buku::class, "status_id");
    }
}

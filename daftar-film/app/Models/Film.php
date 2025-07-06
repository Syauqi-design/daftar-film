<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['judul', 'genre', 'tahun', 'deskripsi', "poster"];

}

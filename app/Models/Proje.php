<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proje extends Model
{
    protected $fillable = ['baslik', 'detay', 'toplam_tutar', 'daire_basi_odeme'];
}

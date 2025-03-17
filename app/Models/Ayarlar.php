<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ayarlar extends Model
{
    protected $table = 'ayarlar'; // Bu satır tablo adını "ayarlar" olarak ayarlar.

    protected $fillable = ['daire_sayisi', 'guncel_aidat', 'ilk_kasa'];
}

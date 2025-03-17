<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gelir extends Model
{
    protected $fillable = ['baslik', 'aciklama', 'foto', 'proje_id', 'miktar', 'tarih'];
}

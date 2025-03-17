<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gider extends Model
{
    protected $fillable = ['baslik', 'aciklama', 'foto', 'miktar', 'tarih'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaireSahibi extends Model
{
    protected $table = 'daire_sahipleri';

    protected $fillable = ['daire_no', 'isim', 'email', 'telefon'];
}

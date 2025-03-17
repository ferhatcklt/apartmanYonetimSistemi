<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAyarlarTable extends Migration
{
    public function up()
    {
        Schema::create('ayarlar', function (Blueprint $table) {
            $table->id();
            $table->integer('daire_sayisi');
            $table->decimal('guncel_aidat', 8, 2);
            $table->decimal('ilk_kasa', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ayarlar');
    }
}

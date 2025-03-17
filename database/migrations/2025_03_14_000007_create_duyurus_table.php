<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDuyurusTable extends Migration
{
    public function up()
    {
        Schema::create('duyurus', function (Blueprint $table) {
            $table->id();
            $table->string('baslik');
            $table->text('aciklama');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('duyurus');
    }
}

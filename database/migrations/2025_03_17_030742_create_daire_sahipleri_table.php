<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaireSahipleriTable extends Migration
{
    public function up()
    {
        Schema::create('daire_sahipleri', function (Blueprint $table) {
            $table->id();
            $table->integer('daire_no');   // dairenin numarası
            $table->string('isim');        // daire sahibinin adı
            $table->string('email')->nullable();
            $table->string('telefon')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daire_sahipleri');
    }
}

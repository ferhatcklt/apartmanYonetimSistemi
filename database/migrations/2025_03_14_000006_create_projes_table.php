<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjesTable extends Migration
{
    public function up()
    {
        Schema::create('projes', function (Blueprint $table) {
            $table->id();
            $table->string('baslik');
            $table->text('detay');
            $table->decimal('toplam_tutar', 10, 2);
            $table->decimal('daire_basi_odeme', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projes');
    }
}

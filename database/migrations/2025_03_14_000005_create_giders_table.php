<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGidersTable extends Migration
{
    public function up()
    {
        Schema::create('giders', function (Blueprint $table) {
            $table->id();
            $table->string('baslik');
            $table->text('aciklama')->nullable();
            $table->string('foto')->nullable();
            $table->decimal('miktar', 8, 2);
            $table->date('tarih');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('giders');
    }
}

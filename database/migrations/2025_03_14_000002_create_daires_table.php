<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDairesTable extends Migration
{
    public function up()
    {
        Schema::create('daires', function (Blueprint $table) {
            $table->id();
            $table->integer('no')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daires');
    }
}

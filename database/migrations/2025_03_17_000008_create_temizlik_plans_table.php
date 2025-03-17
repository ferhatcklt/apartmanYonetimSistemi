<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemizlikPlansTable extends Migration
{
    public function up()
    {
        Schema::create('temizlik_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('hafta'); // Ay içindeki hafta numarası (1,2,3,4,5)
            $table->date('tarih')->nullable(); // Gerçekleşen temizlik tarihi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('temizlik_plans');
    }
}

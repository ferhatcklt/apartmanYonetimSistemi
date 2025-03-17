<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAidatsTable extends Migration
{
    public function up()
    {
        Schema::create('aidats', function (Blueprint $table) {
            $table->id();
            $table->integer('daire_no');
            $table->string('ay');
            $table->year('yil');
            $table->decimal('miktar', 8, 2)->default(0);
            $table->enum('status', ['odendi', 'odenmedi'])->default('odenmedi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aidats');
    }
}

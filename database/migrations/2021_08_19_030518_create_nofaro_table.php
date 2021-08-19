<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNofaroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nofaro', function (Blueprint $table) {
            $table->timestamps('timestamps');
            $table->increments('block');
            $table->string('input', 255);
            $table->string('key', 8);
            $table->string('hash', 16);
            $table->integer('attempts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nofaro');
    }
}

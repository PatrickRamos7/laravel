<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosClientTable extends Migration
{
    public function up()
    {
        Schema::create('pos_client', function (Blueprint $table) {
            $table->id('client_id');
            $table->tinyInteger('doc_type');
            $table->string('doc_number', 20);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('phone', 20)->nullable();
            $table->string('email', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pos_client');
    }
}
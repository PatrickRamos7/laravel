<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosOrderTable extends Migration
{
    public function up()
    {
        Schema::create('pos_order', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('client_id');
            $table->decimal('total', 10, 2);
            $table->tinyInteger('doc_type');
            $table->string('doc_number', 20);
            $table->timestamps();

            $table->foreign('client_id')
                  ->references('client_id')
                  ->on('pos_client')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pos_order');
    }
}
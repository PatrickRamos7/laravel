<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosBookTable extends Migration
{
    public function up()
    {
        Schema::create('pos_book', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('isbn', 13);
            $table->string('name');
            $table->string('author');
            $table->integer('stock');
            $table->decimal('current_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pos_book');
    }
}
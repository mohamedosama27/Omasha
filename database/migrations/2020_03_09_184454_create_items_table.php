<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('barcode');
            $table->text('description');
            $table->text('price')->nullable();
            $table->text('cost')->nullable();
            $table->tinyInteger('hide')->nullable();
            $table->Integer('quantity')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}

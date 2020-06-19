<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customize_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('contact_name');
            $table->text('email');
            $table->text('phone');
            $table->text('category');
            $table->text('quantity');
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
        Schema::dropIfExists('customize_orders');
    }
}

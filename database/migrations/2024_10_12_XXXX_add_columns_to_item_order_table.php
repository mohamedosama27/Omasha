<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToItemOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_order', function (Blueprint $table) {
            $table->text('style')->nullable();
            $table->text('style_ar')->nullable();
            $table->text('size')->nullable();
            $table->text('color')->nullable();
            $table->text('color_ar')->nullable();
            $table->text('note')->nullable();
            $table->text('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_order', function (Blueprint $table) {
            $table->dropColumn('style');
            $table->dropColumn('style_ar');
            $table->dropColumn('size');
            $table->dropColumn('color');
            $table->dropColumn('color_ar');
            $table->dropColumn('note');
            $table->dropColumn('price');
        });
    }
}

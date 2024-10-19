<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('is_child')->default(false);

            // Add a foreign key column for parent_category_id that can be null
            $table->unsignedBigInteger('parent_category_id')->nullable();

            // Add a foreign key constraint that references the 'id' field on the same 'categories' table
            $table->foreign('parent_category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['parent_category_id']);
            $table->dropColumn('parent_category_id');

            // Drop the is_child column
            $table->dropColumn('is_child');
        });
    }
};

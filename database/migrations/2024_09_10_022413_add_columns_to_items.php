<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->json('care_instructions')->nullable();
            $table->text('return_policy')->nullable();
            $table->json('styles')->nullable();
            $table->json('sizes')->nullable();
            $table->json('description')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('care_instructions');
            $table->dropColumn('return_policy');
            $table->dropColumn('styles');
            $table->dropColumn('sizes');
            $table->text('description')->change();
        });
    }
};

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
        Schema::table('items', function (Blueprint $table) {
            $table->text('name_ar')->after('name'); // Arabic name
            $table->json('description_ar')->nullable()->after('description'); // Arabic description
            $table->text('return_policy_ar')->nullable()->after('return_policy'); // Arabic return policy
            $table->json('care_instructions_ar')->nullable()->after('care_instructions');
            $table->json('styles_ar')->nullable()->after('styles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('name_ar');
            $table->dropColumn('description_ar');
            $table->dropColumn('return_policy_ar');
            $table->dropColumn('care_instructions_ar');
            $table->dropColumn('styles_ar');
        });
    }
};

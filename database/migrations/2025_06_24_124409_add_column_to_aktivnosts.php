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
        Schema::table('aktivnosts', function (Blueprint $table) {
            $table->boolean('notifikacija_poslata')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aktivnosts', function (Blueprint $table) {
            $table->dropColumn('notifikacija_poslata');
        });
    }
};

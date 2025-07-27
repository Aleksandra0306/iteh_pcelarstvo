<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aktivnosts', function (Blueprint $table) {
            $table->date('pocetak')->change();
        });
    }
    public function down(): void
    {
        Schema::table('aktivnosts', function (Blueprint $table) {
            $table->dateTime('pocetak')->change();
        });
    }
};

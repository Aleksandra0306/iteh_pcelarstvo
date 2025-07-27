<?php

use App\Models\Aktivnost;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sugestijas', function (Blueprint $table) {
            $table->foreignIdFor(Aktivnost::class)->constrained()->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::table('sugestijas', function (Blueprint $table) {
            $table->dropForeign(['aktivnost_id']);
            $table->dropColumn('aktivnost_id');
        });
    }
};


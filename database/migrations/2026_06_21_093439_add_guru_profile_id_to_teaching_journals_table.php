<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teaching_journals', function (Blueprint $table) {
            $table->foreignId('guru_profile_id')
                  ->nullable()
                  ->constrained('guru_profiles')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('teaching_journals', function (Blueprint $table) {
            $table->dropForeign(['guru_profile_id']);
            $table->dropColumn('guru_profile_id');
        });
    }
};
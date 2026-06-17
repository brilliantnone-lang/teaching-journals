<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teaching_journals', function (Blueprint $table) {
            $table->id();
            
            // Data Guru
            $table->string('teacher_name');
            $table->string('nip');
            $table->string('class');
            $table->string('semester');
            $table->string('subject');
            $table->string('day');
            $table->date('date');
            
            // Materi & Jadwal
            $table->text('material');
            $table->string('lesson_start');
            $table->string('lesson_end');
            $table->time('time_start');
            $table->time('time_end');
            $table->text('learning_activity');
            
            // Presensi
            $table->integer('present')->default(0);
            $table->integer('permit')->default(0);
            $table->integer('sick')->default(0);
            $table->integer('absent')->default(0);
            $table->text('permit_names')->nullable();
            $table->text('sick_names')->nullable();
            $table->text('absent_names')->nullable();
            
            // Catatan & Foto
            $table->text('notes')->nullable();
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teaching_journals');
    }
};
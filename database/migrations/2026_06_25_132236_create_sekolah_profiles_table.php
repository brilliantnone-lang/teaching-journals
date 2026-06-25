<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sekolah_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_profile_id')->constrained()->onDelete('cascade');
            
            // Data Sekolah (Kop Surat)
            $table->string('logo_kiri')->nullable();
            $table->string('logo_kanan')->nullable();
            $table->string('instansi')->nullable();
            $table->string('dinas')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->text('alamat_sekolah')->nullable();
            $table->string('website_sekolah')->nullable();
            $table->string('kepala_sekolah')->nullable();
            $table->string('nip_kepala_sekolah')->nullable();
            $table->string('tahun_pelajaran')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sekolah_profiles');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('berita_acara_uang_ganti_rugis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('archive_id')->constrained()->cascadeOnDelete();

            $table->string('nomor_berita_acara_ugr');
            $table->date('tanggal_ugr');
            $table->string('nomor_validasi');
            $table->date('tanggal_validasi');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('nama_projek');
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_acara_uang_ganti_rugis');
    }
};

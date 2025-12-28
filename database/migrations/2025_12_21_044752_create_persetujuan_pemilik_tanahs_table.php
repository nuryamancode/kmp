<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('persetujuan_pemilik_tanahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('archive_id')->constrained()->cascadeOnDelete();

            $table->string('nama_pemohon');
            $table->decimal('luas', 10, 2);
            $table->string('nis');
            $table->string('status');
            $table->decimal('nilai_uang_ganti_rugi', 15, 2);
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
        Schema::dropIfExists('persetujuan_pemilik_tanahs');
    }
};

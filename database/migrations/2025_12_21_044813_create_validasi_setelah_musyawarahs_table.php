<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('validasi_setelah_musyawarahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('archive_id')->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('validasi_setelah_musyawarahs');
    }
};

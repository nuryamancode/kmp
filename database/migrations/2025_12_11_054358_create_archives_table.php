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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('standardization_id')->constrained('standardizations')->onDelete('cascade')->comment('ID Standardisasi');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('ID Pengguna');
            // $table->foreignId('division_id')->constrained('divisions')->onDelete('cascade')->comment('ID Divisi');
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade')->comment('ID Tipe');
            $table->string('title')->comment('Judul Arsip')->nullable();
            $table->text('description')->nullable()->comment('Deskripsi Arsip');
            $table->date('date')->comment('Tanggal Arsip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};

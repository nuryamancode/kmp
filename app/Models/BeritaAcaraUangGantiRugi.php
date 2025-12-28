<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class BeritaAcaraUangGantiRugi extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = 'berita_acara_uang_ganti_rugis';

    protected $fillable = [
        'archive_id',
        'nomor_berita_acara_ugr',
        'tanggal_ugr',
        'nomor_validasi',
        'tanggal_validasi',
        'desa',
        'kecamatan',
        'kabupaten',
        'nama_projek',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_ugr' => 'date',
        'tanggal_validasi' => 'date',
    ];

    /**
     * Relasi ke Archive
     * 1 Berita Acara Uang Ganti Rugi dimiliki oleh 1 Archive
     */
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}

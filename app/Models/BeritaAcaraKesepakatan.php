<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class BeritaAcaraKesepakatan extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = 'berita_acara_kesepakatans';

    protected $fillable = [
        'archive_id',
        'nomor_kesepakatan',
        'tanggal_kesepakatan',
        'desa',
        'kecamatan',
        'kabupaten',
        'nama_projek',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_kesepakatan' => 'date',
    ];

    /**
     * Relasi ke Archive
     * 1 Berita Acara Kesepakatan dimiliki oleh 1 Archive
     */
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}

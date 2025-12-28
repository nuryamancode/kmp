<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PersetujuanPemilikTanah extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = 'persetujuan_pemilik_tanahs';

    protected $fillable = [
        'archive_id',
        'nama_pemohon',
        'luas',
        'nis',
        'status',
        'nilai_uang_ganti_rugi',
        'desa',
        'kecamatan',
        'kabupaten',
        'nama_projek',
        'keterangan',
    ];

    protected $casts = [
        'luas' => 'decimal:2',
        'nilai_uang_ganti_rugi' => 'decimal:2',
    ];

    /**
     * Relasi ke Archive
     * 1 Persetujuan Pemilik Tanah dimiliki oleh 1 Archive
     */
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}

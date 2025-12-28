<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PembayaranGantiRugiPerbidang extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = 'pembayaran_ganti_rugi_perbidangs';

    protected $fillable = [
        'archive_id',
        'nama_pemohon',
        'nomor_register',
        'luas',
        'nis',
        'status',
        'nilai_uang_ganti_rugi',
        'alas_hak',
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
     * 1 Pembayaran Ganti Rugi Per Bidang dimiliki oleh 1 Archive
     */
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}

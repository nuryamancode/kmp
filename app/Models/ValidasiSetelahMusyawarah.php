<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ValidasiSetelahMusyawarah extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = 'validasi_setelah_musyawarahs';

    protected $fillable = [
        'archive_id',
        'nomor_validasi',
        'tanggal_validasi',
        'desa',
        'kecamatan',
        'kabupaten',
        'nama_projek',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_validasi' => 'date',
    ];

    /**
     * Relasi ke Archive
     * 1 Validasi Setelah Musyawarah dimiliki oleh 1 Archive
     */
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}

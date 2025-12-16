<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;  // Tambahkan ini
use OwenIt\Auditing\Auditable as AuditableTrait;  // Tambahkan ini

class Document extends Model implements Auditable
{
    use AuditableTrait;
    protected $fillable = [
        'archive_id',
        'title',
        'file_path'
    ];

    // Relasi dengan model Archive
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}

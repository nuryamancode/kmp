<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;  // Tambahkan ini
use OwenIt\Auditing\Auditable as AuditableTrait;  // Tambahkan ini

class Archive extends Model implements Auditable
{
    use AuditableTrait;
    use HasFactory;

    // Definisikan kolom-kolom yang dapat diisi
    protected $fillable = [
        'standardization_id',
        'user_id',
        'division_id',
        'type_id',
        'title',
        'description',
        'date'
    ];

    // Relasi dengan tabel Standardization
    public function standardization()
    {
        return $this->belongsTo(Standardization::class);
    }

    // Relasi dengan tabel Division
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    // Relasi dengan tabel Type
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // Relasi dengan tabel Document
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}

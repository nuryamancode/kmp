<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;  // Tambahkan ini
use OwenIt\Auditing\Auditable as AuditableTrait;  // Tambahkan ini

class Type extends Model implements Auditable // Tambahkan implements Auditable
{
    use AuditableTrait;

    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}

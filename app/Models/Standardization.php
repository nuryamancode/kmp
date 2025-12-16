<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;  // Tambahkan ini
use OwenIt\Auditing\Auditable as AuditableTrait;  // Tambahkan ini

class Standardization extends Model implements Auditable
{
    use AuditableTrait;
    protected $fillable = [
        'name',
        'description',
    ];
}

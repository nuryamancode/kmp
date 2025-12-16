<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;  // Tambahkan ini
use OwenIt\Auditing\Auditable as AuditableTrait;  // Tambahkan ini

class Categories extends Model implements Auditable
{
    use AuditableTrait;
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the types associated with the category.
     */
    public function type()
    {
        return $this->hasOne(Type::class, 'category_id');
    }
}

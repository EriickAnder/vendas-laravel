<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    protected $fillable = [
        'vendedor_uuid',
        'valor',
        'uuid'
    ];

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'vendedor_uuid', 'uuid');
    }
}

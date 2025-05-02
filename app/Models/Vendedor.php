<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'uuid',
        'status'
    ];

    protected $table = 'vendedores';


    public function vendas()
    {
        return $this->hasMany(Vendas::class, 'vendedor_uuid', 'uuid');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $table = 'pagamentos';

    protected $fillable = [
    'divida_id',
    'valor',
    'metodo_pagamento',
    'observacao',
    'data_pagamento',
    'user_id',
    'numero_recibo'
];

    public function divida()
    {
        return $this->belongsTo(\App\Models\Divida::class);
    }

public function user()
{
    return $this->belongsTo(User::class);
}

}
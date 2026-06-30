<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
    'cliente_id',
    'valor_total',
    'forma_pagamento',
    'valor_pago',
    'numero_fatura'
];

public function cliente()
{
    return $this->belongsTo(\App\Models\Cliente::class);
}

public function itens()
{
    return $this->hasMany(\App\Models\VendaItem::class);
}

public function divida()
{
    return $this->hasOne(\App\Models\Divida::class);
}

}
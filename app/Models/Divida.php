<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divida extends Model
{
    protected $table = 'dividas';

    protected $fillable = [
        'venda_id',
        'valor_total',
        'valor_pago',
        'saldo',
        'estado'
    ];

    public function venda()
    {
        return $this->belongsTo(\App\Models\Venda::class);
    }

    public function pagamentos()
    {
        return $this->hasMany(DividaPagamento::class);
    }
}
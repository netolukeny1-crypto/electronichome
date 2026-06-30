<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DividaPagamento extends Model
{
    protected $table = 'divida_pagamentos';

    protected $fillable = [
        'divida_id',
        'valor',
        'tipo'
    ];

    public function divida()
    {
        return $this->belongsTo(Divida::class);
    }
}
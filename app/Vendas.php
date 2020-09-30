<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model {
    protected $fillable = ['subtotal','desconto','total'];
    public $timestamps = false;

    public function vendasItens(){
        return $this->hasMany(VendasItens::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendasItens extends Model {
    protected $fillable = ['vendas_id','produtos_id','quantidade','preco','total'];
    public $timestamps = false;

    public function vendas(){
        return $this->belongsTo(Vendas::class);
    }
}

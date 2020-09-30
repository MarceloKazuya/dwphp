<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model {

    protected $fillable = ['produto', 'unidade','preco'];
    public $timestamps = false;

}

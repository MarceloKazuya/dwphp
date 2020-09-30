<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaVendas extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('datavenda')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->double('subtotal', 10, 2);
            $table->double('desconto', 10, 2)->nullable();
            $table->double('total', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop ('vendas');
    }
}

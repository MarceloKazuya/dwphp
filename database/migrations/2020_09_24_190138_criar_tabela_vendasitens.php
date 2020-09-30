<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaVendasitens extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vendasitens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendas_id');
            $table->integer('produtos_id');
            $table->double('quantidade', 10, 4);
            $table->double('preco', 10, 2);
            $table->double('total', 10, 2);

            $table->foreign('vendas_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->foreign('produtos_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop ('vendasitens');
    }
}

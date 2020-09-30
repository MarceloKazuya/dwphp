<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaEan extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('ean', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produtos_id');
            $table->string('codbarras');
            $table->foreign('produtos_id')->references('id')->on('produtos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop ('ean');
    }
}

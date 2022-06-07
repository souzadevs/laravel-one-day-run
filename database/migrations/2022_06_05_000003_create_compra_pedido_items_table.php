<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraPedidoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_pedido_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantidade');
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('compra_pedido_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_pedido_items');
    }
}

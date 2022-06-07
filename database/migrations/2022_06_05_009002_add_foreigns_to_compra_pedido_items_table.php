<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToCompraPedidoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compra_pedido_items', function (Blueprint $table) {
            $table
                ->foreign('produto_id')
                ->references('id')
                ->on('produtos')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('compra_pedido_id')
                ->references('id')
                ->on('compra_pedidos')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compra_pedido_items', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
            $table->dropForeign(['compra_pedido_id']);
        });
    }
}

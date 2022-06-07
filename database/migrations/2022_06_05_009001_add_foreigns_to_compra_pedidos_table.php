<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToCompraPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compra_pedidos', function (Blueprint $table) {
            $table
                ->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('compra_pedido_status_id')
                ->references('id')
                ->on('compra_pedido_statuses')
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
        Schema::table('compra_pedidos', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']);
            $table->dropForeign(['compra_pedido_status_id']);
        });
    }
}

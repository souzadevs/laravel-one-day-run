<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('pedido_at');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('compra_pedido_status_id');

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
        Schema::dropIfExists('compra_pedidos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn('estado');
            $table->unsignedBigInteger('state_pedido_id')->default(1);
            $table->foreign('state_pedido_id')->references('id')->on('state_pedidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['state_pedido_id']);
            $table->dropColumn('state_pedido_id');
            $table->boolean('estado')->default(0);
        });
    }
};

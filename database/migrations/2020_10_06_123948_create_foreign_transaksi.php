<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('process_orders_id')->references('id')->on('process_orders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->dropForeign('transaksi_orders_id_foreign');
            $table->dropForeign('transaksi_process_orders_id_foreign');
        });
    }
}

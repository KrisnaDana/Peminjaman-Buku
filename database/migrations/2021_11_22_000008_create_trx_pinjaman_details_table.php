<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxPinjamanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_pinjaman_details', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('trx_id');
            $table->foreign('trx_id')->references('id')->on('trx_pinjamans');
            $table->integer('buku_id');
            $table->foreign('buku_id')->references('id')->on('bukus');
            $table->integer('status_id');
            $table->foreign('status_id')->references('id')->on('trx_pinjaman_detail_statuses');
            $table->date('kembali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_pinjaman_details');
    }
}

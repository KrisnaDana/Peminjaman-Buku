<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxPinjamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_pinjamans', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('peminjam_id');
            $table->foreign('peminjam_id')->references('id')->on('peminjams');
            $table->date('tanggal');
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
        Schema::dropIfExists('trx_pinjamans');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('kode', 10);
            $table->string('judul', 100);
            $table->string('deskripsi', 255);
            $table->integer('penerbit_id');
            $table->foreign('penerbit_id')->references('id')->on('buku_penerbits');
            $table->year('tahun_terbit');
            $table->string('pengarang', 100);
            $table->integer('jumlah_halaman');
            $table->integer('kondisi_id');
            $table->foreign('kondisi_id')->references('id')->on('buku_kondisis');
            $table->integer('status_id');
            $table->foreign('status_id')->references('id')->on('buku_statuses');
            $table->string('foto_sampul', 255)->nullable();
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
        Schema::dropIfExists('bukus');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjams', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama', 100);
            $table->string('alamat', 255);
            $table->string('telepon', 20);
            $table->date('tanggal_lahir');
            $table->string('email');
            $table->string('password');
            $table->string('foto')->nullable();
            $table->integer('status');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('peminjams');
    }
}

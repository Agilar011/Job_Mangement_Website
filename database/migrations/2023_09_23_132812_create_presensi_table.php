<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiTable extends Migration
{
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->timestamp('waktu_checkin');
            // $table->timestamp('rencana');
            $table->timestamp('waktu_checkout')->nullable();
            $table->text('laporan')->nullable();
            $table->string('status_presensi');
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('id_users')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('presensi');
    }
}

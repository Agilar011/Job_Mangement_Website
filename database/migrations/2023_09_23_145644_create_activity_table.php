<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTable extends Migration
{
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('nama');
            $table->text('rencana_aktifitas');
            $table->text('laporan_aktifitas')->nullable();
            $table->integer('progres_harian')->default(0);
            $table->timestamps();
            $table->string('foto1')->nullable();
            $table->string('foto2')->nullable();

            // Menambahkan foreign key constraint
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity');
    }
}

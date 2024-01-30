<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataKeluargaPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_keluarga', function (Blueprint $table) {
            $table->bigIncrements('id_keluarga');
            $table->integer('nip_pegawai');
            $table->string('nama_ayah', 100);
            $table->string('nama_ibu', 100);
            $table->date('tgl_lhr_ayah');
            $table->date('tgl_lhr_ibu');
            $table->string('nama_p', 100);
            $table->string('nip_p', 100);
            $table->date('tgl_lhr_p');
            $table->integer('no_b_nikah');
            $table->date('tgl_b_nikah');
            $table->string('pekerjaan_p', 100);
            $table->string('status_p', 100);
            $table->string('nama_a_1', 100);
            $table->string('nama_a_2', 100);
            $table->string('nama_a_3', 100);
            $table->string('nama_a_4', 100);
            $table->string('nama_a_5', 100);
            $table->date('tgl_lhr_a_1');
            $table->date('tgl_lhr_a_2');
            $table->date('tgl_lhr_a_3');
            $table->date('tgl_lhr_a_4');
            $table->date('tgl_lhr_a_5');
            $table->string('kerja_a_1', 100);
            $table->string('kerja_a_2', 100);
            $table->string('kerja_a_3', 100);
            $table->string('kerja_a_4', 100);
            $table->string('kerja_a_5', 100);
            $table->integer('usia_a_1');
            $table->integer('usia_a_2');
            $table->integer('usia_a_3');
            $table->integer('usia_a_4');
            $table->integer('usia_a_5');
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
        
        Schema::dropIfExists('data_keluarga_pegawai');
    }
}

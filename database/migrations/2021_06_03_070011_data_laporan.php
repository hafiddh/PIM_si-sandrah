<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataLaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_laporan', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');
            $table->integer('id_opd');
            $table->string('judul', 100);
            $table->string('daerah', 100);
            $table->date('tgl_buat');
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
        
        Schema::dropIfExists('data_laporan');
    }
}

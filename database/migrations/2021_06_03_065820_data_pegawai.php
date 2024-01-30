<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pegawai', function (Blueprint $table) {
            $table->bigIncrements('id_pegawai');
            $table->string('nama_pegawai', 100);
            $table->string('nip_lama', 50)->nullable();
            $table->string('nip_baru', 50);
            $table->string('nik', 30)->nullable();
            $table->string('npwp', 30)->nullable();            
            $table->string('no_hp', 30)->nullable();
            $table->string('lahir_tempat', 20)->nullable();
            $table->string('lahir_tgl', 50)->nullable();
            $table->string('pangkat', 30)->nullable();
            $table->string('pns_gol_awal', 10)->nullable();
            $table->string('tmt_cpns', 20)->nullable();
            $table->string('tmt_pns', 20)->nullable();
            $table->string('jenis_kelamin', 10)->nullable();
            $table->string('gol_terakhir', 10)->nullable();
            $table->string('gol_tmt', 20)->nullable();
            $table->integer('mk_thn')->nullable();
            $table->integer('mk_bln')->nullable();
            $table->string('jab_tmt', 50)->nullable();
            $table->string('jab_fung_tertentu', 100)->nullable();
            $table->string('jab_fung_umum', 100)->nullable();
            $table->string('jab_struk_nama', 100)->nullable();
            $table->string('jab_struk_ese', 10)->nullable();
            $table->string('unit_kerja', 100)->nullable();
            $table->string('tkt_pend', 50)->nullable();
            $table->string('ked_huk', 50)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->string('kode_opd', 50);
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
        Schema::dropIfExists('data_pegawai');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataSpum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_spum_gaji', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pegawai', 100);
            $table->string('nip_pegawai', 100);
            $table->integer('gaji_pokok');
            $table->integer('tun_su_is');
            $table->integer('tun_anak');
            $table->integer('jum1');
            $table->integer('tun_ese');
            $table->integer('tun_fung_umum');
            $table->integer('tun_fungsi');
            $table->integer('tun_kh');
            $table->integer('tun_terpencil');
            $table->integer('tkd');
            $table->integer('tun_beras');
            $table->integer('tun_pajak');
            $table->integer('tun_bpjs');
            $table->integer('tun_jkk');
            $table->integer('tun_jkm');
            $table->integer('tun_tapera');
            $table->integer('pembulatan');
            $table->integer('jum_kotor');
            $table->integer('pot_pajak');
            $table->integer('pot_bpjs');
            $table->integer('pot_wip1');
            $table->integer('pot_iwp8');
            $table->integer('pot_taperum');
            $table->integer('pot_jkk');
            $table->integer('pot_jkm');
            $table->integer('pot_tapera_pk');
            $table->integer('pot_tapera_peg');
            $table->integer('pot_hutang');
            $table->integer('pot_bulog');
            $table->integer('sewa_rumah');
            $table->integer('potongan');
            $table->integer('jum_bersih');            
            $table->string('kode_opd', 50);
            $table->string('bulan', 10);
            $table->string('tahun', 5);
            $table->string('id_spum');
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
        Schema::dropIfExists('data_spum');
    }
}

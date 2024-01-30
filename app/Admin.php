<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    
    // protected $fillable = array('id','nama_pegawai','nip_pegawai','gaji_pokok','gaji_pokok','tun_su_is','tun_anak','jum1','tun_ese','tun_fung_umum','tun_fungsi','tun_kh','tun_terpencil','tkd','tun_beras','tun_pajak','tun_bpjs','tun_jkk','tun_jkm','tun_tapera','pembulatan','jum_kotor','pot_pajak','pot_bpjs','pot_wip1','pot_iwp8','pot_taperum','pot_jkk','pot_jkm','pot_tapera_pk','pot_tapera_peg','pot_hutang','pot_bulog','sewa_rumah','potongan','jum_bersih','kode_opd','bulan','tahun','created_at', 'updated_at');
    
    protected $table = 'rekon_data';
}

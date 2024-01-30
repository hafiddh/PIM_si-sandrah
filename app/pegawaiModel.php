<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pegawaiModel extends Model
{
    protected $table = 'data_pegawai';
    protected $primaryKey = 'id_pegawai';
    // protected $fillable = ["nama_pegawai", "nip_baru", "kode_opd"];
}

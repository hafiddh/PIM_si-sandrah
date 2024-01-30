<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['id','nip_pegawai', 'nama', 'spum'];
    
    protected $table = 'mahasiswa';
}

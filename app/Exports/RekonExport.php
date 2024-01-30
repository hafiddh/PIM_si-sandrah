<?php

namespace App\Exports;

use DB;
use App\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;

class RekonExport implements FromCollection
{

    public function  __construct($id)
    {
        $this->id= $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // dd($this->id);
        $nip = DB::table('rekon_data')
                    ->where('id_rekon','=',$this->id)
                    ->leftJoin('data_pegawai', 'rekon_data.nip', '=', 'data_pegawai.nip_baru')                      
                    ->leftJoin('data_keluarga', 'data_keluarga.nip_pegawai', '=', 'rekon_data.nip')  
                    ->get();

        // dd($nip);

        return $nip;
    }
}

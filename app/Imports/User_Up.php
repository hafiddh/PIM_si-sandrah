<?php

namespace App\Imports;

use App\Upload_data;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class User_up implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new Upload_data([
        //         'id' => $row['id'],
        //         'username' => $row['username'],
        //         'name' => $row['name'],
        //         'level' => $row['level'],
        //         'password' => $row['password'],
        //     ]);	

        // return new Upload_data([
        //         'id_opd' => $row['id_opd'],
        //         'nama_opd' => $row['nama_opd'],
        //         'kode_opd' => $row['kode_opd']
        //     ]);	

            // return new Upload_data([
            //     'id_keluarga' => $row['id_keluarga'],
            //     'nip_pegawai' => $row['nip_pegawai'],
            //     'nama_ayah' => $row['nama_ayah'],
            //     'nama_ibu' => $row['nama_ibu'],
            //     'tgl_lhr_ayah' => $row['tgl_lhr_ayah'],
            //     'tgl_lhr_ibu' => $row['tgl_lhr_ibu'],
            //     'nama_p' => $row['nama_p'],
            //     'nip_p' => $row['nip_p'],
            //     'tgl_lhr_p' => $row['tgl_lhr_p'],
            //     'no_b_nikah' => $row['no_b_nikah'],
            //     'tgl_b_nikah' => $row['tgl_b_nikah'],
            //     'pekerjaan_p' => $row['pekerjaan_p'],
            //     'status_p' => $row['status_p'],
            //     'nama_a_1' => $row['nama_a_1'],
            //     'nama_a_2' => $row['nama_a_2'],
            //     'nama_a_3' => $row['nama_a_3'],
            //     'nama_a_4' => $row['nama_a_4'],
            //     'nama_a_5' => $row['nama_a_5'],
            //     'tgl_lhr_a_1' => $row['tgl_lhr_a_1'],
            //     'tgl_lhr_a_2' => $row['tgl_lhr_a_2'],
            //     'tgl_lhr_a_3' => $row['tgl_lhr_a_3'],
            //     'tgl_lhr_a_4' => $row['tgl_lhr_a_4'],
            //     'tgl_lhr_a_5' => $row['tgl_lhr_a_5'],
            //     'kerja_a_1' => $row['kerja_a_1'],
            //     'kerja_a_2' => $row['kerja_a_2'],
            //     'kerja_a_3' => $row['kerja_a_3'],
            //     'kerja_a_4' => $row['kerja_a_4'],
            //     'kerja_a_5' => $row['kerja_a_5'],
            //     'usia_a_1' => $row['usia_a_1'],
            //     'usia_a_2' => $row['usia_a_2'],
            //     'usia_a_3' => $row['usia_a_3'],
            //     'usia_a_4' => $row['usia_a_4'],
            //     'usia_a_5' => $row['usia_a_5']
            // ]);
    }
}

<?php

namespace App\Imports;

use DB;
use App\Keuangan_upload;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class UsersImport implements ToModel, WithStartRow
{
    use Importable;
    /**
    * @param array $row
    * 
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function  __construct($odp, $bulan, $tahun,$nama_file)
    {
        $this->odp= $odp;        
        $this->bulan= $bulan;    
        $this->tahun= $tahun;
        $this->nama = $nama_file;
        $waktu = date('Y-m-d H:i:s');
        $spum_row = DB::table('spum_id')->insertGetId([
            'kode_opd' => $odp,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'nama_file' => $nama_file,
            'waktu_up' => $waktu
        ]);

        $this->idku = $spum_row;
        $last_id1 = DB::select('SELECT MAX(id) as last_id FROM data_spum_gaji');
        $this->last_id1 = $last_id1[0]->last_id;
    }
       
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 14;
    }
    
    public function model(array $row)
    { 
           
        // dd($last_id[0]->last_id);
        $id_now = ceil($row[0]/7);
        $last=$id_now + $this->last_id1;

        if($row[0] % 7==1){
            DB::insert('insert into data_spum_gaji (id, nama_pegawai, gaji_pokok, tun_ese, tun_terpencil, tun_bpjs, pot_pajak, pot_tapera_pk) 
            values (?,?,?,?,?,?,?,?)', [$last, $row[1], $row[3] , $row[4] , $row[5] , $row[6] , $row[7] , $row[8]]);
        }
        else if($row[0] % 7==2){
            DB::update('update data_spum_gaji set 
                tun_su_is = ?,
                tun_fung_umum = ?,
                tkd = ?,
                tun_jkk = ?,
                pot_bpjs = ?,
                pot_tapera_peg = ?
            where id = ?', [ $row[3] , $row[4] , $row[5] , $row[6] , $row[7] , $row[8], $last]);
        }else if($row[0] % 7==3){
            DB::update('update data_spum_gaji set 
            tun_anak = ?,
            tun_fungsi = ?,
            tun_beras = ?,
            tun_jkm = ?,
            pot_wip1 = ?,
            pot_hutang = ?
            where id = ?', [ $row[3] , $row[4] , $row[5] , $row[6] , $row[7] , $row[8], $last]);
        }else if($row[0] % 7==4){
            DB::update('update data_spum_gaji set 
            nip_pegawai = ?,
            jum1 = ?,
            tun_kh = ?,
            tun_pajak = ?,
            tun_tapera = ?,
            pot_iwp8 = ?,
            pot_bulog = ?
            where id = ?', [ $row[1], $row[3] , $row[4] , $row[5] , $row[6] , $row[7] , $row[8], $last]);
        }else if($row[0] % 7==5){
            DB::update('update data_spum_gaji set 
            pembulatan = ?,
            pot_taperum = ?,
            sewa_rumah = ?
            where id = ?', [ $row[6] , $row[7] , $row[8], $last]);
        }else if($row[0] % 7==6){
            DB::update('update data_spum_gaji set 
            jum_kotor = ?,
            pot_jkk = ?,
            potongan = ?
            where id = ?', [  $row[6] , $row[7] , $row[8], $last]);
        }else if($row[0] % 7==0){
            DB::update('update data_spum_gaji set 
            pot_jkm = ?,
            jum_bersih = ?,
            id_opd = ?,
            bulan = ?,
            tahun = ?,
            id_spum = ?
            where id = ?', [ $row[7] , $row[8], $this->odp , $this->bulan , $this->tahun, $this->idku , $last]);
        }     
    }
}

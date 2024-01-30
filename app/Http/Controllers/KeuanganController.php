<?php

namespace App\Http\Controllers;

use DB;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use Session;

class KeuanganController extends Controller
{
    public function show(){
        return view('keuangan.index');
    }
    
    

    public function data_masuk(){

        
        function bulan_indo($tanggal2)
        {
            $bulan2 = [1 =>  'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari'];
            $split = explode('-', $tanggal2);
            return $bulan2[(int) $split[1]];
        }
        $ini2 = date('Y-m-d');
        

        $rekon_data = DB::table('rekon_id')
            ->leftJoin('data_opd', 'rekon_id.kode_opd', '=', 'data_opd.id_opd')
            ->select('bulan','tahun','id','waktu_up','data_opd.nama_opd AS opd','status_rev','rekon_id.updated_at')
            ->where('status_rev', '2')
            ->where('bulan', bulan_indo($ini2))
            ->orderBy('waktu_up', 'desc')
            ->get();
        // dd($rekon_data);
        $rekon_data2 = DB::table('rekon_id')
            ->leftJoin('data_opd', 'rekon_id.kode_opd', '=', 'data_opd.id_opd')
            ->select('bulan','tahun','id','waktu_up','data_opd.nama_opd AS opd','status_rev','rekon_id.updated_at')
            ->where('status_rev', '2')
            ->where('bulan','!=' , bulan_indo($ini2))
            ->orderBy('waktu_up', 'desc')
            ->get();

        return view('keuangan/data_masuk', ['data'=> $rekon_data, 'data2' => $rekon_data2]);
    }

    
    public function detail_valid(Request $request){

        $id = $request->id;

        // dd($id);
        $data_rekon = DB::table('rekon_id')        
                    ->where('id', '=' , $request->id)
                    ->leftJoin('data_opd', 'rekon_id.kode_opd', '=', 'data_opd.id_opd')
                    ->get();
                    
        $data_pegawai = DB::table('data_pegawai')
                    ->select('nama_pegawai','nip_baru')
                    ->get();

        $detail_pegawai =  DB::table('rekon_data')
                            ->leftJoin('data_pegawai', 'rekon_data.nip', '=', 'data_pegawai.nip_baru')
                            ->leftjoin('data_keluarga', 'data_keluarga.nip_pegawai' , '=','data_pegawai.nip_baru')
                            ->where('rekon_data.id_rekon', $request->id)
                            ->get();
                           
        // dd($data_rekon);
        return view('keuangan/detail_masuk', ['id'=>$id, 'data'=> $data_rekon, 'detail_pegawai'=>$detail_pegawai ,'pegawai'=>$data_pegawai]);
    }

    
    public function notif_kill(Request $request)
    {
        DB::table('data_notifikasi')
                ->where('id', $request->id)
                ->update(['status_baca' => "1"]);

                return redirect()->route('keu.data.terkirim');
    }
}

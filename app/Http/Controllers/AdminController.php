<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use DataTables;
use Hash;
use PDF;

class AdminController extends Controller
{

    public function index()
    {
        $aset = DB::table('data_aset')->count();
        return view('admin.index', [
            'aset'      => $aset
        ]);
    }

    //OPD
    public function data_opd()
    {
        return view('admin.data_opd');
    }

    public function get_all_opd(Request $request)
    {
        $pegawai = DB::table('data_opd')
            ->get();

        return Datatables::of($pegawai)->make();
    }

    public function get_detail_opd(Request $request)
    {
        $data = DB::table('data_opd')->where('id_opd', $request->id)->first();
        return response()->json($data);
    }


    public function tambah_opd(Request $request)
    {
        // dd($request);
        DB::table('data_opd')->insert([
            'nama_opd' => $request->nama,
        ]);

        return \redirect(route('admin.opd'))->with('success', 'Data OPD ditambahkan!');
    }


    public function edit_opd(Request $request)
    {
        DB::table('data_opd')
            ->where('id_opd', $request->id)
            ->update([
                'nama_opd' => $request->nama,
            ]);

        return \redirect(route('admin.opd'))->with('success', 'Data OPD diedit!');
    }

    public function hapus_opd(Request $request)
    {
        DB::table('data_opd')->where('id_opd', $request->id)->delete();
        return response()->json();
    }


    //PENGGUNA
    public function data_pengguna()
    {
        $opd =  DB::table('data_opd')->get();
        return view('admin.data_pengguna', [
            'opd' => $opd
        ]);
    }

    public function get_all_pengguna(Request $request)
    {
        $pegawai = DB::table('users')
            ->select('id', 'username', 'name')
            ->where('level', '1')
            ->get();

        return Datatables::of($pegawai)->make();
    }

    public function get_detail_pengguna(Request $request)
    {
        $data = DB::table('users')
            ->where('id', $request->id)
            ->select('id', 'username', 'name')
            ->first();
        return response()->json($data);
    }


    public function set_catatan(Request $request)
    {

        try {
            // return response()->json(['status' => 'success', 'data' => $request->all()], 201);

            DB::table('data_aset')->where('id', $request->id)->update([
                'catatan_admin' => $request->catat
            ]);

            return response()->json(['status' => 'success', 'messages' => 'Catatan disimpan'], 201);
        } catch (QueryException $e) {
            return response()->json(['status' => 'error', 'messages' => $e->errorInfo], 500);
        }
    }


    public function tambah_pengguna(Request $request)
    {
        $cek = DB::table('users')->where('id', $request->opd)->count();
        if ($cek > 0) {
            return \redirect(route('admin.pengguna'))->with('error', 'Data Pengguna untuk OPD ini sudah ada!');
        }
        $nama = DB::table('data_opd')->where('id_opd', $request->opd)->first();
        $password = Hash::make($request->password);
        DB::table('users')->insert([
            'id' => $request->opd,
            'username' => $request->username,
            'name' => $nama->nama_opd,
            'password' => $password,
            'level' => '1',
        ]);

        return \redirect(route('admin.pengguna'))->with('success', 'Data Pengguna ditambahkan!');
    }


    public function edit_pengguna(Request $request)
    {
        $password = Hash::make($request->password);
        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'password' => $password
            ]);

        return \redirect(route('admin.pengguna'))->with('success', 'Password pengguna berhasil diubah!');
    }

    public function hapus_pengguna(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        return response()->json();
    }


    public function data_aset()
    {
        return view('admin.data_aset');
    }

    public function get_all_aset(Request $request)
    {
        $data = DB::table('data_aset')
            ->get();

        return Datatables::of($data)->make();
    }

    public function get_peg_aset(Request $request)
    {
        $data = DB::table('data_aset')
            ->where('data_aset.id_pegawai', $request->id)
            ->leftjoin('data_pegawai', 'data_pegawai.id_pegawai', '=', 'data_aset.id_pegawai')
            ->leftjoin('data_opd', 'data_pegawai.kode_opd', '=', 'data_opd.id_opd')
            ->orderby('data_aset.created_at', 'asc')
            ->select('data_aset.*', 'data_opd.nama_opd', 'data_pegawai.nama_pegawai', 'data_pegawai.nip')
            ->get();

        return Datatables::of($data)->make();
    }


    public function get_aset_det(Request $request)
    {
        $data = DB::table('data_aset')->where('id', $request->id)->first();
        $file = DB::table('tb_file')->where('id_aset', $data->id)->get();

        return response()->json(['data' => $data, 'file' => $file]);
    }


    public function get_aset_rekap(Request $request)
    {

        if ($request->id == '1') {
            $data = DB::table('data_aset')->orderby('opd', 'asc')->get();
            return Datatables::of($data)->make();
        }

        $data = DB::table('data_aset')->where('opd', $request->id)->get();

        return Datatables::of($data)->make();
    }


    public function get_aset_rekap_nama(Request $request)
    {

        $data = DB::table('data_aset')->select('opd')->where('opd', $request->id)->first();

        return response()->json($data);
    }


    public function cetak_surat_aset(Request $request)
    {
        // dd($request->all());
        $data_aset = DB::table('data_aset')->where('id', $request->e_id)->first();
        $data_pegawai = DB::table('data_pegawai')->where('id_pegawai', $data_aset->id_pegawai)->first();
        $data_opd = DB::table('data_opd')->where('id_opd', $data_pegawai->kode_opd)->first();
        $jenis_aset = $data_aset->jenis_aset;
        if ($jenis_aset == 1) {
            $jenis = "aset Tahunan";
        } else if ($jenis_aset == 2) {
            $jenis = "aset Besar";
        } else if ($jenis_aset == 3) {
            $jenis = "aset Sakit";
        } else if ($jenis_aset == 4) {
            $jenis = "aset Melahirkan";
        } else if ($jenis_aset == 5) {
            $jenis = "aset Alasan Penting";
        } else if ($jenis_aset == 6) {
            $jenis = "aset di Luar Tanggungan Negara";
        }
        $id_kop = $request->id_kop;
        // dd($data_aset, $data_pegawai, $data_opd);

        $pdf = PDF::loadview('admin.print', [
            'data_aset' => $data_aset,
            'data_pegawai' => $data_pegawai,
            'data_opd' => $data_opd,
            'jenis_aset' => $jenis,
            'id_kop' => $id_kop,
        ]);
        $judul = $data_pegawai->nama_pegawai . " - Surat aset Pegawai";
        return $pdf->download($judul);
    }


    public function rekap_data_aset()
    {
        $data = DB::table('data_opd')->get();
        return view('admin.rekap_data_aset', ['opd' => $data]);
    }

    public function select_pegawai_opd(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('data_pegawai')
                ->where('nama_pegawai', 'LIKE', "%$cari%")
                ->orWhere('nip', 'LIKE', "%$cari%")
                ->get();
            return response()->json($data);
        } else {
            return response()->json([]);
        }
    }

    public function notif_kill(Request $request)
    {
        // dd($request->id);

        DB::table('data_notifikasi')
            ->where('id', $request->id)
            ->update(['status_baca' => "1"]);

        return \redirect(route('admin.aset'));
    }

    public function data_masuk()
    {

        $rekon_data = DB::table('rekon_id')
            ->leftJoin('data_opd', 'rekon_id.kode_opd', '=', 'data_opd.id_opd')
            ->select('bulan', 'tahun', 'id', 'waktu_up', 'data_opd.nama_opd AS opd', 'status_rev')
            ->where('status_rev', '1')
            ->orderBy('waktu_up', 'desc')
            ->get();

        return view('admin/data_masuk', ['data' => $rekon_data]);
    }

    public function validasi_rekon(Request $request)
    {

        // dd('lol');
        $id = $request->id;

        // dd($id);
        $data_rekon = DB::table('rekon_id')
            ->where('id', '=', $request->id)
            ->leftJoin('data_opd', 'rekon_id.kode_opd', '=', 'data_opd.id_opd')
            ->first();

        $bulan = $data_rekon->bulan;
        $tahun = $data_rekon->tahun;
        $tahun_num = $tahun;
        if ($bulan == 'Januari') {
            $tahun_num = $tahun - 1;
            $bulan_num = 'Desember';
        } else if ($bulan == 'Februari') {
            $bulan_num = 'Januari';
        } else if ($bulan == 'Maret') {
            $bulan_num = 'Februari';
        } else if ($bulan == 'April') {
            $bulan_num = 'Maret';
        } else if ($bulan == 'Mei') {
            $bulan_num = 'April';
        } else if ($bulan == 'Juni') {
            $bulan_num = 'Mei';
        } else if ($bulan == 'Juli') {
            $bulan_num = 'Juni';
        } else if ($bulan == 'Agustus') {
            $bulan_num = 'Juli';
        } else if ($bulan == 'September') {
            $bulan_num = 'Agustus';
        } else if ($bulan == 'Oktober') {
            $bulan_num = 'September';
        } else if ($bulan == 'November') {
            $bulan_num = 'Oktober';
        } else if ($bulan == 'Desember') {
            $bulan_num = 'November';
        }

        $data_pegawai = DB::table('data_pegawai')
            ->select('nama_pegawai', 'nip_baru')
            ->get();

        $detail_pegawai =  DB::table('rekon_data')
            ->leftJoin('data_pegawai', 'rekon_data.nip', '=', 'data_pegawai.nip_baru')
            ->leftjoin('data_keluarga', 'data_keluarga.nip_pegawai', '=', 'data_pegawai.nip_baru')
            ->where('rekon_data.id_rekon', $request->id)
            ->get();


        //VALIDASI

        $rekon_old = DB::table('rekon_id')
            ->where('kode_opd', '=', $data_rekon->id_opd)
            ->where('bulan', '=', $bulan_num)
            ->where('tahun', '=', $tahun_num)
            ->first();
        // dd($bulan_num, $tahun_num);


        $data_rekon_old =  DB::table('rekon_data')
            ->leftJoin('data_pegawai', 'rekon_data.nip', '=', 'data_pegawai.nip_baru')
            ->where('rekon_data.id_rekon', $rekon_old->id)
            ->get();

        $det_valid = DB::select('select T2.* from rekon_data as T2 where id_rekon = ? and not exists (select * from rekon_data as T1 where id_rekon = ? AND T1.nip = T2.nip)', [$data_rekon->id, $rekon_old->id]);

        $det_valid2 = DB::select('select T2.* from rekon_data as T2 where id_rekon = ? and not exists (select * from rekon_data as T1 where id_rekon = ? AND T1.nip = T2.nip)', [$rekon_old->id, $data_rekon->id]);

        // if($det_valid != null){
        //     dd('1');
        // }else{
        //     dd('2');
        // }
        // $det_pindah = DB::table('pegawai_opd')
        //                     ->leftJoin('data_pegawai', 'pegawai_opd.id_pegawai', '=', 'data_pegawai.id_pegawai')
        //                     ->where('data_pegawai.nip_baru', $det_valid[0]->nip)
        //                     ->orderBy('tgl', 'desc')
        //                     ->first();
        foreach ($det_valid as $lol) {
            DB::table('rekon_data')
                ->where('nip', $lol->nip)
                ->update(['stat' => '1']);
        }

        return view('admin/detail_masuk', ['id' => $id, 'data' => $data_rekon, 'detail_pegawai' => $detail_pegawai, 'pegawai' => $data_pegawai, 'det_valid' => $det_valid, 'det_valid2' => $det_valid2]);
    }


    public function rekon_tolak(Request $request)
    {
        $id = $request->id;
        $text = $request->t_revisi;

        // dd($id, $text);
        DB::table('rekon_id')
            ->where('id', $id)
            ->update([
                'status_rev' => '3',
                'keterangan_rev' => $text
            ]);

        $rekon = DB::table('rekon_id')
            ->where('id', $id)->get();

        $bulan = $rekon[0]->bulan;
        $tahun = $rekon[0]->tahun;
        $kode_opd =  $rekon[0]->kode_opd;

        $text = "Data Rekon bulan $bulan tahun $tahun ditolak, silakan periksa kembali!";
        $nootif = DB::insert(
            'INSERT INTO data_notifikasi (tentang, isi, id_opd, status_baca) VALUES (?,?,?,?);',
            ['Data Rekon ditolak', $text,  $kode_opd, '0']
        );

        $request->session()->put('kon', '0');
        $request->session()->put('status', 'Data dikembalikan untuk diubah!');
        return redirect()->route('admin.data.masuk');
    }


    public function rekon_valid(Request $request)
    {

        $id = $request->id;



        // dd($id);
        DB::table('rekon_id')
            ->where('id', $id)
            ->update(['status_rev' => '2']);

        $rekon = DB::table('rekon_id')
            ->where('id', $id)->get();

        $opd = DB::table('data_opd')
            ->where('id_opd', '=', $rekon[0]->kode_opd)
            ->select('nama_opd')
            ->get();

        $rekon = DB::table('rekon_id')
            ->where('id', $id)->get();

        $bulan = $rekon[0]->bulan;
        $tahun = $rekon[0]->tahun;
        $kode_opd =  $rekon[0]->kode_opd;
        $opd2 = $opd[0]->nama_opd;

        $text = "Data Rekon OPD $opd2 bulan $bulan tahun $tahun sudah divalidasi. ";
        $nootif = DB::insert(
            'INSERT INTO data_notifikasi (tentang, isi, id_opd, status_baca) VALUES (?,?,?,?);',
            [$opd2, $text,  '101', '0']
        );

        $text3 = "DATA REKON TERVALIDASI";
        $text2 = "Data Rekon bulan $bulan tahun $tahun sudah divalidasi. Terima kasih telah melakukan rekon data.";
        $nootif = DB::insert(
            'INSERT INTO data_notifikasi (tentang, isi, id_opd, status_baca) VALUES (?,?,?,?);',
            [$text3, $text2,  $kode_opd, '0']
        );

        $request->session()->put('kon', '0');
        $request->session()->put('status', 'Data diteruskan ke Keuangan!');
        return redirect()->route('admin.data.terkirim');
    }


    public function data_terkirim()
    {

        $rekon_data = DB::table('rekon_id')
            ->leftJoin('data_opd', 'rekon_id.kode_opd', '=', 'data_opd.id_opd')
            ->select('bulan', 'tahun', 'id', 'waktu_up', 'data_opd.nama_opd AS opd', 'status_rev')
            ->where('status_rev', '2')
            ->orderBy('waktu_up', 'desc')
            ->get();

        return view('admin/data_valid', ['data' => $rekon_data]);
    }


    public function detail_valid(Request $request)
    {

        $id = $request->id;

        // dd($id);
        $data_rekon = DB::table('rekon_id')
            ->where('id', '=', $request->id)
            ->leftJoin('data_opd', 'rekon_id.kode_opd', '=', 'data_opd.id_opd')
            ->get();

        $data_pegawai = DB::table('data_pegawai')
            ->select('nama_pegawai', 'nip_baru')
            ->get();

        $detail_pegawai =  DB::table('rekon_data')
            ->leftJoin('data_pegawai', 'rekon_data.nip', '=', 'data_pegawai.nip_baru')
            ->leftjoin('data_keluarga', 'data_keluarga.nip_pegawai', '=', 'data_pegawai.nip_baru')
            ->where('rekon_data.id_rekon', $request->id)
            ->get();

        // dd($data_rekon);
        return view('admin/detail_valid', ['id' => $id, 'data' => $data_rekon, 'detail_pegawai' => $detail_pegawai, 'pegawai' => $data_pegawai]);
    }



    public function getClientIps()
    {
        $clientIP = \Request::getClientIp(true);
        dd($clientIP);
    }
}

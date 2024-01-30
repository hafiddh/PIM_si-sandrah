<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Validator;
use Response;

class opdController extends Controller
{


    public function index()
    {
        $aset = DB::table('data_aset')->where('opd', auth()->user()->name)->count();
        return view('opd.index', [
            'aset'      => $aset
        ]);
    }

    public function data_aset()
    {
        return view('opd.input_data', []);
    }


    public function get_tot_aset(Request $request)
    {
        $year = date("Y");
        $data = DB::table('data_aset')
            ->whereYear('created_at', '=', $year)
            ->sum('id');

        return response()->json($data);
    }


    public function tambah_aset(Request $request)
    {
        try {
            // return response()->json(['status' => 'success', 'data' => $request->all()], 201);


            $datID = DB::table('data_aset')->insertgetid([
                'opd' => auth()->user()->name,
                'nama' => $request->nama,
                'kode' => $request->kode_aset,
                'merk' => $request->merk,
                'tipe' => $request->tipe,
                'tahun' => $request->tahun,
                'asal' => $request->asal,
                'harga' => $request->harga,
                'pemegang' => $request->pemegang,
                'kondisi' => $request->kondisi,
                'keterangan' => $request->keterangan
            ]);


            $file = $request->file('foto_aset');
            $num = 1;
            foreach ($file as $fil) {
                $extension = $fil->getClientOriginalExtension();
                $aset_name = $num . '_ASET_' . auth()->user()->id . '_' . date('YmdHi') . '.' . $extension;

                $tujuan_upload = 'file_up';
                $fil->move($tujuan_upload, $aset_name);
                $num++;

                DB::table('tb_file')->insert([
                    'id_aset' => $datID,
                    'file' => $aset_name,
                ]);
            }

            return response()->json(['status' => 'success', 'messages' => 'proses success'], 201);
        } catch (QueryException $e) {
            return response()->json(['status' => 'error', 'messages' => $e->errorInfo], 500);
        }
    }


    public function edit_aset(Request $request)
    {
        try {
            // return response()->json(['status' => 'success', 'data' => $request->all()], 201);


            $datID = DB::table('data_aset')->where('id', $request->id_aset)->update([
                'opd' => auth()->user()->name,
                'nama' => $request->nama,
                'kode' => $request->kode_aset,
                'merk' => $request->merk,
                'tipe' => $request->tipe,
                'tahun' => $request->tahun,
                'asal' => $request->asal,
                'harga' => $request->harga,
                'pemegang' => $request->pemegang,
                'kondisi' => $request->kondisi,
                'keterangan' => $request->keterangan
            ]);

            if ($request->file('foto_aset')) {
                $file = $request->file('foto_aset');
                $num = 1;
                foreach ($file as $fil) {
                    $extension = $fil->getClientOriginalExtension();
                    $aset_name = $num . '_ASET_' . auth()->user()->id . '_' . date('YmdHi') . '.' . $extension;

                    $tujuan_upload = 'file_up';
                    $fil->move($tujuan_upload, $aset_name);
                    $num++;

                    DB::table('tb_file')->insert([
                        'id_aset' => $request->id_aset,
                        'file' => $aset_name,
                    ]);
                }
            }


            return response()->json(['status' => 'success', 'messages' => 'proses success'], 201);
        } catch (QueryException $e) {
            return response()->json(['status' => 'error', 'messages' => $e->errorInfo], 500);
        }
    }


    public function get_aset(Request $request)
    {
        $data = DB::table('data_aset')
            ->where('opd', auth()->user()->name)
            ->get();

        return Datatables::of($data)->make();
    }

    public function get_aset_det(Request $request)
    {
        $data = DB::table('data_aset')->where('id', $request->id)->first();
        $file = DB::table('tb_file')->where('id_aset', $data->id)->get();

        return response()->json(['data' => $data, 'file' => $file]);
    }

    public function hapus_aset(Request $request)
    {
        DB::table('data_aset')->where('id', $request->id)->delete();
        return response()->json();
    }


    public function notif_kill(Request $request)
    {
        $id = $request->input('id');
        $rev = DB::table('data_notifikasi')
            ->where('id_opd', $id)
            ->update(['status_baca' => "1"]);

        return $id;
    }



    //pegawai

    public function get_pegawai(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('data_pegawai')->where('nama_pegawai', 'LIKE', "%$cari%")->orWhere('nip_baru', 'LIKE', "%$cari%")->get();
            return response()->json($data);
        } else {
            return response()->json(['pesan' => 'Input Kosong']);
        }
    }


    public function download_file(Request $request)
    {
        $file = public_path() . "/file_up/" . $request->id;

        $headers = array('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return Response::download($file, $request->id, $headers);
    }
}

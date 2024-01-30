<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Imports\User_up;
use Maatwebsite\Excel\Facades\Excel;

class Con_upload_data extends Controller
{
    public function store(Request $request){
        
        $file = $request->file('file');
        
        (new User_up())->import($file);
        
        // dd($file);
        return back()->withStatus('Data berhasil diupload');
    }
}

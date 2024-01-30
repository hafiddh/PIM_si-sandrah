<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\opdController;

Route::get('/', function () {
        return view('welcome');
})->name('login');

Route::get('/home', function () {
        return view('welcome');
})->name('login');

Route::get('/login', function () {
        return view('welcome');
})->name('login');

Route::get('/up_data', function () {
        return view('up');
});
Route::post('/up', 'Con_upload_data@store');

Route::post('/login', 'LoginController@login')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/download-file/{id}', 'opdController@download_file')->name('download.file');

// Admin
Route::group(['middleware' => ['auth', 'ceklevel:3']], function () {

        Route::get('/admin', 'AdminController@index');

        Route::get('/admin/data_pegawai', 'AdminController@data_pegawai')->name('admin.pegawai');
        Route::get('/admin/edit_pegawai/', 'AdminController@edit_pegawai');
        Route::get('/admin/data_pegawai/get_data', 'AdminController@get_data');

        Route::get('/admin/get-detail-pegawai', 'AdminController@get_detail_pegawai')->name('admin.get.pegawai');
        Route::post('/admin/tambah-pegawai', 'AdminController@tambah_pegawai')->name('admin.tambah.pegawai');
        Route::post('/admin/edit-pegawai', 'AdminController@edit_pegawai')->name('admin.edit.pegawai');
        Route::get('/admin/hapus-pegawai', 'AdminController@hapus_pegawai')->name('admin.hapus.pegawai');

        Route::get('/admin/opd', 'AdminController@data_opd')->name('admin.opd');
        Route::post('/admin/tambah_opd', 'AdminController@tambah_opd')->name('admin.tambah.opd');
        Route::post('/admin/edit_opd', 'AdminController@edit_opd')->name('admin.edit.opd');
        Route::delete('/admin/hapus_opd', 'AdminController@hapus_opd')->name('admin.hapus.opd');
        Route::get('/admin/get_all_opd', 'AdminController@get_all_opd')->name('admin.get.all.opd');;
        Route::get('/admin/get_detail_opd', 'AdminController@get_detail_opd')->name('admin.get.det.opd');

        Route::get('/admin/pengguna', 'AdminController@data_pengguna')->name('admin.pengguna');
        Route::post('/admin/tambah_pengguna', 'AdminController@tambah_pengguna')->name('admin.tambah.pengguna');
        Route::post('/admin/edit_pengguna', 'AdminController@edit_pengguna')->name('admin.edit.pengguna');
        Route::delete('/admin/hapus_pengguna', 'AdminController@hapus_pengguna')->name('admin.hapus.pengguna');
        Route::get('/admin/get_all_pengguna', 'AdminController@get_all_pengguna')->name('admin.get.all.pengguna');;
        Route::get('/admin/get_detail_pengguna', 'AdminController@get_detail_pengguna')->name('admin.get.det.pengguna');


        //Data Cuti

        Route::get('/admin/data-aset', 'AdminController@data_aset')->name('admin.aset');
        Route::post('/admin/tambah_aset', 'AdminController@tambah_aset')->name('admin.tambah.aset');
        Route::post('/admin/edit_aset', 'AdminController@edit_aset')->name('admin.edit.aset');
        Route::delete('/admin/hapus_aset', 'AdminController@hapus_aset')->name('admin.hapus.aset');
        Route::get('/admin/get_all_aset', 'AdminController@get_all_aset')->name('admin.get.aset');
        Route::get('/admin/get_detail_aset', 'AdminController@get_aset_det')->name('admin.get.aset.det');
        Route::get('/admin/get-rekap', 'AdminController@get_aset_rekap')->name('admin.get.aset.search');
        Route::get('/admin/set-catat', 'AdminController@set_catatan')->name('admin.set.catat');
        Route::get('/admin/get-rekap-nama', 'AdminController@get_aset_rekap_nama')->name('admin.get.aset.det.nama');

        

        Route::get('/admin/rekap-data-aset', 'AdminController@rekap_data_aset')->name('admin.rekap.aset');

        Route::post('/admin/cetak-surat-aset', 'AdminController@cetak_surat_aset')->name('admin.cetak.aset');
        Route::get('/admin/select_pegawai_opd', 'AdminController@select_pegawai_opd')->name('admin.select.pegawai');
        Route::get('/admin/get_peg_aset', 'AdminController@get_peg_aset')->name('admin.get.aset.peg');

        Route::get('/admin/data_terkirim', 'AdminController@data_terkirim')->name('admin.data.terkirim');
        Route::get('/admin/detail_valid/{id}', 'AdminController@detail_valid');

        Route::get('/admin/data_masuk', 'AdminController@data_masuk')->name('admin.data.masuk');
        Route::get('/admin/validasi_rekon/{id}', 'AdminController@validasi_rekon');

        Route::post('/admin/rekon_tolak', 'AdminController@rekon_tolak');
        Route::post('/admin/rekon_valid', 'AdminController@rekon_valid');

        Route::get('/admin/kill_notif/{id}', 'AdminController@notif_kill');
        Route::get('/admin/ip/', 'AdminController@getClientIps');
});

//opd
Route::group(['middleware' => ['auth', 'ceklevel:1']], function () {
        Route::get('/opd', 'opdController@index')->name('opd.index');
        Route::get('/opd/data-aset', 'opdController@data_aset')->name('opd.data.aset');
        Route::post('/opd/tambah_aset', 'opdController@tambah_aset')->name('opd.tambah.aset');
        Route::post('/opd/edit_aset', 'opdController@edit_aset')->name('opd.edit.aset');
        Route::get('/opd/get_aset', 'opdController@get_aset')->name('opd.get.aset');
        Route::get('/opd/get_aset_det', 'opdController@get_aset_det')->name('opd.get.aset.det');
        Route::get('/opd/hapus-aset', 'opdController@hapus_aset')->name('opd.hapus.aset');
});

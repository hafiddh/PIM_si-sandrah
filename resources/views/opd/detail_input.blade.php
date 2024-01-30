@extends('opd/opd_temp')
@section('judul', 'Detail Data Masuk')
@section('side_kel', 'active')
@section('side_kel2', 'show')
@section('side_dama', 'active')
@section('judul2', 'Detail Data')

@section('tambah_css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
@endsection



@section('isi')
    <?php $revisi1 = DB::table('rekon_id')
    
        ->where('id', '=', $id)
        ->where('bulan', '=', $data[0]->bulan)
        ->where('tahun', '=', $data[0]->tahun)
        ->select('status_rev')
        ->get();
    // dd();
    ?>

    @if ($revisi1[0]->status_rev == '0' || $revisi1[0]->status_rev == '3')

        @php
            $peg = DB::table('data_pegawai')
                ->where('kode_opd', auth()->user()->id)
                ->get();
            // dd($peg);
        @endphp
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="container form-group">

                        <form action="{{ url('/opd/input_data/edit_rekon/' . $data[0]->id . '/tambah_pegawai') }}"
                            method="post">
                            {{ csrf_field() }}
                            <label class="form-control-label " for=""></label>
                            <select class="form-control placeh" style="width:500px;" name="pegawai_rekon"
                                data-toggle="select" required>
                                @foreach ($peg as $peg)
                                    <option value="{{ $peg->nip_baru }}">{{ $peg->nama_pegawai }} (
                                        {{ $peg->nip_baru }} )</option>
                                @endforeach
                            </select>
                            <div class="col-md-12 text-center my-3">
                                <button type="submit" class="btn btn-primary "><i class="fa fa-plus"> </i> Tambah
                                    pegawai</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                @if ($data[0]->status_rev == '0')

                @else

                    <div class="card-header">
                        <h3 class="mb-0 float-right"><button id="print_rekon" style="width: 200px;"
                                class="btn btn-primary">Print
                                Rekon &nbsp;<i class="fa fa-print"></i></button></h3>
                    </div>
                @endif
                <div id="data_print">
                    <table id="tb_head" width="100%" class="mt-4">
                        <thead class="thead-light text-center">
                            <tr>
                                <th style="width:90%; display: block; padding-left:10%;">
                                    <a style="font-size: 24px; ">DATA REKONSILIASI PEGAWAI NEGERI SIPIL
                                        ORGANISASI PERANGKAT DAERAH</a><br>
                                    <a style="font-size: 20px;">{{ $data[0]->nama_opd }}</a><br>
                                    <a style="font-size: 20px;">KEADAAN BULAN :
                                        {{ strtoupper($data[0]->bulan) . ' ' . $data[0]->tahun }}</a>
                                </th>
                                <th id="hide_1" style="width: 10%">
                                    <?php
                                    $data2 = 'Rekon BKPSDMD Kab. Morowali - Data Rekon - ' . date('d/m/Y');
                                    ?>
                                    <img
                                        src="https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=100x100&chl={{ $data2 }}" />
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <div class="table-responsive py-4">
                        <table class="table table-bordered" id="datatable_pegawai">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th rowspan="3" style="vertical-align: middle;">NO</th>
                                    <th colspan="5">DATA PNS</th>
                                    <th colspan="8">DATA KELUARGA</th>

                                    @if ($revisi1[0]->status_rev == '0' || $revisi1[0]->status_rev == '3')
                                        <th rowspan="3" style="vertical-align: middle;">AKSI</th>
                                    @endif
                                </tr>
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle;">NAMA / NIP / NO. KTP</th>
                                    <th rowspan="2" style="vertical-align: middle;">NO. HP / NO. NPWP</th>
                                    <th rowspan="2" style="vertical-align: middle;">PANGKAT / <br>GOL TERAKHIR</th>
                                    <th rowspan="2" style="vertical-align: middle;">JABATAN STRUKTURAL /<br>FUNGSIONAL
                                        /<br>JFU
                                    </th>
                                    <th rowspan="2" style="vertical-align: middle;">NAMA ORANG TUA<br>(AYAH/IBU)<br>(TGL,
                                        BLN
                                        THN LAHIR)</th>
                                    <th colspan="4" style="vertical-align: middle;">SUAMI / ISTRI</th>
                                    <th colspan="4" style="vertical-align: middle;">ANAK</th>
                                </tr>
                                <tr>
                                    <th style="vertical-align: middle;">NAMA / NIP / TGL. LAHIR</th>
                                    <th style="vertical-align: middle;">NO / TGL BUKU NIKAH</th>
                                    <th style="vertical-align: middle;">PEKERJAAN</th>
                                    <th style="vertical-align: middle;">STATUS<br>DALAM<br>DAFTAR<br>GAJI</th>
                                    <th style="vertical-align: middle;">NAMA</th>
                                    <th style="vertical-align: middle;">TANGGAL LAHIR</th>
                                    <th style="vertical-align: middle;">PEKERJAAN</th>
                                    <th style="vertical-align: middle;">USIA<br>(THN)</th>
                                </tr>
                            </thead>
                            <tbody class="table-striped text-center">

                                @php
                                    function hitung_umur($tanggal_lahir)
                                    {
                                        // dd($tanggal_lahir);
                                        $birthDate = new DateTime($tanggal_lahir);
                                        $today = new DateTime('today');
                                        if ($birthDate > $today) {
                                            return '';
                                        }
                                        $y = $today->diff($birthDate)->y;
                                        $m = $today->diff($birthDate)->m;
                                        $d = $today->diff($birthDate)->d;
                                        return $y;
                                    }
                                    
                                    // echo hitung_umur('1980-12-01');
                                @endphp

                                @foreach ($detail_pegawai as $det)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="text-align: left">
                                            {{ $det->nama_pegawai }}<br><br>{{ $det->nip_baru }}<br><br>{{ $det->nik }}
                                        </td>
                                        <td>{{ $det->no_hp }}<br><br>{{ $det->npwp }}</td>
                                        <td>{{ $det->pangkat }} &nbsp;&nbsp; {{ $det->gol_terakhir }}</td>
                                        <td>
                                            <?php if ($det->jab_fung_tertentu == null && $det->jab_fung_umum == null) {
                                                echo 'Struktural';
                                            } elseif ($det->jab_struk_nama == null && $det->jab_fung_umum == null) {
                                                echo 'Fungsional';
                                            } elseif ($det->jab_struk_nama == null && $det->jab_fung_tertentu == null) {
                                                echo 'Fungsional Umum';
                                            } ?>
                                        </td>
                                        <td>{{ $det->nama_ayah }}<br>
                                            @php
                                                if ($det->tgl_lhr_ayah == null) {
                                                    echo '';
                                                } else {
                                                    echo '( ';
                                                    echo $det->tgl_lhr_ayah;
                                                    echo ' )';
                                                }
                                            @endphp

                                            <br><br>{{ $det->nama_ibu }}<br>
                                            @php
                                                if ($det->tgl_lhr_ibu == null) {
                                                    echo '';
                                                } else {
                                                    echo '( ';
                                                    echo $det->tgl_lhr_ibu;
                                                    echo ' )';
                                                }
                                            @endphp
                                        </td>
                                        <td>{{ $det->nama_p }}<br><br>{{ $det->nip_p }}<br><br>{{ $det->tgl_lhr_p }}
                                        </td>
                                        <td>{{ $det->no_b_nikah }}<br><br>{{ $det->tgl_b_nikah }}</td>
                                        <td>{{ $det->pekerjaan_p }}</td>
                                        <td>{{ $det->status_p }}</td>
                                        <td>{{ $det->nama_a_1 }}<br><br>{{ $det->nama_a_2 }}<br>{{ $det->nama_a_3 }}<br>{{ $det->nama_a_4 }}<br>{{ $det->nama_a_5 }}
                                        </td>
                                        <td>{{ $det->tgl_lhr_a_1 }}<br><br>{{ $det->tgl_lhr_a_2 }}<br>{{ $det->tgl_lhr_a_3 }}<br>{{ $det->tgl_lhr_a_4 }}<br>{{ $det->tgl_lhr_a_5 }}
                                        </td>
                                        <td>{{ $det->kerja_a_1 }}<br><br>{{ $det->kerja_a_2 }}<br>{{ $det->kerja_a_3 }}<br>{{ $det->kerja_a_4 }}<br>{{ $det->kerja_a_5 }}
                                        </td>
                                        <td>
                                            @php
                                                if($det->tgl_lhr_a_1 == null){
                                                    echo '';
                                                }else{
                                                    echo hitung_umur($det->tgl_lhr_a_1);
                                                    echo '<br><br>';                     
                                                }

                                                
                                                if($det->tgl_lhr_a_2 == null){
                                                    echo '';
                                                }else{
                                                    echo hitung_umur($det->tgl_lhr_a_2);
                                                    echo '<br><br>';                     
                                                }
                                            @endphp
                                        </td>

                                        @if ($revisi1[0]->status_rev == '0' || $revisi1[0]->status_rev == '3')
                                            <td>
                                                <form
                                                    action="{{ url('opd/input_data/edit_rekon/hapus_rekon/' . $det->id) }}"
                                                    method="post" class="d-inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i title="Hapus"
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @if ($revisi1[0]->status_rev == '3')
        {{-- @php
            $det_valid = DB::table('rekon_data')->where('id_rekon', $data[0]->id)->where('stat', '1')->get();
            // dd($det_valid);
        @endphp
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header text-center">
                        <h3 class="mb-0">Tabel Validasi</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-bordered" id="datatable_pegawai">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th style="vertical-align: middle;">NO</th>
                                    <th style="vertical-align: middle;">Nama</th>
                                    <th style="vertical-align: middle;">NIP</th>
                                    <th style="vertical-align: middle;">No.SK</th>
                                    <th style="vertical-align: middle;">Tanggal SK</th>
                                    <th style="vertical-align: middle;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="table-striped text-center">
                                @foreach ($det_valid as $det)
                                    @php
                                        $det_peg = DB::table('pegawai_opd')
                                            ->leftJoin('data_pegawai', 'pegawai_opd.id_pegawai', '=', 'data_pegawai.id_pegawai')
                                            ->where('data_pegawai.nip_baru', $det->nip)
                                            ->orderBy('tgl', 'desc')
                                            ->first();
                                        
                                        $det_opd_old = DB::table('data_opd')
                                            ->where('id_opd', $det_peg->opd_old)
                                            ->first();
                                        $det_opd_new = DB::table('data_opd')
                                            ->where('id_opd', $det_peg->opd)
                                            ->first();
                                        // dd($det_peg);
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="text-align: left; vertical-align: middle;">
                                            {{ $det_peg->nama_pegawai }}
                                        </td>
                                        <td style="vertical-align: middle;">{{ $det_peg->nip_baru }}</td>
                                        <td style="vertical-align: middle;">{{ $det_peg->no_sk }}</td>
                                        <td style="vertical-align: middle;">{{ $det_peg->tgl }}</td>
                                        <td style="vertical-align: middle;">
                                            {{ ucwords($det_opd_old->nama_opd) }}&nbsp;&nbsp; <i
                                                class="fa fa-arrow-right" aria-hidden="true"></i>
                                            &nbsp;&nbsp;{{ ucwords($det_opd_new->nama_opd) }}</th>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header text-center">
                        <h3 class="mb-0">Revisi dari BKPSDMD </h3>
                    </div>
                    <div class="container py-4">
                        @php
                            $text = DB::table('rekon_id')
                                ->where('id', $data[0]->id)
                                ->first();
                            echo $text->keterangan_rev;
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- {{ dd($data) }} --}}
    @if ($revisi1[0]->status_rev == '0' || $revisi1[0]->status_rev == '3')
        <div class="row pb-5">
            <div class="col-12">
                <form id="form_input" action="{{ url('/opd/input_rekon/') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $data[0]->id }}">
                    <button type="button" style="width: 100%" id="but_input"
                        class="btn inputan text-white btn-primary">Input Rekon &nbsp;&nbsp;<i title=""
                            class="fa fa-share"></i></button>
                </form>
            </div>
        </div>
    @endif



    @if (session('status'))
        <div id="alert"></div>
    @endif
@endsection

@section('tambah_js')
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/sweet.min.js') }}"></script>

    <script type="text/javascript">
        $('.placeh').select2({
            placeholder: 'Cari berdasarkan Nama atau NIP ...',
            // ajax: {
            //     url: '/opd/get_pegawai_opd',
            //     dataType: 'json',
            //     delay: 250,
            //     processResults: function(data) {
            //         return {
            //             results: $.map(data, function(item) {
            //                 return {
            //                     text: '' + item.nama_pegawai + ' (' + item.nip_baru + ')',
            //                     id: item.nip_baru
            //                 }
            //             })
            //         };
            //     },
            //     cache: true
            // }
        });
    </script>

    <script>
        $(document).ready(function() {

            $("#hide_1").hide();
            $('#datatable_pegawai').DataTable({
                paging: false,
                "info": false,
                searching: false,
                autoWidth: true
            });
        });
    </script>

    <script>
        if ($('#alert').length > 0) {
            if ({{ session('kon') }} == "1") {
                swal("{{ session('status') }}", {
                    icon: "warning",
                });
            } else {
                swal("{{ session('status') }}", {
                    icon: "success",
                });
            }
        }
    </script>

    <script>
        $("#but_input").click(function() {
            swal({
                    title: "Apakah anda yakin?",
                    text: "Pastikan Data Rekon sudah sesuai!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#form_input').submit();
                    } else {
                        // swal("Your imaginary file is safe!");
                    }
                });
        });
    </script>

    <script>
        function printData2() {
            var divToPrint = document.getElementById("data_print");
            var htmlToPrint = '' +
                '<style type="text/css">' +
                '#tb_head th, tb_head td {' +
                'border: 0px;' +
                '}' +
                '#datatable_pegawai th, #datatable_pegawai td {' +
                'border: 1px solid black;' +
                'padding:0.5em;' +
                '}' +
                '</style>';
            htmlToPrint += divToPrint.outerHTML;
            newWin = window.open("");
            newWin.document.write(htmlToPrint);
            newWin.print();
            newWin.close();
        }

        $('#print_rekon').on('click', function() {
            $("#hide_1").show();
            printData2();
            $("#hide_1").hide();
        })
    </script>

    <?php
    Session::forget('kon');
    Session::forget('status');
    ?>
@endsection

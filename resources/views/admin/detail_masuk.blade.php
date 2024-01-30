@extends('admin/temp_admin')
@section('judul', 'Detail Data Masuk')
@section('side_kel', 'active')
@section('side_kel2', 'show')
@section('side_dama', 'active')
@section('judul2', 'Detail Data Rekon')

@section('tambah_css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
@endsection



@section('isi')

    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header text-center">
                    <h3 class="mb-0">DATA REKONSILIASI PEGAWAI NEGERI SIPIL ORGANISASI PERANGKAT DAERAH</h3>
                    <h3>{{ $data->nama_opd }}</h3>
                    <h3 style="margin-top: -10px">KEADAAN BULAN :
                        {{ strtoupper($data->bulan) . ' ' . $data->tahun }}
                    </h3>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-bordered" id="datatable_pegawai">
                        <thead class="thead-light text-center">
                            <tr>
                                <th rowspan="3" style="vertical-align: middle;">NO</th>
                                <th colspan="5">DATA PNS</th>
                                <th colspan="8">DATA KELUARGA</th>
                                {{-- <th rowspan="3" style="vertical-align: middle;">AKSI</th> --}}
                            </tr>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle;">NAMA / NIP / NO. KTP</th>
                                <th rowspan="2" style="vertical-align: middle;">NO. HP / NO. NPWP</th>
                                <th rowspan="2" style="vertical-align: middle;">PANGKAT / <br>GOL TERAKHIR</th>
                                <th rowspan="2" style="vertical-align: middle;">JABATAN STRUKTURAL /<br>FUNGSIONAL /<br>JFU
                                </th>
                                <th rowspan="2" style="vertical-align: middle;">NAMA ORANG TUA<br>(AYAH/IBU)<br>(TGL, BLN
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
                                            if($det->tgl_lhr_ayah == NULL ){
                                                echo '';
                                            }else{
                                                echo '( ';
                                                echo $det->tgl_lhr_ayah;                                                    
                                                echo ' )';
                                            }                                                
                                        @endphp

                                        <br><br>{{ $det->nama_ibu }}<br>
                                        @php
                                            if($det->tgl_lhr_ibu == NULL ){
                                                echo '';
                                            }else{
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
                                    {{-- <td>
                                            <form action="{{ url('opd/input_data/edit_rekon/hapus_rekon/' . $det->id) }}"
                                                method="post" class="d-inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"><i title="Hapus"
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header text-center">
                    <h3 class="mb-0">Tabel Validasi</h3>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-bordered" id="datatable_rev">
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
                            @if ($det_valid != null)

                                @foreach ($det_valid as $det)
                                    @php
                                        $det_peg = DB::table('data_pegawai')
                                            ->leftJoin('pegawai_opd', 'pegawai_opd.id_pegawai', '=', 'data_pegawai.id_pegawai')
                                            ->where('data_pegawai.nip_baru', $det->nip)
                                            ->orderBy('tgl', 'desc')
                                            ->first();
                                        // dd($det_valid);
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
                                            @php
                                                if($det_opd_old == null){
                                                    echo '-';
                                                }else{
                                                    echo ucwords($det_opd_old->nama_opd).'&nbsp;&nbsp;';
                                                    echo '<i class="fa fa-arrow-right" aria-hidden="true"></i>';
                                                    echo '&nbsp;&nbsp;'. ucwords($det_opd_new->nama_opd);
                                                }
                                            @endphp
                                        </td> 
                                    </tr>
                                @endforeach

                            @endif

                            @if ($det_valid2 != null)
                                @foreach ($det_valid2 as $det2)
                                    @php
                                        $det_peg2 = DB::table('data_pegawai')
                                            ->leftJoin('pegawai_opd', 'pegawai_opd.id_pegawai', '=', 'data_pegawai.id_pegawai')
                                            ->where('data_pegawai.nip_baru', $det2->nip)
                                            ->orderBy('tgl', 'desc')
                                            ->first();
                                        // dd($det_peg2);
                                        $det_opd_old2 = DB::table('data_opd')
                                            ->where('id_opd', $det_peg2->opd_old)
                                            ->first();
                                        $det_opd_new2 = DB::table('data_opd')
                                            ->where('id_opd', $det_peg2->opd)
                                            ->first();
                                        // dd($det_opd_new2);
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="text-align: left; vertical-align: middle;">
                                            {{ $det_peg2->nama_pegawai }}
                                        </td>
                                        <td style="vertical-align: middle;">{{ $det_peg2->nip_baru }}</td>
                                        <td style="vertical-align: middle;">{{ $det_peg2->no_sk }}</td>
                                        <td style="vertical-align: middle;">{{ $det_peg2->tgl }}</td>
                                        <td style="vertical-align: middle;">
                                            @php
                                                if($det_opd_old2 == null){
                                                    echo '-';
                                                }else{
                                                    echo ucwords($det_opd_old2->nama_opd).'&nbsp;&nbsp;';
                                                    echo '<i class="fa fa-arrow-right" aria-hidden="true"></i>';
                                                    echo '&nbsp;&nbsp;'. ucwords($det_opd_new2->nama_opd);
                                                }
                                            @endphp
                                        </td> 
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                    {{-- <hr style="border-top: 3px solid black;"> --}}
                </div>
            </div>
        </div>
    </div>


    <div class="container text-center"><b>Masukkan pesan revisi untuk OPD</b>
        <div class="form-group"><br>
            <form id="form_tolak" action="{{ url('admin/rekon_tolak') }}" method="post">
                {{ csrf_field() }}
                <textarea class="form-control" rows="3" name="t_revisi"
                    placeholder="Masukkan pesan revisi untuk OPD ..."></textarea>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-6">
            <input type="hidden" name="id" value="{{ $data->id }}">
            <button type="button" style="width: 100%" id="but_tolak" class="btn inputan text-white btn-danger">Tolak
                &nbsp;&nbsp;<i title="" class="fa fa-times"></i></button>
            </form>
        </div>
        <div class="col-6">
            <form id="form_valid" action="{{ url('admin/rekon_valid') }}" method="post">
                <input type="hidden" name="id" value="{{ $data->id }}">
                {{ csrf_field() }}
                <button type="button" style="width: 100%" id="but_valid" class="btn inputan text-white btn-primary">Validasi
                    &nbsp;&nbsp;<i title="" class="fa fa-check"></i></button>
            </form>
        </div>
    </div>

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
            $('#datatable_pegawai').DataTable({
                paging: false,
                "info": true,
                searching: true,
                autoWidth: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#datatable_rev').DataTable({
                paging: false,
                "info": false,
                searching: false,
                autoWidth: true,
                "language": {
                    "emptyTable": "Tidak ada perubahan pegawai rekon kali ini.."
                }
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
        $("#but_valid").click(function() {
            swal({
                    title: "Apakah anda yakin?",
                    text: "Data rekon akan divalidasi dan diteruskan ke keuangan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#form_valid').submit();
                    } else {
                        // swal("Your imaginary file is safe!");
                    }
                });
        });
    </script>


    <script>
        $("#but_tolak").click(function() {
            swal({
                    title: "Apakah anda yakin?",
                    text: "Data rekon akan kembalikan ke OPD untuk diubah!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#form_tolak').submit();
                    } else {
                        // swal("Your imaginary file is safe!");
                    }
                });
        });
    </script>

    <script>
        function printData2() {
            var divToPrint = document.getElementById("data_spum");
            var htmlToPrint = '' +
                '<style type="text/css">' +
                'table th, table td {' +
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

        $('#print_spum_b').on('click', function() {
            printData2();
        })
    </script>

    <?php
    Session::forget('kon');
    Session::forget('status');
    ?>
@endsection

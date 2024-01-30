@extends('admin/temp_admin')
@section('judul', 'Detail Data Masuk')
@section('side_kel', 'active')
@section('side_kel2', 'show')
@section('side_dakir', 'active')
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
                <div class="card-header text-center mt-3">
                    <button id="print_rekomendasi" style=" margin-top: -20px;" class="btn btn-primary">Print
                        Surat Rekomendasi &nbsp;<i class="fa fa-print"></i></button>
                    <button id="print_rekon" style=" margin-top: -20px;" class="btn btn-warning">Print
                        Rekon &nbsp;<i class="fa fa-print"></i></button>
                </div>
                <div id="data_print">
                    <table id="tb_head" width="100%" class="mt-4">
                        <thead class="thead-light text-center">
                            <tr>
                                <th style="width:90%; display: block; padding-left:10%;">
                                    <a style="font-size: 24px;">DATA REKONSILIASI PEGAWAI NEGERI SIPIL ORGANISASI PERANGKAT
                                        DAERAH</a><br>
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
                    <br>
                    <div class="table-responsive py-4">
                        <table class="table table-bordered"  width="100%" id="datatable_pegawai">
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
                                        <td>{{ $det->nama_p }}<br><br>{{ $det->nip_p }}<br><br>{{ $det->tgl_lhr_p }}</td>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="data_rekomendasi">
        <div id="hide_3">
            <br><br><br>
            <table width="100%">
                <thead class="thead-light text-center" style="font-family: 'Times New Roman', Times, serif;">
                    <tr>
                        <th style="width: 20%; padding-left:50px;">
                            <img src="{{ asset('img/brand/favicon.png') }}" style="width: 100px" alt="">
                        </th>
                        <th style="width:80%; padding-right:50px;">
                            <a style="font-size: 24px; font-weight: normal;">PEMERINTAH KABUPATEN
                                MOROWALI</a><br>
                            <a style="font-size: 20px;">BADAN KEPEGAWAIAN DAN PENGEMBANGAN</a><br>
                            <a style="font-size: 20px;">SUMBER DAYA MANUSIA DAERAH</a><br>
                            <a style="font-size: 16px; font-weight: normal;">Alamat : Kompleks
                                Perkantoran Bumi Fonuasingko,
                                Bungku</a>
                        </th>
                    </tr>
                </thead>
            </table>
            <div style="border-top: 4px solid black; width: 680px; margin-left:50px; margin-right:50px;">
            </div>

            <table width="100%">
                <thead style="padding-right:50px; padding-left:50px;font-family: 'Times New Roman', Times, serif;"
                    class="thead-light text-center">
                    <tr
                        style="font-size: 18px;  padding-right:50px; text-align: left; padding-left:50px; font-weight: normal;">
                        <th style="width: 55%; padding-left:50px; font-weight: normal; "><br>
                            Nomor&nbsp;&nbsp;:&nbsp;800/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/BKPSDMD/VI/2021<br>
                            Perihal&nbsp;&nbsp;:&nbsp;Penyampaian Nama-Nama SKPD<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang
                            Sudah Melakukan Rekon Data PNS
                        </th>
                        <th style="width: 45%; padding-right:50px; font-weight: normal; ">
                            <br>
                            <a style="font-size: 18px;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bungku,
                                <?php
                                function tanggal_indo($tanggal)
                                {
                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    $split = explode('-', $tanggal);
                                    return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
                                }
                                $ini = date('Y-m-d');
                                echo tanggal_indo($ini);
                                
                                // echo tanggal_indo($ini);
                                
                                ?>
                                <br><br><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepada<br>
                                Yth. Kepala Badan Pengelolaan <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keuangan dan Aset Daerah
                                <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kab. Morowali<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Di -<br><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat

                            </a>
                        </th>
                    </tr>
                </thead>
            </table>

            <table width="100%">
                <thead style="padding-right:50px; padding-left:50px;font-family: 'Times New Roman', Times, serif;"
                    class="thead-light text-center">
                    <tr
                        style="font-size: 18px;  padding-right:50px; text-align: left; padding-left:50px; font-weight: normal;">
                        <th style="width: 10%; padding-right:50px; font-weight: normal; ">

                        </th>
                        <?php
                        function bulan_indo($tanggal)
                        {
                            $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            $split = explode('-', $tanggal);
                            return $bulan[(int) $split[1]] . ' ' . $split[0];
                        }
                        $ini = date('Y-m');
                        $data[0]->bulan . '-' . $data[0]->bulan;
                        
                        ?>
                        <th
                            style="width: 90%;display: flex;justify-content: right; padding-left:50px; font-weight: normal; ">
                            <br><br>
                            <p style=" text-align: justify;width: 100%;margin-right: 80px;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sehubungan dengan telah
                                dilaksanakannya
                                rekonsiliasi Data Pegawai Negeri Sipil (PNS) di Lingkungan Pemda
                                Kab.Morowali bersama Kasubag Kepegawaian dan Bendahara Gaji
                                masing-masing
                                Organisasi Perangkat Daerah (OPD), dengan Badan Kepegawaian dan
                                Pengembangan Sumber Daya Manusia Daerah Kab. Morowali dengan ini kami
                                sampaikan
                                OPD tersebut dibawah ini sudah dapat di proses untuk Pembayaran <b>Gaji
                                    Bulan {{ $data[0]->bulan . ' ' . $data[0]->tahun }} </b> adalah sebagai berikut :<br><br>
                                <b>-
                                    @php
                                        $bar = $data[0]->nama_opd;
                                        $bar = ucwords($bar);
                                        $bar = ucwords(strtolower($bar));
                                        echo $bar;
                                    @endphp </b><br>
                                <b>- Jumlah PNS pada Daftar Absen :
                                    @php
                                        $count_rekon = DB::table('rekon_data')
                                            ->where('id_rekon', '=', $data[0]->id)
                                            ->count();
                                        echo $count_rekon;
                                    @endphp
                                </b>
                            </p>
                        </th>

                    </tr>
                </thead>
            </table>

            <table width="100%">
                <thead style="padding-right:50px; padding-left:50px;font-family: 'Times New Roman', Times, serif;"
                    class="thead-light text-center">
                    <tr>
                        <th
                            style="width: 90%;display: flex;justify-content: right; padding-left:50px; font-weight: normal; ">
                            <br><br>
                            <p style=" text-align: justify;width: 100%;margin-right: 80px;"><br>
                                &nbsp;&nbsp;Demikian kami sampaikan, atas kerja sama yang baik diucapkan terima kasih.
                            </p>
                        </th>
                    </tr>
                </thead>
            </table>
            <table width="100%">
                <thead style="padding-right:50px; padding-left:50px;font-family: 'Times New Roman', Times, serif;"
                    class="thead-light text-center">
                    <tr
                        style="font-size: 18px;  padding-right:50px; text-align: left; padding-left:50px; font-weight: normal;">
                        <th style="width: 45%; padding-left:50px; font-weight: normal; "><br>
                            <br><br><br><br><br><br><br><br><br><br><br><br>
                            <u>
                                Tembusan disampaikan kepada Yth ;
                            </u>
                            Bupati Morowali (sebagai laporan)

                        </th>
                        <th style="width: 55%;text-align : center; padding-right:50px; font-weight: normal; ">

                            <a style="font-size: 18px; ">
                                Kepala Badan Kepegawaian dan Pengembangan
                                Sumber Daya Manusia Daerah Kabupaten Morowali<br><br><br><br><br><br>
                                <b><u>ALWAN Hi. ABUBAKAR, SP</u></b><br>
                                Pembina Tkt.I<br>
                                NIP. 196411171995031002<br>
                            </a>
                        </th>
                    </tr>
                </thead>
            </table>
            <table width="100%">
                <thead>
                    <tr style="text-align: right;">
                        <th><br><br>
                            <?php
                            $data = 'Rekon BKPSDMD Kab. Morowali - ' . date('d/m/Y');
                            ?>
                            <img
                                src="https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=100x100&chl={{ $data }}" />
                        </th>
                    </tr>
                </thead>
            </table>
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

            $("#hide_1").hide();
            $("#hide_3").hide();

            $('#datatable_pegawai').DataTable({
                paging: false,
                "info": false,
                searching: false,
                autoWidth: false
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


    <script>
        function printData3() {
            var divToPrint = document.getElementById("data_rekomendasi");
            var htmlToPrint = '';
            htmlToPrint += divToPrint.outerHTML;
            newWin = window.open("");
            newWin.document.write(htmlToPrint);
            newWin.print();
            newWin.close();
        }

        $('#print_rekomendasi').on('click', function() {
            $("#hide_3").show();
            printData3();
            $("#hide_3").hide();
        })
    </script>

    <?php
    Session::forget('kon');
    Session::forget('status');
    ?>
@endsection

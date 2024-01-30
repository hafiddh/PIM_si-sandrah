<!DOCTYPE html>
<html>

<head>
    <title>{{ $data_pegawai->nama_pegawai }} - Cetak Surat Cuti</title>
</head>

<body style="margin: 40px; margin-top: -5px;">
    <div class="container">
        @if ($id_kop == 1)
            <table width="100%">
                <thead class="thead-light text-center" style="font-family: 'Times New Roman', Times, serif; ">
                    <tr>
                        <th style="width:100%;">
                            <img src="{{ asset('') }}login_res/img/garuda.webp" style="width: 70px" alt="">
                            <br>
                            <a style="font-size: 14px;">BUPATI MOROWALI
                            </a><br>
                            <a style="font-size: 14px; font-weight: normal;">Kompleks Perkantoran Fonuasingko Telp.
                                (0411) 420356 Kode Pos 94673 Bungku</a><br>
                        </th>
                    </tr>
                </thead>
            </table>
        @elseif ($id_kop == 2)
            <table width="100%">
                <thead class="thead-light text-center" style="font-family: 'Times New Roman', Times, serif; ">
                    <tr>
                        <th style="width: 15%; padding-left:50px;">
                            <img src="{{ asset('') }}login_res/img/logo_asli.png" style="width: 70px"
                                alt="">
                        </th>
                        <th style="width:85%; padding-right:50px;">
                            <a style="font-size: 14px;">PEMERINTAH DAERAH KABUPATEN MOROWALI
                            </a>
                            <br>
                            <a style="font-size: 18px;">SEKRETARIAT DAERAH</a>
                            <br>
                            <a style="font-size: 14px; font-weight: normal;">Jln. Trans Sulawesi Kompleks Perkantoran
                                Bumi Fonuasingko Bungku</a><br>
                        </th>
                    </tr>
                </thead>
            </table>
        @elseif ($id_kop == 3)
            <table width="100%">
                <thead class="thead-light text-center" style="font-family: 'Times New Roman', Times, serif; ">
                    <tr>
                        <th style="width: 10%; padding-left:20px;">
                            <img src="{{ asset('') }}login_res/img/logo_asli.png" style="width: 70px"
                                alt="">
                        </th>
                        <th style="width:90%; padding-left:20px;">
                            <a style="font-size: 14px;">PEMERINTAH DAERAH KABUPATEN MOROWALI
                                <br> BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA
                            </a><br>
                            <a style="font-size: 14px; font-weight: normal;">Jl. Trans Sulawesi Kompleks Perkantoran
                                Fonuasingko</a><br>
                        </th>
                    </tr>
                </thead>
            </table>
        @endif
        <div style="border-top: 3px solid black; width: 100%; margin-right:50px; margin-top:10px;">
        </div>

        <table width="100%">
            <thead style="padding-right:50px; padding-left:50px;font-family: 'Times New Roman', Times, serif;"
                class="thead-light text-center">
                <tr
                    style="font-size: 14px; padding-right:50px; padding-left:50px;text-align: CENTER;   font-weight: normal;">
                    <th style="width: 100%;  font-weight: normal; "><br>
                        <B style=" text-decoration: underline;">SURAT IZIN {{ strtoupper($jenis_cuti) }}</B><br>
                        <span style="margin-left: -20%;">Nomor :</span>
                        <br><br>
                        <p style="text-align: justify">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Berdasarkan Undang-undang Nomor 5 Tahun 2014 Jo Peraturan
                            Pemerintah Nomor 11 Tahun 2017 Pasal
                            341 lamanya {{ $jenis_cuti }} sebagaimana dimaksud pada angka 1 adalah 12 (dua belas) hari
                            kerja
                            dan
                            Perka BKN Nomor 24 Tahun 2017 tata cara pemberian cuti Pegawai Negeri Sipil, dan surat
                            permohonan a.n {{ $data_pegawai->nama_pegawai }} pada Tanggal
                            {{ date('d-m-Y', strtotime($data_cuti->created_at)) }}. Perihal
                            Permohonan
                            {{ $jenis_cuti }}, maka dengan ini
                            diberikan {{ $jenis_cuti }} Kepada: </p>
                    </th>
                </tr>
            </thead>
        </table>

        <table name="table2" id="table2" cellspacing="0" width="100%"
            style="font-family: 'Times New Roman', Times, serif;">
            <tbody style="font-size: 14px;">
                <tr>
                    <td style="width: 25%">Nama</td>
                    <td style="width: 5%">&nbsp;:&nbsp;</td>
                    <td><span id="p_nama">{{ $data_pegawai->nama_pegawai }}</span></td>
                </tr>
                <tr>
                    <td style="width: 25%">NIP</td>
                    <td style="width: 5%">&nbsp;:&nbsp;</td>
                    <td><span id="p_noi">{{ $data_pegawai->nip }}</span></td>
                </tr>
                <tr>
                    <td style="width: 25%">Pangkat/Gol. Ruang</td>
                    <td style="width: 5%">&nbsp;:&nbsp;</td>
                    <td><span id="p_ema">{{ $data_pegawai->gol_terakhir }}</span></td>
                </tr>
                <tr>
                    <td style="width: 25%">Jabatan </td>
                    <td style="width: 5%">&nbsp;:&nbsp;</td>
                    <td><span id="p_not">{{ $data_pegawai->jabatan }}</span></td>
                </tr>
                <tr>
                    <td style="width: 25%">Satuan Kerja </td>
                    <td style="width: 5%">&nbsp;:&nbsp;</td>
                    <td><span id="p_not">{{ $data_opd->nama_opd }}</span></td>
                </tr>
            </tbody>
        </table>

        <table width="100%">
            <thead style="padding-right:50px; padding-left:50px;font-family: 'Times New Roman', Times, serif;"
                class="thead-light text-center">
                <tr
                    style="font-size: 14px; padding-right:50px; padding-left:50px;text-align: CENTER;   font-weight: normal;">
                    <th style="width: 100%;  font-weight: normal; ">
                        <p style="text-align: justify">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Selama {{ $data_cuti->lama_c }} hari kerja, terhitung
                            mulai
                            {{ date('d-m-Y', strtotime($data_cuti->tgl_awal)) }}
                            s/d {{ date('d-m-Y', strtotime($data_cuti->tgl_akhir)) }} dengan ketentuan sebagai
                            berikut:<br>
                            <br> 1. Selama menjalankan {{ $jenis_cuti }} wajib
                            menyerahkan tugas / pekerjaan kepada atasan
                            langsungnya atau yang ditunjuk untuk mewakili.
                            <br> 2. Setelah selesai menjalankan {{ $jenis_cuti }} wajib
                            melaporkan diri kepada atasan langsungnya
                            dan bekerja kembali sebagaimana biasa.
                            <br>
                            <br>
                            Demikian Surat Izin {{ $jenis_cuti }} ini dibuat untuk dapat digunakan sebagaimana
                            mestinya.
                        </p>
                    </th>
                </tr>
            </thead>
        </table>

        <table width="100%">
            <thead style="padding-right:50px; padding-left:50px;font-family: 'Times New Roman', Times, serif;"
                class="thead-light text-center">
                <tr
                    style="font-size: 14px;  padding-right:50px; text-align: left; padding-left:50px; font-weight: normal;">
                    <th style="width: 60%;"><br>

                    </th>
                    <br>
                    <th style="width: 60%;text-align : center; font-weight: normal; ">
                        <a style="font-size: 14px; ">
                            Bungku, {{ date('d F Y') }}
                        </a>

                        @if ($id_kop == 1)
                            <br><br><a style="font-size: 14px; ">
                                Bupati Kabupaten Morowali,
                            </a>
                            <br><br><br><br><br><br>
                            <span style="text-decoration: underline">Drs. Taslim</span><br>
                        @elseif ($id_kop == 2)
                            <br><br><a style="font-size: 14px; ">
                                Sekretaris Daerah Kabupaten Morowali,
                            </a>
                            <br><br><br><br><br><br>
                            <span style="text-decoration: underline">Drs. YUSMAN MAHBUB, M.Si</span><br>
                            <span>NIP. 19670606 199403 1 011</span>
                        @elseif ($id_kop == 3)
                            <br><br><a style="font-size: 14px; ">
                                Kepala Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Daerah Kab. Morowali,
                            </a>
                            <br><br><br><br><br><br>
                            <span style="text-decoration: underline">ALWAN Hi. ABUBAKAR, SP</span><br>
                            <span>NIP. 19641117 199503 1 002</span>
                        @endif
                    </th>
                </tr>
            </thead>
        </table>

        <table width="100%">
            <thead style="padding-right:50px; padding-left:50px;font-family: 'Times New Roman', Times, serif;"
                class="thead-light text-center">
                <tr
                    style="font-size: 12px; padding-right:50px; padding-left:50px;text-align: CENTER;   font-weight: normal;">
                    <th style="width: 60%;  font-weight: normal; ">
                        <p style="text-align: justify">
                            <u>
                                Tembusan disampaikan kepada Yth ;
                            </u>
                            <br>
                            1. Bupati Morowali (sebagai laporan) di Bungku;
                            <br>
                            2. Inspektur Inspektorat Daerah Kab. Morowali di Bungku;
                            <br>
                            3. Kepala BKPSDMD Ub. Kepala Bidang Pengembangan, Promosi, Penilaian Kinerja Aparatur dan
                            Penghargaan di Bungku;
                            <br>
                            4. Kepala Bappeda Kab. Morowali di Bungku;
                            <br>
                            5. Arsip.
                        </p>
                    </th>
                    <th style="width: 40%;  font-weight: normal; ">
                    </th>
                </tr>
            </thead>
        </table>
    </div>

</body>

</html>

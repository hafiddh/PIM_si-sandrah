<!-- =========================================================
* Argon Dashboard PRO v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2019 Creative Tim (https://www.creative-tim.com)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>@yield('judul')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    <!-- Page plugins -->
    @yield('tambah_css')
    <style>
        .swal-modal .swal-text {
            text-align: center;
        }
    </style>
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('css/argon.css?v=1.1.0') }}" type="text/css">

    <style>
        .modal123 {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(255, 255, 255, .8) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat;
        }

        /* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
        body.loading .modal123 {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
   modal element will be visible */
        body.loading .modal123 {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center" style="max-height: 200px;">
                <a class="navbar-brand" href="{{ url('/opd') }}">
                    <img src="{{ asset('login_res/img/blue.png') }}" class="navbar-brand-img" alt="...">
                    {{-- <h2>DATA ASET</h2> --}}
                </a>
                <div class="ml-auto">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link @yield('side_dash')" href="{{ url('opd') }}">
                                <i class="ni ni-shop text-primary"></i>
                                <span class="nav-link-text">Dashboards</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('side_kel')" href="{{ route('opd.data.aset') }}">
                                <i class="ni ni-single-copy-04 text-info"></i>
                                <span class="nav-link-text">Data Aset</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link @yield('side_asn')" href=" {{ url('opd/data_pegawai') }} ">
                                <i class="ni ni-circle-08 text-pink"></i>
                                <span class="nav-link-text">Kelola Pegawai</span>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link @yield('side_kel')" href="#navbar-forms" data-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="navbar-forms">
                                <i class="ni ni-single-copy-04 text-pink"></i>
                                <span class="nav-link-text">Kelola Data Rekon</span>
                            </a>
                            <div class="collapse @yield('side_kel2')" id="navbar-forms">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('opd.input.rekon') }}"
                                            class="nav-link @yield('side_inda')">Input Data</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('opd.lihat.rekon') }}"
                                            class="nav-link @yield('side_lire')">Lihat Data</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('side_asn')" href="#navbar-forms" data-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="navbar-forms">
                                <i class="ni ni-circle-08 text-pink"></i>
                                <span class="nav-link-text">Data Pegawai</span>
                            </a>
                            <div class="collapse @yield('side_asn2')" id="navbar-forms">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ url('opd/data_pegawai') }}"
                                            class="nav-link @yield('side_daasn')">Kelola Pegawai</a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted"></h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ asset('') }}uploads/buku_panduan_opd.pdf" target="_blank">
                                <i class="ni ni-ui-04"></i>
                                <span class="nav-link-text">Petunjuk Penggunaan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Search form -->
                    {{-- <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
             <div class="form-group mb-0">
               <div class="input-group input-group-alternative input-group-merge">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fas fa-search"></i></span>
                 </div>
                 <input class="form-control" placeholder="Search" type="text">
               </div>
             </div>
             <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
               <span aria-hidden="true">×</span>
             </button>
           </form> --}}
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center ml-md-auto">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show"
                                data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li>
                        {{-- <li class="nav-item dropdown">
                          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
                              <i class="ni ni-ungroup"></i>
                          </a>
                          <div
                              class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
                              <div class="row shortcuts px-4">
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                          <i class="ni ni-calendar-grid-58"></i>
                                      </span>
                                      <small>Calendar</small>
                                  </a>
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                          <i class="ni ni-email-83"></i>
                                      </span>
                                      <small>Email</small>
                                  </a>
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                          <i class="ni ni-credit-card"></i>
                                      </span>
                                      <small>Payments</small>
                                  </a>
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                          <i class="ni ni-books"></i>
                                      </span>
                                      <small>Reports</small>
                                  </a>
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                                          <i class="ni ni-pin-3"></i>
                                      </span>
                                      <small>Maps</small>
                                  </a>
                                  <a href="#!" class="col-4 shortcut-item">
                                      <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                                          <i class="ni ni-basket"></i>
                                      </span>
                                      <small>Shop</small>
                                  </a>
                              </div>
                          </div>
                      </li> --}}
                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="{{ asset('img/theme/team-4.jpg') }}">
                                    </span>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ url('/') }}" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">@yield('judul2')</h6>

                        </div>
                    </div>
                    <!-- Card stats -->
                    @yield('index_head')

                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6 pb-5">
            @yield('isi')
            <!-- Footer -->

            <footer class="footer pt-0" style="margin-top: 100px;">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6">
                        <div class="copyright text-center text-lg-left text-muted">
                            &copy; 2022 <a href="#" class="font-weight-bold ml-1" target="_blank">Satuan Polisi
                                Pamong Praja Kabupaten Morowali</a>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </footer>
        </div>

    </div>

    <div class="modal123">
        <!-- Place at bottom of page -->
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Optional JS -->

    @if (session()->has('error'))
        <script>
            $(document).ready(function() {
                new swal({
                    title: "ERROR!",
                    text: "{{ session()->get('error') }}",
                    icon: "error",
                    button: "Ok!",
                });
            });
        </script>
    @elseif(session()->has('success'))
        <script>
            $(document).ready(function() {
                new swal({
                    title: "Berhasil!",
                    text: "{{ session()->get('success') }}",
                    icon: "success",
                    button: "Ok!",
                });
            });
        </script>
    @elseif(session()->has('message'))
        <script>
            $(document).ready(function() {
                new swal({
                    title: "Pesan!",
                    text: "{{ session()->get('message') }}",
                    icon: "warning",
                    button: "Ok!",
                });
            });
        </script>
    @endif

    @yield('tambah_js')

    <script>
        $("#notif").click(function(e) {
            var data = $("#tes").val();
            console.log(data);
            $.ajax({
                url: "{{ url('opd/kill_notif') }}",
                data: {
                    'id': data
                },
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    // alert(response);
                },
                error: function(response) {
                    console.log('F');
                }
            });

        });
    </script>
    <script>
        (function($) {
            $.fn.inputFilter = function(inputFilter) {
                return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        this.value = "";
                    }
                });
            };
        }(jQuery));
    </script>
    <script>
        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "loadingRecords": "Sedang memuat...",
                "processing": "Sedang memproses...",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "thousands": "'",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": ">>",
                    "previous": "<<"
                },
                "aria": {
                    "sortAscending": ": aktifkan untuk mengurutkan kolom ke atas",
                    "sortDescending": ": aktifkan untuk mengurutkan kolom menurun"
                },
                "autoFill": {
                    "cancel": "Batalkan",
                    "fill": "Isi semua sel dengan <i>%d<\/i>",
                    "fillHorizontal": "Isi sel secara horizontal",
                    "fillVertical": "Isi sel secara vertikal"
                },
                "buttons": {
                    "collection": "Kumpulan <span class='ui-button-icon-primary ui-icon ui-icon-triangle-1-s'\/>",
                    "colvis": "Visibilitas Kolom",
                    "colvisRestore": "Kembalikan visibilitas",
                    "copy": "Salin",
                    "copySuccess": {
                        "1": "1 baris disalin ke papan klip",
                        "_": "%d baris disalin ke papan klip"
                    },
                    "copyTitle": "Salin ke Papan klip",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Tampilkan semua baris",
                        "1": "Tampilkan 1 baris",
                        "_": "Tampilkan %d baris"
                    },
                    "pdf": "PDF",
                    "print": "Cetak",
                    "copyKeys": "Tekan ctrl atau u2318 + C untuk menyalin tabel ke papan klip.<br \/><br \/>Untuk membatalkan, klik pesan ini atau tekan esc."
                },
                "searchBuilder": {
                    "add": "Tambah Kondisi",
                    "button": {
                        "0": "Cari Builder",
                        "_": "Cari Builder (%d)"
                    },
                    "clearAll": "Bersihkan Semua",
                    "condition": "Kondisi",
                    "data": "Data",
                    "deleteTitle": "Hapus filter",
                    "leftTitle": "Ke Kiri",
                    "logicAnd": "Dan",
                    "logicOr": "Atau",
                    "rightTitle": "Ke Kanan",
                    "title": {
                        "0": "Cari Builder",
                        "_": "Cari Builder (%d)"
                    },
                    "value": "Nilai",
                    "conditions": {
                        "date": {
                            "after": "Setelah",
                            "before": "Sebelum",
                            "between": "Diantara",
                            "empty": "Kosong",
                            "equals": "Sama dengan",
                            "not": "Tidak sama",
                            "notBetween": "Tidak diantara",
                            "notEmpty": "Tidak kosong"
                        },
                        "number": {
                            "between": "Diantara",
                            "empty": "Kosong",
                            "equals": "Sama dengan",
                            "gt": "Lebih besar dari",
                            "gte": "Lebih besar atau sama dengan",
                            "lt": "Lebih kecil dari",
                            "lte": "Lebih kecil atau sama dengan",
                            "not": "Tidak sama",
                            "notBetween": "Tidak diantara",
                            "notEmpty": "Tidak kosong"
                        },
                        "string": {
                            "contains": "Berisi",
                            "empty": "Kosong",
                            "endsWith": "Diakhiri dengan",
                            "equals": "Sama Dengan",
                            "not": "Tidak sama",
                            "notEmpty": "Tidak kosong",
                            "startsWith": "Diawali dengan"
                        },
                        "array": {
                            "equals": "Sama dengan",
                            "empty": "Kosong",
                            "contains": "Berisi",
                            "not": "Tidak",
                            "notEmpty": "Tidak kosong",
                            "without": "Tanpa"
                        }
                    }
                },
                "searchPanes": {
                    "clearMessage": "Bersihkan Semua",
                    "count": "{total}",
                    "countFiltered": "{shown} ({total})",
                    "title": "Filter Aktif - %d",
                    "collapse": {
                        "0": "Panel Pencarian",
                        "_": "Panel Pencarian (%d)"
                    },
                    "emptyPanes": "Tidak Ada Panel Pencarian",
                    "loadMessage": "Memuat Panel Pencarian"
                },
                "infoThousands": ",",
                "searchPlaceholder": "Masukkan kata kunci yang dicari",
                "select": {
                    "1": "%d baris terpilih",
                    "_": "%d baris terpilih",
                    "cells": {
                        "1": "1 sel terpilih",
                        "_": "%d sel terpilih"
                    },
                    "columns": {
                        "1": "1 kolom terpilih",
                        "_": "%d kolom terpilih"
                    }
                },
                "datetime": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya",
                    "hours": "Jam",
                    "minutes": "Menit",
                    "seconds": "Detik",
                    "unknown": "-",
                    "amPm": [
                        "am",
                        "pm"
                    ]
                },
                "editor": {
                    "close": "Tutup",
                    "create": {
                        "button": "Tambah",
                        "submit": "Tambah",
                        "title": "Tambah inputan baru"
                    },
                    "remove": {
                        "button": "Hapus",
                        "submit": "Hapus",
                        "confirm": {
                            "_": "Apakah Anda yakin untuk menghapus %d baris?",
                            "1": "Apakah Anda yakin untuk menghapus 1 baris?"
                        },
                        "title": "Hapus inputan"
                    },
                    "multi": {
                        "title": "Beberapa Nilai",
                        "info": "Item yang dipilih berisi nilai yang berbeda untuk input ini. Untuk mengedit dan mengatur semua item untuk input ini ke nilai yang sama, klik atau tekan di sini, jika tidak maka akan mempertahankan nilai masing-masing.",
                        "restore": "Batalkan Perubahan",
                        "noMulti": "Masukan ini dapat diubah satu per satu, tetapi bukan bagian dari grup."
                    },
                    "edit": {
                        "title": "Edit inputan",
                        "submit": "Edit",
                        "button": "Edit"
                    },
                    "error": {
                        "system": "Terjadi kesalahan pada system. (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Informasi Selebihnya<\/a>)."
                    }
                }
            }
        });
    </script>

    <!-- Argon JS -->
    <script src="{{ asset('js/argon.js?v=1.1.0') }}"></script>

    <script>
        $body = $("body");

        $(document).on({
            ajaxStart: function() {
                $body.addClass("loading");
            },
            ajaxStop: function() {
                $body.removeClass("loading");
            }
        });
    </script>
</body>

</html>

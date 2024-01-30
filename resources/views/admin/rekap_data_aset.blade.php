@extends('admin.temp_admin')
@section('judul', 'Rekap Data Aset')
@section('side_rek', 'active')
@section('judul2', 'Rekap Data Aset')

@section('tambah_css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/fixedHeader.dataTables.min.css') }}">
@endsection



@section('isi')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label form-control-label">Pilih OPD</label>
                        <div class="col-md-10">
                            <select id="sel_opd" class="form-control select2">
                                <option value="" selected disabled>- Pilih OPD -</option>
                                <option value="1">Seluruh OPD</option>
                                @foreach ($opd as $opp)
                                    <option value="{{ $opp->nama_opd }}">{{ $opp->nama_opd }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div id="hideen" class="table-responsive py-4">
                    <table class="table table-flush" id="datatable33">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Merk/Type</th>
                                <th>Tahun Pembelian</th>
                                <th>Asal Usul</th>
                                <th>Harga</th>
                                <th>Kondisi</th>
                                <th>Pemegang Aset</th>
                                <th>Keterangan</th>
                                <th>Catatan</th>
                                <th style="width: 5%">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_aset" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5e72e4">
                    <h5 class="modal-title" style="color: white;">Form Data Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style=" color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form_add" enctype="multipart/form-data"
                    onsubmit="return confirm('Data akan diajukan, Pastikan data yang dimasukkan sudah benar?!');"
                    class="d-inline">
                    {{ csrf_field() }}

                    <div class="modal-body">

                        <input class="form-control" name="id_aset" id="id_aset" value="" hidden>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Nama Aset</label>
                            <div class="col-md-10">
                                <input class="form-control edit" id="nama" name="nama" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Kode Aset</label>
                            <div class="col-md-10">
                                <input class="form-control edit" id="kode" name="kode_aset" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Merk</label>
                            <div class="col-md-10">
                                <input class="form-control edit" id="merk" name="merk" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Tipe</label>
                            <div class="col-md-10">
                                <input class="form-control edit" id="tipe" name="tipe" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Tahun</label>
                            <div class="col-md-10">
                                <input class="form-control edit angka" id="tahun" name="tahun" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Asal-Usul</label>
                            <div class="col-md-10">
                                <input class="form-control edit" id="asal_usul" name="asal" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Harga</label>
                            <div class="col-md-10">
                                <input class="form-control edit angka" id="harga" name="harga" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Pemegang Aset</label>
                            <div class="col-md-10">
                                <input class="form-control edit" id="pemegang" name="pemegang" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Kondisi</label>
                            <div class="col-md-10">
                                <select class="form-control edit" id="kondisi" name="kondisi" required>
                                    <option value="#" selected disabled>- Pilih Kondisi -</option>
                                    <option value="1">Baik</option>
                                    <option value="2">Rusak Ringan</option>
                                    <option value="3">Rusak Berat</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Keterangan</label>
                            <div class="col-md-10">
                                <textarea name="keterangan" style="max-width: 100%" class="form-control edit" id="keterangan" rows="4"></textarea>
                            </div>
                        </div>


                        <div class="form-group row text-left mb-3" id="div_dokumen">
                            <label class="col-12 col-form-label"><strong>Data Aset</strong>
                                <span class="text-danger"></span>
                            </label>
                            <div class="col-12">
                                <div id="file_up"></div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label col-sm-12 form-control-label">Catatan</label>
                            <div class="col-md-10">
                                <textarea disabled name="catatan" style="max-width: 100%" class="form-control" id="catatan" rows="4"></textarea>
                            </div>

                        </div>

                    </div>
                    <div id="m_view" class="modal-footer" style="margin-top: -50px">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>

        <input id="judul_title" hidden>
    </div>
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
    <script src="{{ asset('vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/nouislider/distribute/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/sweet.min.js') }}"></script>

    <script src="{{ asset('vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
            $('#hideen').hide();
        });

        $("#sel_opd").change(function() {
            id = $('#sel_opd').val();
            loadData(id);
        });

        function loadData(id) {
            // console.log(id);

            if (id == '1') {
                judul = "LAPORAN REKAPITULASI DATA DATA ASET<br>";
            } else {
                judul = "LAPORAN REKAPITULASI DATA DATA ASET <br>" + id + "<br>";
            }

            $("#datatable33").DataTable({
                paging: false,
                destroy: true,
                info: false,
                searching: false,
                autoWidth: false,
                processing: true,
                serverSide: true,
                "ordering": false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    title: judul,
                    exportOptions: {
                        stripHtml: false,
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                    },
                    titleAttr: 'print',
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '14pt')
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                        $(win.document.body).find('h1').css('text-align', 'center');
                        $(win.document.body).find('h1').css('font-size', '14pt');
                        $(win.document.body).find('h1').css('font-weight', '700');
                        $(win.document.body).find('h1').css('color', 'black');
                        $(win.document.body).find('h1').css('margin', '10px;');
                        $(win.document.body).find('th')
                            .css('text-align', 'center');
                        var last = null;
                        var current = null;
                        var bod = [];

                        var css = '@page { size: landscape; }',
                            head = win.document.head || win.document.getElementsByTagName('head')[0],
                            style = win.document.createElement('style');

                        style.type = 'text/css';
                        style.media = 'print';

                        if (style.styleSheet) {
                            style.styleSheet.cssText = css;
                        } else {
                            style.appendChild(win.document.createTextNode(css));
                        }

                        head.appendChild(style);
                    }
                }],
                ajax: {
                    url: "{{ route('admin.get.aset.search') }}",
                    type: "GET",
                    data: {
                        'id': id,
                    },
                    // success: function(data) {
                    //     console.log(data);
                    // },
                },
                columns: [{
                        data: null,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: "kode",
                    },
                    {
                        data: "nama",
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return data.merk + "/" + data.tipe;
                        },
                    },
                    {
                        data: "tahun",
                    },
                    {
                        data: "asal",
                    },
                    {
                        data: "harga",
                        render: function(data, type, row) {
                            return rupiah(data);
                        }
                    },
                    {
                        data: 'kondisi',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<span class="badge badge-pill badge-lg light badge-success"> Baik</span>';
                            } else if (data == 2) {
                                return '<span class="badge badge-pill badge-lg light badge-warning"> Rusak Ringan</span>';
                            } else if (data == 3) {
                                return '<span class="badge badge-pill badge-lg light badge-danger"> Rusak Berat</span>';
                            }
                        },
                    },
                    {
                        data: "pemegang",
                    },
                    {
                        data: "keterangan",
                    },
                    {
                        data: "catatan_admin",
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return (
                                "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-success'  id='" +
                                data.id +
                                "' onClick='info_det(this.id)'><i class='fa fa-search'></i></button>"
                            )
                        },
                    },
                ],
                'columnDefs': [{
                    "targets": [3, 4, 5, 7],
                    "className": "text-center",
                }, {
                    "targets": [6],
                    "className": "text-right",
                }, {
                    targets: [9, 10],
                    searchable: false,
                    visible: false,
                }, {
                    "targets": [0, 1, 4, 5, 7],
                    "width": "10px",
                }],

            });


            $('#hideen').show(300);
        }


        function rupiah(number) {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0,
            }).format(number);
        }

        function info_det(clicked_id) {
            $("#modal_aset").modal("show");
            $(".edit").prop("disabled", true);

            $.ajax({
                url: "{{ route('admin.get.aset.det') }}",
                type: "get",
                data: {
                    id: clicked_id,
                },
                success: function(data) {
                    // console.log(data)

                    $("#id_aset").val(data.data.id);
                    $("#nama").val(data.data.nama);
                    $("#kode").val(data.data.kode);
                    $("#merk").val(data.data.merk);
                    $("#tipe").val(data.data.tipe);
                    $("#tahun").val(data.data.tahun);
                    $("#asal_usul").val(data.data.asal);
                    $("#harga").val(data.data.harga);
                    $("#pemegang").val(data.data.pemegang);
                    $("#kondisi").val(data.data.kondisi).change();
                    $("#keterangan").val(data.data.pemegang);


                    if (data.data.catatan_admin) {
                        $("#catatan").val(data.data.catatan_admin);
                    } else {
                        $("#catatan").val("");
                    }

                    if (data.file == "") {
                        $("#div_dokumen").hide();
                    } else {
                        $('#file_up').html('');
                        $("#div_dokumen").show();
                        $.each(data.file, function(index, value) {
                            $('#file_up').append(
                                " <a href='{{ url('') }}/download-file/" + value.file +
                                "' target='_blank'><img src='{{ url('') }}/download-file/" +
                                value.file +
                                "' alt='" + value.file +
                                "' width='300' height='300' style='object-fit: contain; margin: 10px;'></a>"
                            );
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                    error_detail(error);
                },
            });
        }
    </script>
@endsection

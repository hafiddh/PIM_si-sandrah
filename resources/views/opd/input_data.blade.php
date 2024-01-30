@extends('opd.opd_temp')
@section('judul', 'Data Asset OPD')
@section('side_kel', 'active')
@section('side_kel2', 'show')
@section('side_dama', 'active')
@section('judul2', 'Data Asset OPD')
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
                    <button id="modal_add" class="btn btn-primary float-right"><i class="fa fa-plus"> </i> Tambah Data
                        Aset</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">Data Aset</h3>
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable33">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Nama Aset</th>
                                <th>Kode Aset</th>
                                <th>Kondisi</th>
                                <th>Harga</th>
                                <th>Tahun Pembelian</th>
                                <th>Asal Usul</th>
                                <th>Pemegang Aset</th>
                                <th>OPD</th>
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
                            <label class="col-12 col-form-label"><strong>Foto Aset</strong>
                                <span class="text-danger"></span>
                            </label>
                            <div class="col-12">
                                <div id="file_up"></div>
                            </div>
                        </div>

                        <div class="form-group row" id="up_file">
                            <label class="col-md-2 col-sm-12 col-form-label form-control-label">Upload Foto Aset</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control edit" accept="image/png, image/gif, image/jpeg"
                                    name="foto_aset[]" multiple required>
                                <small style="color: red">*file berformat jpg, jpeg atau png , dengan ukuran maksimal 2
                                    MB</small>
                            </div>
                        </div>

                    </div>

                    <div id="m_sub" class="modal-footer" style="margin-top: -50px">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button id="butt_sub" type="button" class="btn btn-warning"><i class="fa fa-plus"></i>
                            Simpan</button>
                    </div>

                    <div id="m_edit" class="modal-footer" style="margin-top: -50px">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button id="butt_edit" type="button" class="btn btn-warning"><i class="fa fa-edit"></i>
                            Ubah</button>
                    </div>

                    <div id="m_view" class="modal-footer" style="margin-top: -50px">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
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
            loadData();

            $("#m_sub").hide(200);
            $("#m_edit").hide(200);
            $("#m_view").hide(200);
            $("#div_dokumen").hide(200);

            $(".select2").select2();

            $(".angka").inputFilter(function(value) {
                return /^-?\d*$/.test(value);
            }, "");
        });


        function loadData() {
            $("#datatable33").DataTable({
                paging: false,
                destroy: true,
                info: true,
                searching: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('opd.get.aset') }}",
                    type: "GET",
                },
                columns: [{
                        data: null,
                        sortable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: "nama",
                    },
                    {
                        data: "kode",
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
                        data: "harga",
                        render: function(data, type, row) {
                            return rupiah(data);
                        }
                    },
                    {
                        data: "tahun",
                    },
                    {
                        data: "asal",
                    },
                    {
                        data: "pemegang",
                    },
                    {
                        data: "opd",
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            // if (data.status == 0) {
                            //     return (
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-success'  id='" +
                            //         data.id +
                            //         "' onClick='info_det(this.id)'><i class='fa fa-search'></i>" +
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-info'  id='" +
                            //         data.id +
                            //         "' onClick='info_edit(this.id)'><i class='fa fa-edit'></i>" +
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-danger'  id='" +
                            //         data.id +
                            //         "' onClick='info_hapus(this.id)'><i class='fa fa-trash'></i></button>&nbsp;"
                            //     );
                            // } else if (data.status == 1) {
                            //     return (
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-success'  id='" +
                            //         data.id +
                            //         "' onClick='info_det(this.id)'><i class='fa fa-search'></i>" +
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-danger'  id='" +
                            //         data.id +
                            //         "' onClick='info_hapus(this.id)'><i class='fa fa-trash'></i></button>&nbsp;"
                            //     );
                            // } else {
                            //     return (
                            //         "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-success'  id='" +
                            //         data.id +
                            //         "' onClick='info_det(this.id)'><i class='fa fa-search'></i>"
                            //     );
                            // }
                            return (
                                "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-success'  id='" +
                                data.id +
                                "' onClick='info_det(this.id)'><i class='fa fa-search'></i>" +
                                "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-info'  id='" +
                                data.id +
                                "' onClick='info_edit(this.id)'><i class='fa fa-edit'></i>" +
                                "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-danger'  id='" +
                                data.id +
                                "' onClick='info_hapus(this.id)'><i class='fa fa-trash'></i></button>&nbsp;"
                            );
                        },
                    },
                ],
            });
        }

        $("#modal_add").click(function() {
            $(".edit").prop("disabled", false);
            $("#form_add")[0].reset();
            $("#up_file").show(200);
            $("#m_sub").show(200);
            $("#m_edit").hide(200);
            $("#m_view").hide(200);
            $("#modal_aset").modal("show");
        });


        $("#butt_sub").click(function() {
            event.preventDefault();
            idata = new FormData($('#form_add')[0]);
            // console.log(idata);
            $.ajax({
                type: "POST",
                url: "{{ route('opd.tambah.aset') }}",
                data: idata,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    console.log(data);
                    Swal.fire({
                        icon: data.status,
                        title: data.messages,
                        text: '',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                    $("#form_add")[0].reset();
                    $('.modal').modal('hide');
                    loadData();
                },
                error: function(error) {

                    Swal.fire({
                        icon: 'error',
                        title: error.responseJSON.messages,
                        text: '',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                    // console.log(error);
                }
            });
        });

        $("#butt_edit").click(function() {
            event.preventDefault();
            idata = new FormData($('#form_add')[0]);
            // console.log(idata);
            $.ajax({
                type: "POST",
                url: "{{ route('opd.edit.aset') }}",
                data: idata,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    // console.log(data);
                    Swal.fire({
                        icon: data.status,
                        title: data.messages,
                        text: '',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                    $("#form_add")[0].reset();
                    $('.modal').modal('hide');
                    loadData();
                },
                error: function(error) {

                    Swal.fire({
                        icon: 'error',
                        title: error.responseJSON.messages,
                        text: '',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                    // console.log(error);
                }
            });
        });


        function info_edit(clicked_id) {
            $("#modal_aset").modal("show");
            $(".edit").prop("disabled", false);
            $("#m_sub").hide(200);
            $("#m_edit").show(200);
            $("#m_view").hide(200);
            $("#up_file").show(200);

            // $(".edit_view_eee").prop("disabled", true);
            // $("#btn_foot").hide(200);
            // $("#file_view").show(200);

            $.ajax({
                url: "{{ route('opd.get.aset.det') }}",
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

        function info_det(clicked_id) {
            $("#modal_aset").modal("show");
            $(".edit").prop("disabled", true);
            $("#m_sub").hide(200);
            $("#m_edit").hide(200);
            $("#m_view").show(200);
            $("#up_file").hide(200);

            // $(".edit_view_eee").prop("disabled", true);
            // $("#btn_foot").hide(200);
            // $("#file_view").show(200);

            $.ajax({
                url: "{{ route('opd.get.aset.det') }}",
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

        function info_hapus(clicked_id) {
            // alert(clicked_id);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger",
                },
                buttonsStyling: false,
            });

            swalWithBootstrapButtons
                .fire({
                    title: "Data akan dihapus?",
                    text: "Data dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus",
                    cancelButtonText: "Tidak, batalkan",
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('opd.hapus.aset') }}",
                            type: "get",
                            data: {
                                id: clicked_id,
                            },
                        });
                        loadData();
                        swalWithBootstrapButtons.fire(
                            "Terhapus!",
                            "Data Berhasil diHapus!.",
                            "success"
                        );
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire("Dibatalkan", "", "error");
                    }
                });
        }


        function rupiah(number) {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0,
            }).format(number);
        }
    </script>
@endsection

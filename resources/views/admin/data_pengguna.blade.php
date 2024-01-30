@extends('admin/temp_admin')
@section('judul', 'Data Pengguna')
@section('side_asn', 'active')
@section('side_asn2', 'show')
@section('side_pengguna', 'active')
@section('judul2', 'Data Pengguna')

@section('tambah_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
@endsection

@section('isi')

    <div class="modal fade" id="modal_tambah" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5e72e4">
                    <h5 class="modal-title" style="color: white;">Form Tambah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style=" color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tambah.pengguna') }}" method="post"
                    onsubmit="return confirm('Data akan disimpan, Pastikan data sudah benar?!');" class="d-inline">
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Username</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" name="username" type="text" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Password</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" id="pass" name="password" type="password"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Ulang Password</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" id="pass_con" type="password" value="">
                                <div style="margin-top: 5px;" id="CheckPasswordMatch"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Unit Kerja</label>
                            <div class="col-md-10">
                                <select class="form-control lihat select2" name="opd" value="">
                                    <option value="" selected disabled>- Pilih Unit Kerja -</option>
                                    @foreach ($opd as $op)
                                        <option value="{{ $op->id_opd }}">{{ $op->nama_opd }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr style="border-top: 1px solid black;">

                    </div>
                    <div class="modal-footer" style="margin-top: -50px;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button id="btn_sub" type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Tambah
                            pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5e72e4">
                    <h5 class="modal-title" style="color: white;">Form pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style=" color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.edit.pengguna') }}" method="post"
                    onsubmit="return confirm('Data akan di Update, Pastikan data sudah benar?!');" class="d-inline">
                    {{ csrf_field() }}

                    <input class="form-control" name="id" id="id_edit" value="" hidden>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Username</label>
                            <div class="col-md-10">
                                <input class="form-control lihat lihat2" id="e_username" name="username" type="text"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Password</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" id="e_pass" name="password" type="password"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Ulang Password</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" id="e_pass_con" type="password" value="">
                                <div style="margin-top: 5px;" id="CheckPasswordMatch22"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Unit Kerja</label>
                            <div class="col-md-10">
                                <select class="form-control lihat lihat2 select2" id="e_opd" name="opd" value="">
                                    <option value="" selected disabled>- Pilih Unit Kerja -</option>
                                    @foreach ($opd as $op)
                                        <option value="{{ $op->id_opd }}">{{ $op->nama_opd }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr style="border-top: 1px solid black;">

                    </div>
                    <div class="modal-footer btn_bot" style="margin-top: -50px;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button id="e_btn_sub"  type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary float-right" id="button_tambah"><i
                                    class="fa fa-plus">
                                </i> Tambah pengguna</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable1" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 100px;">No</th>
                                        <th>Username</th>
                                        <th>Satuan Kerja</th>
                                        <th style="width: 100px;">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
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
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            loadData();
            $('.select2').select2();
            $(".btn_bot").hide(200)
            $("#btn_sub").prop('disabled', true);
            $("#e_btn_sub").prop('disabled', true);
        });

        $("#pass").on('keyup', function() {
            var password = $("#pass").val();
            var confirmPassword = $("#pass_con").val();
            if (password != confirmPassword) {
                $("#CheckPasswordMatch").html("Password tidak sesuai !").css("color", "red").css("font-size",
                    "12px");
                $("#btn_sub").prop('disabled', true);
            } else {
                $("#CheckPasswordMatch").html("Password sesuai !").css("color", "green").css("font-size", "12px");
                $("#btn_sub").prop('disabled', false);
            }
        });

        $("#pass_con").on('keyup', function() {
            var password = $("#pass").val();
            var confirmPassword = $("#pass_con").val();
            if (password != confirmPassword) {
                $("#CheckPasswordMatch").html("Password tidak sesuai !").css("color", "red").css("font-size",
                    "12px");
                $("#btn_sub").prop('disabled', true);
            } else {
                $("#CheckPasswordMatch").html("Password sesuai !").css("color", "green").css("font-size", "12px");
                $("#btn_sub").prop('disabled', false);

            }
        });
        
        $("#e_pass").on('keyup', function() {
            var password = $("#e_pass").val();
            var confirmPassword = $("#e_pass_con").val();
            if (password != confirmPassword) {
                $("#CheckPasswordMatch22").html("Password tidak sesuai !").css("color", "red").css("font-size",
                    "12px");
                $("#e_btn_sub").prop('disabled', true);
            } else {
                $("#CheckPasswordMatch22").html("Password sesuai !").css("color", "green").css("font-size", "12px");
                $("#e_btn_sub").prop('disabled', false);
            }
        });

        $("#e_pass_con").on('keyup', function() {
            var password = $("#e_pass").val();
            var confirmPassword = $("#e_pass_con").val();
            if (password != confirmPassword) {
                $("#CheckPasswordMatch22").html("Password tidak sesuai !").css("color", "red").css("font-size",
                    "12px");
                $("#e_btn_sub").prop('disabled', true);
            } else {
                $("#CheckPasswordMatch22").html("Password sesuai !").css("color", "green").css("font-size", "12px");
                $("#e_btn_sub").prop('disabled', false);

            }
        });

        $('#button_tambah').click(function() {
            $(".lihat").prop('disabled', false);
            $('#modal_tambah').modal('show');
        });

        function loadData() {
            $('#datatable1').DataTable({
                paging: true,
                destroy: true,
                "info": true,
                searching: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.get.all.pengguna') }}",
                    type: 'GET'
                },
                columns: [{
                        "data": null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {

                            return "<button type='button' class='btn btn-sm btn-outline-success'  id='" +
                                data.id +
                                "' onClick='data_lihat(this.id)'><i class='fa fa-eye'></i>" +
                                "<button type='button' class='btn btn-sm btn-outline-info'  id='" +
                                data.id +
                                "' onClick='data_edit(this.id)'><i class='fa fa-edit'></i>" +
                                "<button type='button' class='btn btn-sm btn-outline-danger'  id='" +
                                data.id +
                                "' onClick='info_hapus(this.id)'><i class='fa fa-trash'></i>"

                        }
                    },
                ],
                order: [
                    [0, 'asc']
                ]
            });
        };

        function data_edit(clicked_id) {
            $('#modal_edit').modal('show');

            $.ajax({
                url: "{{ route('admin.get.det.pengguna') }}",
                type: 'get',
                data: {
                    "id": clicked_id
                },
                success: function(data) {
                    $(".btn_bot").show(200);
                    $(".lihat").prop('disabled', false);
                    $(".lihat2").prop('disabled', true);
                    $('#e_username').val(data.username);
                    $('#id_edit').val(data.id);
                    $('#e_opd').val(data.id).change();

                },
                error: function(error) {
                    console.log(error);
                    error_detail(error);
                }
            });
        }

        function data_lihat(clicked_id) {
            $('#modal_edit').modal('show');

            $.ajax({
                url: "{{ route('admin.get.det.pengguna') }}",
                type: 'get',
                data: {
                    "id": clicked_id
                },
                success: function(data) {
                    $(".btn_bot").hide(200);
                    $(".lihat").prop('disabled', true);
                    $('#e_username').val(data.username);
                    $('#id_edit').val(data.id);
                    $('#e_opd').val(data.id).change();
                },
                error: function(error) {
                    console.log(error);
                    error_detail(error);
                }
            });
        }

        function info_hapus(clicked_id) {
            // alert(clicked_id);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Data akan dihapus?',
                text: "Data dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Tidak, batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url: "{{ route('admin.hapus.pengguna') }}",
                        type: 'DELETE',
                        data: {
                            "id": clicked_id,
                            "_token": token,
                        }
                    });
                    swalWithBootstrapButtons.fire(
                        'Terhapus!',
                        'Data Berhasil diHapus!.',
                        'success'
                    )

                    loadData();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan',
                        '',
                        'error'
                    )
                }
            })

        }
    </script>

@endsection

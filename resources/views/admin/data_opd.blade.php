@extends('admin/temp_admin')
@section('judul', 'Data OPD')
@section('side_asn', 'active')
@section('side_asn2', 'show')
@section('side_opd', 'active')
@section('judul2', 'Data OPD')

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
                    <h5 class="modal-title" style="color: white;">Form Tambah OPD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style=" color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tambah.opd') }}" method="post"
                    onsubmit="return confirm('Data akan disimpan, Pastikan data sudah benar?!');" class="d-inline">
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Nama OPD</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" id="v_nama" name="nama" type="text"
                                    value="">
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">

                    </div>
                    <div class="modal-footer" style="margin-top: -50px;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Tambah OPD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5e72e4">
                    <h5 class="modal-title" style="color: white;">Form OPD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style=" color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.edit.opd') }}" method="post"
                    onsubmit="return confirm('Data akan di Update, Pastikan data sudah benar?!');" class="d-inline">
                    {{ csrf_field() }}

                    <div class="modal-body">

                        <input class="form-control" name="id" id="id_edit" value="" hidden>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Nama OPD</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" id="e_nama" name="nama" type="text"
                                    value="">
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">

                    </div>
                    <div class="modal-footer btn_bot" style="margin-top: -50px;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Simpan
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
                                </i> Tambah OPD</button>
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
                                        <th>Nama OPD</th>
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
                    url: "{{ route('admin.get.all.opd') }}",
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
                        data: 'nama_opd'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {

                            return "<button type='button' class='btn btn-sm btn-outline-success'  id='" +
                                data.id_opd +
                                "' onClick='data_lihat(this.id)'><i class='fa fa-eye'></i>" +
                                "<button type='button' class='btn btn-sm btn-outline-info'  id='" +
                                data.id_opd +
                                "' onClick='data_edit(this.id)'><i class='fa fa-edit'></i>" +
                                "<button type='button' class='btn btn-sm btn-outline-danger'  id='" +
                                data.id_opd +
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
                url: "{{ route('admin.get.det.opd') }}",
                type: 'get',
                data: {
                    "id": clicked_id
                },
                success: function(data) {
                    $(".btn_bot").show(200);
                    $(".lihat").prop('disabled', false);
                    $('#e_nama').val(data.nama_opd);


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
                url: "{{ route('admin.get.det.opd') }}",
                type: 'get',
                data: {
                    "id": clicked_id
                },
                success: function(data) {
                    $(".btn_bot").hide(200);
                    $(".lihat").prop('disabled', true);
                    $('#e_nama').val(data.nama_opd);
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
                        url: "{{ route('admin.hapus.opd') }}",
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

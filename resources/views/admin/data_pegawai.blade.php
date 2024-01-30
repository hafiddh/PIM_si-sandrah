@extends('admin/temp_admin')
@section('judul', 'Data ASN')
@section('side_asn', 'active')
@section('side_asn2', 'show')
@section('side_daasn', 'active')
@section('judul2', 'Data Pegawai Negeri Sipil')

@section('tambah_css')
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
                    <h5 class="modal-title" style="color: white;">Form Tambah Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style=" color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tambah.pegawai') }}" method="post"
                    onsubmit="return confirm('Data akan disimpan, Pastikan data sudah benar?!');" class="d-inline">
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" name="nama" type="text" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">NIP</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" name="nip" type="text" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Jenis Kelamin</label>
                            <div class="col-md-10">
                                <select name="jk" class="form-control lihat">
                                    <option value="M">Laki-Laki</option>
                                    <option value="F">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Jabatan</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" name="jabatan" type="text" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">TTL</label>
                            <div class="col-md-3">
                                <input class="form-control lihat" name="tempat" type="text" value="">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control lihat" name="tanggal_lahir" type="text" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Masa Kerja</label>
                            <div class="col-md-4">
                                <input class="form-control lihat" name="masa1" type="text" value="">
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label form-control-label float-left">Tahun</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control lihat" name="masa2" type="text" value="">
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label form-control-label float-left">Bulan</label>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Tambah Pegawai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #5e72e4">
                    <h5 class="modal-title" style="color: white;">Form Pegawai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style=" color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.edit.pegawai') }}" method="post"
                    onsubmit="return confirm('Data akan di Update, Pastikan data sudah benar?!');" class="d-inline">
                    {{ csrf_field() }}

                    <div class="modal-body">

                        <input class="form-control" name="id" id="id_edit" value="" hidden>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" name="nama" id="nama" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">NIP</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" id="nip" name="nip" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Jenis Kelamin</label>
                            <div class="col-md-10">
                                <select name="jk" id="jenis_kel" class="form-control lihat">
                                    <option value="M">Laki-Laki</option>
                                    <option value="F">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Jabatan</label>
                            <div class="col-md-10">
                                <input class="form-control lihat" id="jabatan_as" name="jabatan" type="text"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">TTL</label>
                            <div class="col-md-3">
                                <input class="form-control lihat" id="tempat" name="tempat" type="text"
                                    value="">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control lihat" id="tanggal_lahir" name="tanggal_lahir" type="text"
                                    value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Masa Kerja</label>
                            <div class="col-md-4">
                                <input class="form-control lihat" id="masa1" name="masa1" type="text"
                                    value="">
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label form-control-label">Tahun</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control lihat" id="masa2" name="masa2" type="text"
                                    value="">
                            </div>
                            <div class="col-md-1">
                                <label class="col-md-2 col-form-label form-control-label">Bulan</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Unit Kerja</label>
                            <div class="col-md-10">
                                <select class="form-control lihat select2" name="opd" id="opd" value="">
                                    <option value="" selected disabled>- Pilih Unit Kerja -</option>
                                    @foreach ($opd as $op)
                                        <option value="{{ $op->id_opd }}">{{ $op->nama_opd }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">

                    </div>
                    <div class="modal-footer">
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
                                </i> Tambah pegawai</button>
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
                                        <th>NIP</th>
                                        <th>Nama</th>
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
                    url: "{{ url('admin/data_pegawai/get_data') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'id_pegawai',
                        // "visible": false,
                        "searchable": false
                    },
                    {
                        data: 'nip'
                    },
                    {
                        data: 'nama_pegawai'
                    },
                    {
                        data: 'nama_opd'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {

                            return "<button type='button' class='btn btn-sm btn-outline-success'  id='" +
                                data.id_pegawai +
                                "' onClick='data_lihat(this.id)'><i class='fa fa-eye'></i>" +
                                "<button type='button' class='btn btn-sm btn-outline-info'  id='" +
                                data.id_pegawai +
                                "' onClick='data_edit(this.id)'><i class='fa fa-edit'></i>" +
                                "<button type='button' class='btn btn-sm btn-outline-danger'  id='" +
                                data.id_pegawai +
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
                url: "{{ route('admin.get.pegawai') }}",
                type: 'get',
                data: {
                    "id": clicked_id
                },
                success: function(data) {
                    // console.log(data);
                    $(".lihat").prop('disabled', false);
                    $('#nama').val(data.nama_pegawai);
                    $('#nip').val(data.nip);
                    $('#jabatan').val(data.jabatan);
                    $('#masa1').val(data.mk_thn);
                    $('#masa2').val(data.mk_bln);
                    $('#opd').val(data.kode_opd).change();
                    $('#id_edit').val(data.id_pegawai);

                    $('#jenis_kel').val(data.jenis_kelamin).change();
                    $('#tempat').val(data.lahir_tempat);
                    $('#tanggal_lahir').val(data.lahir_tgl);
                    $('#jabatan_as').val(data.jabatan);


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
                url: "{{ route('admin.get.pegawai') }}",
                type: 'get',
                data: {
                    "id": clicked_id
                },
                success: function(data) {
                    // console.log(data);
                    $(".lihat").prop('disabled', true);
                    $('#nama').val(data.nama_pegawai);
                    $('#nip').val(data.nip);
                    $('#jabatan').val(data.jabatan);
                    $('#masa1').val(data.mk_thn);
                    $('#masa2').val(data.mk_bln);
                    $('#opd').val(data.kode_opd).change();
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
                    $.ajax({
                        url: "{{ route('admin.hapus.pegawai') }}",
                        type: 'get',
                        data: {
                            "id": clicked_id
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

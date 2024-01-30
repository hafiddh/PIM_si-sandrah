@extends('opd/opd_temp')
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
                <form action="{{ route('opd.tambah.pegawai') }}" method="post"
                    onsubmit="return confirm('Pegawai akan ditambahkan, Pastikan data sudah benar?!');" class="d-inline">
                    {{ csrf_field() }}

                    <div class="modal-body" style="margin-bottom: 50px;">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Pilih Pegawai</label>
                            <div class="col-md-10">
                                <select id="select_pegawai" name="id_peg" id="id_peg" class="form-control"></select>
                            </div>
                        </div>

                        <hr style="border-top: 1px solid black;">

                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning float-right"><i class="fa fa-edit"></i> Tambah
                            Pegawai</button>
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
                <form action="{{ route('opd.edit.pegawai') }}" method="post"
                    onsubmit="return confirm('Data akan di Update, Pastikan data sudah benar?!');" class="d-inline">
                    {{ csrf_field() }}

                    <div class="modal-body">

                        <input class="form-control" name="id" id="id_edit" value="" hidden>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control edit" name="nama" id="nama_hid" type="text"
                                    value="">

                                <input class="form-control" hidden name="nama" id="nama" type="text"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label form-control-label">NIP</label>
                            <div class="col-md-10">
                                <input class="form-control edit" id="nip_hid" name="nip" type="text"
                                    value="">

                                <input class="form-control " hidden name="nip" id="nip" type="text"
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
                    <div class="modal-footer" id="btn_foot" style="margin-top: -50px;">
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
                        <table class="table table-flush" id="datatable1" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Satuan Kerja</th>
                                    <th style="width: 5%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
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
    <script src="{{ asset('vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('') }}vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('js/sweet.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            loadData();

            $('.select2').select2();

            $('#select_pegawai').select2({
                placeholder: 'Cari berdasarkan Nama atau NIP ...',
                ajax: {
                    url: '/opd/select_pegawai_opd',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: '' + item.nama_pegawai + ' (' + item.nip + ')',
                                    id: item.id_pegawai
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#btn_foot').hide(200);

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
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/opd/get-opd-pegawai') }}",
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
            $(".edit").prop('disabled', true);

            $.ajax({
                url: "{{ route('opd.get.pegawai') }}",
                type: 'get',
                data: {
                    "id": clicked_id
                },
                success: function(data) {
                    // console.log(data);
                    $('#btn_foot').show(200);
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

                    $('#nama_hid').val(data.nama_pegawai);
                    $('#nip_hid').val(data.nip);


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
                url: "{{ route('opd.get.pegawai') }}",
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
                    $('#id_edit').val(data.id_pegawai);

                    $('#jenis_kel').val(data.jenis_kelamin).change();
                    $('#tempat').val(data.lahir_tempat);
                    $('#tanggal_lahir').val(data.lahir_tgl);
                    $('#jabatan_as').val(data.jabatan);

                    $('#nama_hid').val(data.nama_pegawai);
                    $('#nip_hid').val(data.nip);
                    $('#btn_foot').hide(200);
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
                        url: "{{ route('opd.hapus.pegawai') }}",
                        type: 'get',
                        data: {
                            "id": clicked_id
                        }
                    });
                    loadData();
                    swalWithBootstrapButtons.fire(
                        'Terhapus!',
                        'Data Berhasil diHapus!.',
                        'success'
                    )
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

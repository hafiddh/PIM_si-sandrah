@extends('admin/temp_admin')
@section('judul', 'Data Valid')
@section('side_kel', 'active')
@section('side_kel2', 'show')
@section('side_dakir', 'active')
@section('judul2', 'Data Valid')

@section('tambah_css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
    <style>
        .swal-text {
            text-align: center;
        }

    </style>
@endsection

@section('isi')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="table-responsive mt-3 py-4">
                    <table class="table table-flush" id="datatable_val">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>OPD</th>
                                <th>Bulan/Tahun</th>
                                <th>Tanggal Buat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $item->opd }}</td>
                                    <td>{{ $item->bulan . ' ' . $item->tahun }}</td>
                                    <td>
                                        <?php
                                        $originalDate = $item->waktu_up;
                                        $waktu = date('d-m-Y', strtotime($originalDate));
                                        echo $waktu;
                                        ?>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/detail_valid/' . $item->id) }}"
                                            class="btn btn-success btn-sm"> <i class="fa fa-list"
                                                title="Detail"></i></a>                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (session('status'))
        <div id="alert"></div>
    @endif

@endsection

@section('tambah_js')
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/nouislider/distribute/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/sweet.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable_val').DataTable({
                paging: true,
                "info": true,
                searching: true,
                autoWidth: true,
                "language": {
                    "emptyTable": "Tidak ada rekon baru"
                }
            });
        });
    </script>

    <script>
        $("#validasi").click(function() {
            let id = $(this).data("id");
            swal({
                    title: "Apakah anda yakin?",
                    text: "Data akan dihapus!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#valid').submit()
                    } else {
                        // swal("Your imaginary file is safe!");
                    }
                });
        });
    </script>

    <script>
        $("#revisi").click(function() {
            let id = $(this).data("id");
            swal({
                    title: "Data akan direvisi?!",
                    text: "Keterangan data akan diteruskan ke OPD yang bersangkutan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#frevisi').submit()
                    } else {
                        // swal("Your imaginary file is safe!");
                    }
                });
        });
    </script>

    <script>
        if ($('#alert').length > 0) {
            if ({{ session('kon') }} == "1") {
                swal("{{ session('status') }}", {
                    icon: "error",
                });
            } else if ({{ session('kon') }} == "2") {
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

    @php
        Session::forget('kon');
        Session::forget('stat');
        Session::forget('status');
    @endphp

@endsection

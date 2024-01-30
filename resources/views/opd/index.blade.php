@extends('opd.opd_temp')
@section('judul', 'Admin OPD')
@section('side_dash', 'active')
@section('tambah_css')
    {{--  --}}
@endsection

@section('tambah_js')
    <script src="{{ asset('vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/dist/Chart.extension.js') }}"></script>
    {{--  --}}
@endsection

@section('index_head')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Data Aset</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $aset }}
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-collection"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-md-6">
            <div class="row" style="position:absolute; right:50px; top:-30px;">
                <img src="{{ asset('login_res/img/logo_morowali.png') }}" width="150" alt="">
            </div>
        </div>

    </div>
@endsection

@section('isi')


@endsection

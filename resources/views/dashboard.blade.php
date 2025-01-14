@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                </div>
            </div>
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="info-box bg-info" style="border-radius: 10px !important;">
                        <span class="info-box-icon"><i class="far fa-chart-bar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pagu Anggaran Ditjen Bina Adwil</span>
                            <span class="info-box-number">{{number_format($data_pagu->pagu)}}</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                <small>
                                    &nbsp; <br>
                                    {{$data_pagu->title}}. Tanggal: {{date("d/m/Y", strtotime($data_pagu->tanggal))}}
                                </small>
                                <span class="float-right">
                                    <a class="text-white btn btn-xs bg-primary" href="javascript:void(0)" style="border-radius: 5px;" onclick="detailPagu()">
                                        <small>Lihat Detail &nbsp; <i class="fas fa-arrow-circle-right"></i></small>
                                    </a>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="info-box bg-success" style="border-radius: 10px !important;">
                        <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Realisasi Anggaran Ditjen Bina Adwil</span>
                            <span class="info-box-number">
                                {{number_format($realisasi)}}
                            </span>
                            <div class="progress">
                                @php
                                    $persen_realisasi   = $realisasi/$anggaran*100;
                                @endphp
                                <div class="progress-bar" style="width: {{$persen_realisasi}}%"></div>
                            </div>
                            <span class="progress-description">
                                ({{number_format((float)$persen_realisasi, 2, '.', '')}}%) <br>
                                <small>
                                    Data Berdasarkan SP2D MonSAKTI: {{date("d/m/Y, H:i:s", strtotime($last_synch_real))}}
                                </small>
                                <span class="float-right">
                                    <a class="text-white btn btn-xs bg-teal" href="javascript:void(0)" style="border-radius: 5px;" data-toggle="modal" data-target="#modal-detail-realisasi">
                                        <small>Lihat Detail &nbsp; <i class="fas fa-arrow-circle-right"></i></small>
                                    </a>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="info-box bg-danger" style="border-radius: 10px !important;">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sisa Anggaran Ditjen Bina Adwil</span>
                            <span class="info-box-number">
                                {{number_format($selisih)}}
                            </span>
                            <div class="progress">
                                @php
                                    $persen_selisih = $selisih/$anggaran*100;
                                @endphp
                                <div class="progress-bar" style="width: {{$persen_selisih}}%"></div>
                            </div>
                            <span class="progress-description">
                                ({{number_format((float)$persen_selisih, 2, '.', '')}}%)<br>
                                <small>
                                    &nbsp;
                                </small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card card-primary card-outline" style="border-radius: 10px !important;">
                        <div class="card-header">
                            <h5>Realisasi Anggaran per Eselon 1 Lingkup Kemendagri</h5>
                        </div>
                        <div class="card-body">
                            <div class="position-relative mb-4">
                                <canvas id="sales-chart" height="490"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-primary card-outline" style="border-radius: 10px !important;">
                        <div class="card-header">
                            <h5>Realisasi Anggaran per Kewenangan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="card card-warning" style="border-radius: 10px !important;">
                                        <div class="card-header">
                                            <div class="font-weight-bolder">
                                                PUSAT (Total)
                                            </div>
                                            <div class="mt-3">
                                                <a class="btn btn-block bg-warning" href="javascript:void(0)" style="border-radius: 5px;" data-toggle="modal" data-target="#modal-detail-pusat">
                                                    Lihat Detail &nbsp; <i class="fas fa-arrow-circle-right"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- <div class="card-header">
                                            <div class="font-weight-bolder card-title">
                                                RM+PHLN
                                            </div>
                                            <span class="float-right">
                                                <a class="btn btn-xs bg-warning" href="javascript:void(0)" style="border-radius: 5px;" data-toggle="modal" data-target="#modal-detail-pagu">
                                                    <small>Lihat Detail &nbsp; <i class="fas fa-arrow-circle-right"></i></small>
                                                </a>
                                            </span>
                                        </div> -->

                                        <div class="card-body">
                                            <table class="table table-borderless" style="font-size: 0.7em">
                                                @php
                                                    $persen_pagu_pusat      = $pagu_pusat/$anggaran*100;
                                                    $persen_realisasi_pusat = $realisasi_pusat/$pagu_pusat*100;
                                                    $persen_sisa_pusat      = $sisa_pusat/$pagu_pusat*100;
                                                @endphp
                                                <tr>
                                                    <td class="align-middle">Pagu (Total)</td>
                                                    <td class="align-middle">:</td>
                                                    <td class="align-middle">
                                                        Rp. {{number_format($pagu_pusat)}} &nbsp; ({{number_format((float)$persen_pagu_pusat, 2, '.', '')}}%)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle">Realisasi (Total)</td>
                                                    <td class="align-middle">:</td>
                                                    <td class="align-middle">Rp. {{number_format($realisasi_pusat)}} &nbsp; ({{number_format((float)$persen_realisasi_pusat, 2, '.', '')}}%)</td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle">Sisa Total</td>
                                                    <td class="align-middle">:</td>
                                                    <td class="align-middle">Rp. {{number_format($sisa_pusat)}} &nbsp; ({{number_format((float)$persen_sisa_pusat, 2, '.', '')}}%)</td>
                                                </tr>
                                            </table>

                                            <div class="row mt-3">
                                                <canvas id="chart-pusat" height="150"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="card card-purple" style="border-radius: 10px !important;">
                                        <div class="card-header">
                                            <div class="font-weight-bolder">DEKONSENTRASI</div>
                                            <div class="mt-3" style="height: 35px;">
                                                &nbsp;
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <table class="table table-borderless" style="font-size: 0.7em">
                                                @php
                                                    if($pagu_dekon == 0)
                                                    {
                                                        $persen_pagu_dekon      = 0;
                                                        $persen_realisasi_dekon = 0;
                                                        $persen_sisa_dekon      = 0;
                                                    }
                                                    else
                                                    {
                                                        $persen_pagu_dekon      = $pagu_dekon/$anggaran*100;
                                                        $persen_realisasi_dekon = $realisasi_dekon/$pagu_dekon*100;
                                                        $persen_sisa_dekon      = $sisa_dekon/$pagu_dekon*100;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>Pagu</td>
                                                    <td>:</td>
                                                    <td>Rp. {{number_format($pagu_dekon)}} &nbsp; ({{number_format((float)$persen_pagu_dekon, 2, '.', '')}}%)</td>
                                                </tr>
                                                <tr>
                                                    <td>Realisasi</td>
                                                    <td>:</td>
                                                    <td>Rp. {{number_format($realisasi_dekon)}} &nbsp; ({{number_format((float)$persen_realisasi_dekon, 2, '.', '')}}%)</td>
                                                </tr>
                                                <tr>
                                                    <td>Sisa</td>
                                                    <td>:</td>
                                                    <td>Rp. {{number_format($sisa_dekon)}}  &nbsp; ({{number_format((float)$persen_sisa_dekon, 2, '.', '')}}%)</td>
                                                </tr>
                                            </table>

                                            <div class="row mt-3">
                                                <canvas id="chart-dekon" height="150"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="card card-fuchsia" style="border-radius: 10px !important;">
                                        <div class="card-header">
                                            <div class="font-weight-bolder">TUGAS PEMBANTUAN</div>
                                            <div class="mt-3" style="height: 35px;">
                                                &nbsp;
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <table class="table table-borderless" style="font-size: 0.7em">
                                                @php
                                                    if($pagu_tp <> 0)
                                                    {
                                                        $persen_pagu_tp      = $pagu_tp/$anggaran*100;
                                                        $persen_realisasi_tp = $realisasi_tp/$pagu_tp*100;
                                                        $persen_sisa_tp      = $sisa_tp/$pagu_tp*100;
                                                    }
                                                    else
                                                    {
                                                        $persen_pagu_tp      = 0;
                                                        $persen_realisasi_tp = 0;
                                                        $persen_sisa_tp      = 100;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>Pagu</td>
                                                    <td>:</td>
                                                    <td>Rp. {{number_format($pagu_tp)}} &nbsp; ({{number_format((float)$persen_pagu_tp, 2, '.', '')}}%)</td>
                                                </tr>
                                                <tr>
                                                    <td>Realisasi</td>
                                                    <td>:</td>
                                                    <td>Rp. {{number_format($realisasi_tp)}} &nbsp; ({{number_format((float)$persen_realisasi_tp, 2, '.', '')}}%)</td>
                                                </tr>
                                                <tr>
                                                    <td>Sisa</td>
                                                    <td>:</td>
                                                    <td>Rp. {{number_format($sisa_tp)}}  &nbsp; ({{number_format((float)$persen_sisa_tp, 2, '.', '')}}%)</td>
                                                </tr>
                                            </table>

                                            <div class="row mt-3">
                                                <canvas id="chart-tp" height="150"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="modal-detail-realisasi">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white">Detail Realisasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_realisasi_pusat" data-toggle="tab">Realisasi Pusat</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_realisasi_dekon" data-toggle="tab">Realisasi Dekonsentrasi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_realisasi_tp" data-toggle="tab">Realisasi TP</a></li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_realisasi_pusat">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="card card-warning" style="border-radius: 10px !important;">
                                                <div class="overlay" id="loader-detail-pusat" style="display: none">
                                                    <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
                                                </div>
                                                <div class="card-header">
                                                    <div class="font-weight-bolder card-title">DETAIL REALISASI PUSAT</div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="table-responsive col-md-12">
                                                            <table class="table table-bordered text-sm" id="detail-pusat">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center" style="width: 40%">Satuan Kerja</th>
                                                                        <th class="text-center" style="width: 15%">Pagu</th>
                                                                        <th class="text-center" style="width: 15%">Realisasi</th>
                                                                        <th class="text-center" style="width: 15%">Persentase</th>
                                                                        <th class="text-center" style="width: 15%">Sisa</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_realisasi_dekon">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="card card-purple" style="border-radius: 10px !important;">
                                                <div class="overlay" id="loader-detail-dekon" style="display: none">
                                                    <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
                                                </div>
                                                <div class="card-header">
                                                    <div class="font-weight-bolder card-title">DETAIL REALISASI DEKONSENTRASI</div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12 table-responsive">
                                                            <table class="table table-bordered" id="detail-dekon">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center" style="width: 40%">Satuan Kerja</th>
                                                                        <th class="text-center" style="width: 15%">Pagu</th>
                                                                        <th class="text-center" style="width: 15%">Realisasi</th>
                                                                        <th class="text-center" style="width: 15%">Persentase</th>
                                                                        <th class="text-center" style="width: 15%">Sisa</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_realisasi_tp">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="card card-fuchsia" style="border-radius: 10px !important;">
                                                <div class="overlay" id="loader-detail-tp" style="display: none">
                                                    <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
                                                </div>
                                                <div class="card-header">
                                                    <div class="font-weight-bolder card-title">DETAIL REALISASI TP</div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12 table-responsive">
                                                            <table class="table table-bordered" id="detail-tp">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center" style="width: 40%">Satuan Kerja</th>
                                                                        <th class="text-center" style="width: 15%">Pagu</th>
                                                                        <th class="text-center" style="width: 15%">Realisasi</th>
                                                                        <th class="text-center" style="width: 15%">Persentase</th>
                                                                        <th class="text-center" style="width: 15%">Sisa</th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-realisasi-detail-dekon">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white">Detail Data Realisasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-md-12 col-sm-12">
                            <div class="card card-info" style="border-radius: 10px !important;">
                                <div class="overlay" id="loader-realisasi-detail-dekon" style="display: none">
                                    <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
                                </div>
                                <div class="card-header">
                                    <div class="font-weight-bolder card-title text-uppercase">REALISASI <span id="title-satker-dekon"></span></div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="table-responsive col-md-12">
                                            <table class="table table-bordered text-sm" id="realisasi-detail-dekon">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 5%">Kode Subkomponen</th>
                                                        <th class="text-center" style="width: 35%">Tugas</th>
                                                        <th class="text-center" style="width: 15%">Pagu</th>
                                                        <th class="text-center" style="width: 15%">Realisasi</th>
                                                        <th class="text-center" style="width: 15%">Persentase</th>
                                                        <th class="text-center" style="width: 15%">Sisa</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-realisasi-detail-pusat">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white">Detail Data Realisasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-md-12 col-sm-12">
                            <div class="card card-info" style="border-radius: 10px !important;">
                                <div class="overlay" id="loader-realisasi-detail-pusat" style="display: none">
                                    <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
                                </div>
                                <div class="card-header">
                                    <div class="font-weight-bolder card-title text-uppercase">REALISASI <span id="title-pusat"></span></div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="table-responsive col-md-12">
                                            <table class="table table-bordered text-sm" id="realisasi-detail-pusat">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 40%">UKE III</th>
                                                        <th class="text-center" style="width: 15%">Pagu</th>
                                                        <th class="text-center" style="width: 15%">Realisasi</th>
                                                        <th class="text-center" style="width: 15%">Persentase</th>
                                                        <th class="text-center" style="width: 15%">Sisa</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-detail-pagu">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white">History Pagu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-md-12 col-sm-12">
                            <div class="card card-info" style="border-radius: 10px !important;">
                                <div class="overlay" id="loader-detail-pusat" style="display: none">
                                    <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
                                </div>
                                <div class="card-header">
                                    <div class="font-weight-bolder card-title">DETAIL HISTORY PAGU</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="table-responsive col-md-12">
                                            <table class="table table-bordered text-sm" id="detail-pagu">
                                                <thead>
                                                    <tr>
                                                        <th class="align-middle" style="width: 10%">History</th>
                                                        <th class="align-middle text-center" style="width: 15%">Tanggal</th>
                                                        <th class="align-middle text-center" style="width: 25%">Pagu</th>
                                                        <th class="align-middle text-center" style="width: 40%">Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-detail-pusat">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white">Detail Pagu Pusat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <!-- Custom Tabs -->
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <ul class="nav nav-pills ml-auto p-2">
                                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Rupiah Murni (RM)</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">PHLN</a></li>
                                    </ul>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="card card-warning" style="border-radius: 10px !important;">
                                                        <div class="card-header">
                                                            <div class="font-weight-bolder card-title">Rupiah Murni (RM)</div>
                                                        </div>

                                                        <div class="card-body">
                                                            <table class="text-sm table table-borderless">
                                                                @php
                                                                    $persen_rm_pusat        = $rm_pusat/$pagu_pusat*100;
                                                                    $persen_realisasi_rm    = $realisasi_pusat/$rm_pusat*100;
                                                                    $persen_sisa_rm         = $sisa_rm_pusat/$rm_pusat*100;

                                                                    $realisasi_rm_pusat     = $realisasi_pusat-$realisasi_phln;
                                                                    $sisa_rm_pusat          = $rm_pusat-$realisasi_rm_pusat;

                                                                    $persen_sisa_rm         = ($sisa_rm_pusat/$rm_pusat)*100;
                                                                    $persen_realisasi_rm    = 100-$persen_sisa_rm;
                                                                @endphp
                                                                <tr>
                                                                    <td class="align-middle">Pagu (RM)</td>
                                                                    <td class="align-middle">:</td>
                                                                    <td class="align-middle">
                                                                        Rp. {{number_format($rm_pusat)}} &nbsp; ({{number_format((float)$persen_rm_pusat, 2, '.', '')}}%)
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="align-middle">Realisasi (RM)</td>
                                                                    <td class="align-middle">:</td>
                                                                    <td class="align-middle">Rp. {{number_format($realisasi_pusat-$realisasi_phln)}} &nbsp; ({{number_format((float)$persen_realisasi_rm, 2, '.', '')}}%)</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="align-middle">Sisa (RM)</td>
                                                                    <td class="align-middle">:</td>
                                                                    <td class="align-middle">Rp. {{number_format($sisa_rm_pusat)}} &nbsp; ({{number_format((float)$persen_sisa_rm, 2, '.', '')}}%)</td>
                                                                </tr>
                                                            </table>

                                                            <div class="row mt-3">
                                                                <canvas id="chart-pusat-rm" height="150"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_2">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="card card-warning" style="border-radius: 10px !important;">
                                                    <div class="card-header">
                                                        <div class="font-weight-bolder card-title">PUSAT (PHLN)</div>
                                                    </div>

                                                    <div class="card-body">
                                                        <table class="text-sm table table-borderless">
                                                            @php
                                                                $persen_pagu_phln       = $phln_pusat/$pagu_pusat*100;
                                                                $persen_realisasi_phln  = $realisasi_phln/$phln_pusat*100;
                                                                $persen_sisa_phln       = (($phln_pusat-$realisasi_phln)/$phln_pusat)*100;
                                                            @endphp
                                                            <tr>
                                                                <td class="align-middle">Pagu (PHLN)</td>
                                                                <td class="align-middle">:</td>
                                                                <td class="align-middle">
                                                                    Rp. {{number_format($phln_pusat)}} &nbsp; ({{number_format((float)$persen_pagu_phln, 2, '.', '')}}%)
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-middle">Realisasi (PHLN)</td>
                                                                <td class="align-middle">:</td>
                                                                <td class="align-middle">Rp. {{number_format($realisasi_phln)}} &nbsp; ({{number_format((float)$persen_realisasi_phln, 2, '.', '')}}%)</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-middle">Sisa (PHLN)</td>
                                                                <td class="align-middle">:</td>
                                                                <td class="align-middle">Rp. {{number_format($phln_pusat-$realisasi_phln)}} &nbsp; ({{number_format((float)$persen_sisa_phln, 2, '.', '')}}%)</td>
                                                            </tr>
                                                        </table>

                                                        <div class="row mt-3">
                                                            <canvas id="chart-pusat-phln" height="150"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('js')
    <script>
        window.onload=function(){
            Chart.scaleService.updateScaleDefaults('linear', {
            ticks: {
                callback: function(tick) {
                return tick.toLocaleString('id-ID');
                }
            }
            });
            Chart.defaults.global.tooltips.callbacks.label = function(tooltipItem, data) {
                var dataset         = data.datasets[tooltipItem.datasetIndex];
                var datasetLabel    = dataset.label || '';
                var nama_satker     = data.labels[tooltipItem.index]

                return datasetLabel + ": " + dataset.data[tooltipItem.index].toLocaleString() + "% "+getRealisasiGrafik(tooltipItem.index);
            };

            'use strict'

            var ticksStyle = {
                fontColor: '#ffffff',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var $salesChart = $('#sales-chart')
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart($salesChart, {
                type: 'bar',
                data: {
                labels: {!! $satker_eselon1 !!},
                datasets: [
                    {
                        backgroundColor: {!! $color !!},
                        data: {!! $real_eselon1 !!}
                    }
                ]},
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,

                            // Include a dollar sign in the ticks
                            callback: function (value) {
                                
                                // if (value >= 1000000) {
                                //     value /= 1000000
                                //     value += ' JT'
                                // }

                                return value.toLocaleString('en-US')+"%"
                            }
                        }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        }
        
        $(function () {
            // 'use strict'

            // var ticksStyle = {
            //     fontColor: '#ffffff',
            //     fontStyle: 'bold'
            // }

            // var mode = 'index'
            // var intersect = true
        });
        
        loadDetailTp()
        loadDetailPusat()
        loadDetailDekon()

            window.setTimeout( function() {
                window.location.reload();
            }, 3600000);


            var pieChartCanvas = $('#chart-pusat').get(0).getContext('2d')
            var pieData = {
                labels: [
                    'Realisasi',
                    'Sisa'
                ],
                datasets: [
                {
                    data: [{{number_format((float)$persen_realisasi_pusat, 2, '.', '')}}, {{number_format((float)$persen_sisa_pusat, 2, '.', '')}}],
                    backgroundColor: ['#F39C12', '#a7a7a0']
                }
                ]
            }
            var pieOptions = {
                legend: {
                display: false
                }
            }
            // Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            // eslint-disable-next-line no-unused-vars
            var pieChart = new Chart(pieChartCanvas, {
                type: 'doughnut',
                data: pieData,
                options: pieOptions
            })

            var pieChartCanvas = $('#chart-pusat-rm').get(0).getContext('2d')
            var pieData = {
                labels: [
                    'Realisasi',
                    'Sisa'
                ],
                datasets: [
                {
                    data: [{{number_format((float)$persen_realisasi_rm, 2, '.', '')}}, {{number_format((float)$persen_sisa_rm, 2, '.', '')}}],
                    backgroundColor: ['#F39C12', '#a7a7a0']
                }
                ]
            }
            var pieOptions = {
                legend: {
                display: false
                }
            }
            // Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            // eslint-disable-next-line no-unused-vars
            var pieChart = new Chart(pieChartCanvas, {
                type: 'doughnut',
                data: pieData,
                options: pieOptions
            })

            var pieChartCanvas = $('#chart-pusat-phln').get(0).getContext('2d')
            var pieData = {
                labels: [
                    'Realisasi',
                    'Sisa'
                ],
                datasets: [
                {
                    data: [{{number_format((float)$persen_realisasi_phln, 2, '.', '')}}, {{number_format((float)$persen_sisa_phln, 2, '.', '')}}],
                    backgroundColor: ['#F39C12', '#a7a7a0']
                }
                ]
            }
            var pieOptions = {
                legend: {
                display: false
                }
            }
            // Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            // eslint-disable-next-line no-unused-vars
            var pieChart = new Chart(pieChartCanvas, {
                type: 'doughnut',
                data: pieData,
                options: pieOptions
            })

            //-----------------
            // - END PIE CHART -
            //-----------------

            var pieChartCanvas = $('#chart-dekon').get(0).getContext('2d')
            var pieData = {
                labels: [
                    'Realisasi',
                    'Sisa'
                ],
                datasets: [
                {
                    data: [{{number_format((float)$persen_realisasi_dekon, 2, '.', '')}}, {{number_format((float)$persen_sisa_dekon, 2, '.', '')}}],
                    backgroundColor: ['#6F42C1', '#a7a7a0']
                }
                ]
            }
            var pieOptions = {
                legend: {
                display: false
                }
            }
            // Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            // eslint-disable-next-line no-unused-vars
            var pieChart = new Chart(pieChartCanvas, {
                type: 'doughnut',
                data: pieData,
                options: pieOptions
            })

            //-----------------
            // - END PIE CHART -
            //-----------------

            var pieChartCanvas = $('#chart-tp').get(0).getContext('2d')
            var pieData = {
                labels: [
                    'Realisasi',
                    'Sisa'
                ],
                datasets: [
                {
                    data: [{{number_format((float)$persen_realisasi_tp, 2, '.', '')}}, {{number_format((float)$persen_sisa_tp, 2, '.', '')}}],
                    backgroundColor: ['#F672D8', '#a7a7a0']
                }
                ]
            }
            var pieOptions = {
                legend: {
                display: false
                }
            }
            // Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            // eslint-disable-next-line no-unused-vars
            var pieChart = new Chart(pieChartCanvas, {
                type: 'doughnut',
                data: pieData,
                options: pieOptions
            })

            //-----------------
            // - END PIE CHART -
            //-----------------

            function detailPagu()
            {
                $('#modal-detail-pagu').modal('show')

                $.post('{{ route('master.history-pagu') }}', {_token: '{{csrf_token()}}'}, function(e){

                    $("#detail-pagu").DataTable().destroy();

                    $("#detail-pagu").DataTable({
                        data: e,
                        paging: true,
                        lengthChange: false,
                        searching: true,
                        ordering: false,
                        info: true,
                        autoWidth: false,
                        responsive: false,
                        columns: [
                                { data: 'title', className:"align-middle"},
                                { data: 'tgl', className:"align-middle text-center"},
                                { data: 'nominal', className:"align-middle text-right"},
                                { data: 'keterangan', className:"align-middle"}
                        ],
                        buttons: ["csv", "excel", "pdf", "print"],
                    })
                    .buttons()
                    .container()
                    .appendTo("#detail-pagu_wrapper .col-md-6:eq(0)");

                    $('#loader-datatable').hide()

                    });
            }

            function loadDetailPusat()
            {
                $('#loader-detail-pusat').show()

                $.post('{{ route('sakti.detail-pusat') }}', {_token: '{{csrf_token()}}'}, function(e){

                    $("#detail-pusat").DataTable().destroy();

                    $("#detail-pusat").DataTable({
                        data: e,
                        paging: false,
                        lengthChange: false,
                        searching: true,
                        info: false,
                        autoWidth: false,
                        order: [[4, 'desc']],
                        responsive: false,
                        columns: [
                                { data: 'nama_dir', className:"align-middle"},
                                { data: 'total_anggaran', className:"text-right align-middle"},
                                { data: 'total_realisasi', className:"text-right align-middle"},
                                { data: 'total_persentase', className:"text-right align-middle"},
                                { data: 'total_sisa', className:"text-right align-middle"}
                        ],
                        buttons: ["csv", "excel", "pdf", "print"],
                    })
                    .buttons()
                    .container()
                    .appendTo("#detail-pusat_wrapper .col-md-6:eq(0)");

                    $('#loader-detail-pusat').hide()

                });
            }

            function loadDetailDekon()
            {
                $('#loader-detail-dekon').show()

                $.post('{{ route('sakti.detail-dekon') }}', {_token: '{{csrf_token()}}'}, function(e){

                    $("#detail-dekon").DataTable().destroy();

                    $("#detail-dekon").DataTable({
                        data: e,
                        paging: true,
                        lengthChange: false,
                        searching: true,
                        info: true,
                        autoWidth: false,
                        order: [[1, 'desc']],
                        responsive: false,
                        columns: [
                                { data: 'nama_satker', className:"align-middle"},
                                { data: 'total_anggaran', className:"text-right align-middle"},
                                { data: 'total_realisasi', className:"text-right align-middle"},
                                { data: 'total_persentase', className:"text-right align-middle"},
                                { data: 'total_sisa', className:"text-right align-middle"}
                        ],
                        buttons: ["csv", "excel", "pdf", "print"],
                    })
                    .buttons()
                    .container()
                    .appendTo("#detail-dekon_wrapper .col-md-6:eq(0)");

                    $('#loader-detail-dekon').hide()

                });
            }

            function loadDetailTp()
            {
                $('#loader-detail-tp').show()

                $.post('{{ route('sakti.detail-tp') }}', {_token: '{{csrf_token()}}'}, function(e){

                    $("#detail-tp").DataTable().destroy();

                    $("#detail-tp").DataTable({
                        data: e,
                        paging: true,
                        lengthChange: false,
                        searching: true,
                        info: true,
                        autoWidth: false,
                        order: [[1, 'desc']],
                        responsive: false,
                        columns: [
                                { data: 'nama_satker', className:"align-middle"},
                                { data: 'total_anggaran', className:"text-right align-middle"},
                                { data: 'total_realisasi', className:"text-right align-middle"},
                                { data: 'total_persentase', className:"text-right align-middle"},
                                { data: 'total_sisa', className:"text-right align-middle"}
                        ],
                        buttons: ["csv", "excel", "pdf", "print"],
                    })
                    .buttons()
                    .container()
                    .appendTo("#detail-tp_wrapper .col-md-6:eq(0)");

                    $('#loader-detail-tp').hide()

                });
            }

            function loadSubDetailDekon(id, nama_satker)
            {
                $('#modal-realisasi-detail-dekon').modal('show')
                $('#title-satker-dekon').empty().append(nama_satker)
                $('#loader-realisasi-detail-dekon').show()

                $.post('{{ route('sakti.subdetail-dekon') }}', {id, _token: '{{csrf_token()}}'}, function(e){

                    $("#realisasi-detail-dekon").DataTable().destroy();

                    $("#realisasi-detail-dekon").DataTable({
                        data: e,
                        paging: true,
                        lengthChange: false,
                        searching: true,
                        info: true,
                        autoWidth: false,
                        responsive: false,
                        columns: [
                                { data: 'kode_subkomponen', className:"align-middle text-center"},
                                { data: 'tugas', className:"align-middle"},
                                { data: 'total_anggaran', className:"text-right align-middle"},
                                { data: 'total_realisasi', className:"text-right align-middle"},
                                { data: 'total_persentase', className:"text-right align-middle"},
                                { data: 'total_sisa', className:"text-right align-middle"}
                        ],
                        buttons: ["csv", "excel", "pdf", "print"],
                    })
                    .buttons()
                    .container()
                    .appendTo("#realisasi-detail-dekon_wrapper .col-md-6:eq(0)");

                    $('#loader-realisasi-detail-dekon').hide()

                });
            }

            function loadSubDetailPusat(direktorat, nama_direktorat)
            {
                $('#modal-realisasi-detail-pusat').modal('show')
                $('#title-pusat').empty().append(nama_direktorat)
                $('#loader-realisasi-detail-pusat').show()

                $.post('{{ route('sakti.subdetail-pusat') }}', {direktorat, _token: '{{csrf_token()}}'}, function(e){

                    $("#realisasi-detail-pusat").DataTable().destroy();

                    $("#realisasi-detail-pusat").DataTable({
                        data: e,
                        paging: true,
                        lengthChange: false,
                        searching: true,
                        info: true,
                        autoWidth: false,
                        responsive: false,
                        columns: [
                                { data: 'subdirektorat', className:"align-middle"},
                                { data: 'total_anggaran', className:"text-right align-middle"},
                                { data: 'total_realisasi', className:"text-right align-middle"},
                                { data: 'total_persentase', className:"text-right align-middle"},
                                { data: 'total_sisa', className:"text-right align-middle"}
                        ],
                        buttons: ["csv", "excel", "pdf", "print"],
                    })
                    .buttons()
                    .container()
                    .appendTo("#realisasi-detail-pusat_wrapper .col-md-6:eq(0)");

                    $('#loader-realisasi-detail-pusat').hide()

                });
            }

            function getRealisasiGrafik(index)
            {
                var data_satker = {!! $data_es1 !!}
                var realisasi   = parseInt(data_satker[index].realisasi)
                
                return "(Rp. "+realisasi.toLocaleString('id-ID')+")";
            }
    </script>
@endsection

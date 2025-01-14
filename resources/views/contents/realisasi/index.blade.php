@extends('layouts.caput')

@section('contents')
<div class="main">
    <div class="topbar">
        <div class="toggle col-md-1"  id="menuNav">
            <a href="#menuNav">
                <i class="fas fa-bars"></i>
            </a>
        </div>
        <div class="col-md-8 d-flex logo-admin">
            <img src="{{asset('newdashboard/images/logo-emonev.png')}}" alt="logo emonev" class="img-fluid margin-auto logo-smaller">
            <div class="text-center">
                <h1 class="title">E-MONEV</h1>
                <h2 class="subtitle">DITJEN BINA ADMINISTRASI KEWILAYAHAN</h2>
            </div>
        </div>
        <div class="avatar col-md-3 p-2 d-flex">
            <img src="{{asset('newdashboard/images/user-avatar.png')}}" alt="" class="img-fluid avatar-img me-2">
            <div class="avatar-name small fw-bold">
                Selamat Datang Admin,<br>
                Bagian Perencanaan
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="font-tebala col-sm-6" style="background-color:#ebebeb;">
            {{$current}}
        </div>
        <div class="col-md-6 font-tebala" style="background-color:#ebebeb; text-align: right">
            <a href="#">{{$modul}}</a>
            {{$current}}
        </div>
    </div>
    <div style="height:10px"></div> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Realisasi</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('tes.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambahkan File Realisasi
                        </a>
                    </div>

                    
                    <table id="realisasiTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jumlah Revisi</th>
                                <th>Bukti Revisi</th>
                                <th>Pagu Pusat</th>
                                <th>Pagu Dekonsentrasi</th>
                                <th>Tanggal Dibuat</th>
                                <th>Tanggal Diupdate</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($realisasis as $realisasi)
                            
                            <tr>
                                <td>{{ $realisasi->no }}</td>
                                <td>
                                    @if($realisasi->bukti_ref)
                                        @php
                                            $excelPath = storage_path('app/public/bukti_ref/' . $realisasi->bukti_ref);
                                            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
                                            $spreadsheet = $reader->load($excelPath);
                                            $worksheet = $spreadsheet->getActiveSheet();
                                            $an5Value = $worksheet->getCell('AN5')->getValue();
                                            $an6Value = $worksheet->getCell('AN6')->getValue();
                                            $jml_revisi = $an5Value + $an6Value;
                                        @endphp
                                        Rp {{ number_format($jml_revisi, 0, ',', '.') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($realisasi->bukti_ref)
                                        <a href="{{ url('tes/' . $realisasi->no . '/download') }}" target="_blank">
                                            <small>{{ $realisasi->bukti_ref }}</small>
                                        </a>
                                    @else
                                        No file
                                    @endif
                                </td>
                                <td>
                                    @if($realisasi->bukti_ref)
                                        @php
                                            $excelPath = storage_path('app/public/bukti_ref/' . $realisasi->bukti_ref);
                                            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
                                            $spreadsheet = $reader->load($excelPath);
                                            $worksheet = $spreadsheet->getActiveSheet();
                                            $an5Value = $worksheet->getCell('AN5')->getValue();
                                        @endphp
                                        Rp {{ number_format($an5Value, 0, ',', '.') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($realisasi->bukti_ref)
                                        @php
                                            $an6Value = $worksheet->getCell('AN6')->getValue();
                                        @endphp
                                        Rp {{ number_format($an6Value, 0, ',', '.') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $realisasi->created_at }}</td>
                                <td>{{ $realisasi->updated_at }}</td>
                                <td>
                                    <a href="{{ route('tes.edit', ['id' => $realisasi->id]) }}" class="btn btn-success btn-sm">Edit</a>
                                    {{-- <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $realisasi->id }}">Delete</button> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#realisasiTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#realisasiTable_wrapper .col-md-6:eq(0)');

        // Delete button click event
        $('.delete-btn').on('click', function() {
            var id = $(this).data('id');
            // Add your delete logic here
            console.log('Delete clicked for id: ' + id);
        });
    });
</script>


@endsection
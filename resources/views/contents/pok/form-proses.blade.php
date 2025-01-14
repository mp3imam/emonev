<section class="content" style="display:none" id="wrap-form-proses">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12">
            <button class="btn btn-danger" onclick="openData()"><i class="fas fa-backspace"></i> &nbsp;Back</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="overlay" id="loader-proses" style="display: none">
                        <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
                    </div>
                    <div class="card-header">
                        <h1 class="card-title" style="font-weight: bolder">Dokumen Pengajuan Revisi (PPTK)</h1>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3" style="height: 100%">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center">Nota Dinas PPTK (Sudah Sign)</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span id="nota_dinas_pptk_proses"></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3" style="height: 100%">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center">Matrik RAB Semula Menjadi</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span id="matrik_rab_proses"></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3" style="height: 100%">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center">KAK</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span id="kak_proses"></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3" style="height: 100%">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center">Dokumen Pendukung</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span id="dokumen_pendukung_proses"></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @if(Auth::user()->level == "6" || Auth::user()->level == "2")
                            <div class="col-md-6" style="height: 100%">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center">Nota Dinas Pengantar Kabagren</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span id="nota_dinas_pengantar_proses"></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @endif
                            @if(Auth::user()->level == "2")
                            <div class="col-md-6" style="height: 100%">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center">Nota Dinas Pengantar Kabagkeu</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span id="lampiran_kabagkeu_proses"></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="width: 100%">
                                    <tr>
                                        <td class="align-middle" style="width: 45%">ID Pengajuan Revisi</td>
                                        <td class="align-middle" style="width: 50%"> <input type="text" id="id_revisi_proses" class="form-control" disabled> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle" style="width: 45%">Tahun Anggaran</td>
                                        <td class="align-middle" style="width: 50%"> <span id="tahun_anggaran_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Nomor Surat</td>
                                        <td class="align-middle"> <span id="nomor_surat_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Tanggal Surat</td>
                                        <td class="align-middle"> <span id="tanggal_surat_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Satuan Kerja</td>
                                        <td class="align-middle"> <span id="satker_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Provinsi</td>
                                        <td class="align-middle"> <span id="provinsi_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Unit Kerja</td>
                                        <td class="align-middle"> <span id="direktorat_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Jenis Revisi</td>
                                        <td class="align-middle"> <span class="text-uppercase" id="jenis_revisi_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Nama Pejabat</td>
                                        <td class="align-middle"> <span id="nama_pejabat_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Jabatan</td>
                                        <td class="align-middle"> <span id="jabatan_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Perihal</td>
                                        <td class="align-middle"> <span id="perihal_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Keterangan</td>
                                        <td class="align-middle"> <span id="keterangan_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Diajukan Oleh</td>
                                        <td class="align-middle"> <span id="created_by_proses"></span> </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">Waktu Pengajuan</td>
                                        <td class="align-middle"> <span id="created_at_proses"></span> </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="btn-update">
                        <button class="btn btn-block btn-warning" onclick="updateData()" style="font-weight: bolder"> <i class="fas fa-edit"></i> &nbsp; UPDATE DATA</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- FORM KEUANGAN -->
                <div class="card card-primary" id="form-kabagkeu">
                    <div class="overlay" id="loader-keuangan" style="display: none">
                        <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
                    </div>
                    <div class="card-header">
                        <h1 style="font-weight: bolder" class="card-title">Form Approval Pengajuan (KABAGKEU)</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status_proses_kabagkeu">Ubah Status</label>
                            <select class="form-control" style="width: 100%;" id="status_proses_kabagkeu" name="status_proses_kabagkeu" onchange="checkStatusKabagkeu()">
                                <option value="perbaikan">Perbaikan</option>
                                <option value="disetujui">Disetujui</option>
                            </select>
                        </div>
                        <div class="form-group" id="note_dinas_kabagkeu_wrap" style="display: none">
                            <label for="nota_dinas_kabagkeu">Nota Pengesahan POK <small>(PDF, Maksimal 2MB)</small></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="nota_dinas_kabagkeu">
                                    <label class="custom-file-label" for="nota_dinas_kabagkeu">Pilih File</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="catatan_kabagkeu_wrap" style="display:none">
                            <label for="catatan_proses_kabagkeu">Catatan</label>
                            <div id="wrap-catatan">
                                <div class="row">
                                    <div class="col-md-8">
                                        <textarea class="form-control" id="catatan_proses_kabagkeu" name="catatan_proses_kabagkeu"></textarea>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <button class="btn btn-success" onclick="addCatatanKabagKeu()"> <i class="font-weight-bolder fas fa-plus-circle"></i> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-danger" onclick="openData()"> <i class="fas fa-times-circle"></i> &nbsp;CANCEL</button>
                        <button type="button" onclick="submitProsesKabagKeu()" class="btn btn-success float-right"> <i class="fas fa-save"></i> &nbsp;SUBMIT</button>
                    </div>
                </div>

                <!-- FORM KPA -->
                <div class="card card-primary" id="form-kpa">
                    <div class="overlay" id="loader-kpa" style="display: none">
                        <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
                    </div>
                    <div class="card-header">
                        <h1 style="font-weight: bolder" class="card-title">Form Approval Pengajuan (KPA)</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status_proses_kpa">Ubah Status</label>
                            <select class="form-control" style="width: 100%;" id="status_proses_kpa" name="status_proses_kpa" onchange="checkStatusKpa()">
                                <option value="perbaikan">Perbaikan</option>
                                <option value="disetujui">Disetujui</option>
                            </select>
                        </div>
                        <div class="form-group" id="note_dinas_kpa_wrap" style="display: none">
                            <label for="nota_dinas_kpa">Nota Pengesahan POK <small>(PDF, Maksimal 2MB)</small></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="nota_dinas_kpa">
                                    <label class="custom-file-label" for="nota_dinas_kpa">Pilih File</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="catatan_kpa_wrap" style="display:none">
                            <label for="catatan_proses_kpa">Catatan</label>
                            <div id="wrap-catatan-kpa">
                                <div class="row">
                                    <div class="col-md-8">
                                        <textarea class="form-control" id="catatan_proses_kpa" name="catatan_proses_kpa"></textarea>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <button class="btn btn-success" onclick="addCatatanKpa()"> <i class="font-weight-bolder fas fa-plus-circle"></i> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-danger" onclick="openData()"> <i class="fas fa-times-circle"></i> &nbsp;CANCEL</button>
                        <button type="button" onclick="submitProsesKpa()" class="btn btn-success float-right"> <i class="fas fa-save"></i> &nbsp;SUBMIT</button>
                    </div>
                </div>

                <!-- FORM KABAGREN -->
                <div class="card card-primary" id="form-kabagren">
                    <div class="overlay" id="loader-kabagren" style="display: none">
                        <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
                    </div>
                    <div class="card-header">
                        <h1 class="card-title" style="font-weight: bolder">Form Verifikasi Pengajuan (KaBagren)</h1>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td class="align-middle">Direktorat</td>
                                <td><span id="direktorat_kabagren"></span></td>
                            </tr>
                            <tr>
                                <td class="align-middle">Nota Dinas Pengantar</td>
                                <td> 
                                    <span id="wrap-id-nota-kabagren" class="d-none">
                                        <input type="text" id="id_nota_dinas_pengantar">
                                    </span>
                                    <i class="fas fa-file"></i> &nbsp; <span id="nama_file_kabagren"></span> <br>
                                    [ <a href="javascript:void()" onclick="openModalUpload()"> Ubah Nota Dinas Pengantar </a> ]
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-danger" onclick="openData()"> <i class="fas fa-times-circle"></i> &nbsp;CANCEL</button>
                        <button type="button" onclick="submitKabagrenRevisi()" class="btn btn-success float-right"> <i class="fas fa-save"></i> &nbsp;SUBMIT</button>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="overlay" id="loader-proses" style="display: none">
                        <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
                    </div>
                    <div class="card-header">
                        <h1 class="card-title" style="font-weight: bolder">History Upload Dokumen</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table id="dokumen-pptk" class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="bg-success align-middle" colspan="3">Nota Dinas PPTK Sudah Sign</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 5%" class="text-center align-middle">No.</th>
                                        <th style="width: 95%" class="text-center align-middle">Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody id="content-nota-pptk"></tbody>
                            </table>
                        </div>
                        <div class="row">
                            <table id="dokumen-rab" class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="bg-success align-middle" colspan="3">Matrik RAB Semula Menjadi</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 5%" class="text-center align-middle">No.</th>
                                        <th style="width: 95%" class="text-center align-middle">Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody id="content-matrik-rab"></tbody>
                            </table>
                        </div>
                        <div class="row">
                            <table id="dokumen-kak" class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="bg-success align-middle" colspan="3">KAK</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 5%" class="text-center align-middle">No.</th>
                                        <th style="width: 95%" class="text-center align-middle">Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody id="content-kak"></tbody>
                            </table>
                        </div>
                        <div class="row">
                            <table id="dokumen-pendukung" class="table table-bordered" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="bg-success align-middle" colspan="3">Dokumen Pendukung</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 5%" class="text-center align-middle">No.</th>
                                        <th style="width: 95%" class="text-center align-middle">Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody id="content-dokumen-pendukung"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title" style="font-weight: bolder">History Pengajuan Revisi</h1>
                    </div>
                    <div class="card-body">
                        <div class="wrap-history"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let currentCount = 0;

    function openDetail(id)
    {
        loadHistory(id)
        clearFormProses()
        $('#loader-proses').show()
        loadDetailProses(id)
        $('#wrap-data').hide(700)
        $('#wrap-form').hide(700)
        $('#wrap-form-proses').show(700)

        $('#form-kabagkeu').hide()
        $('#form-kabagren').hide()
    }

    function openFormProses(id, form)
    {
        loadHistory(id)
        clearFormProses()
        $('#loader-proses').show()
        loadDetailProses(id, form)
        $('#wrap-data').hide(700)
        $('#wrap-form').hide(700)
        $('#wrap-form-proses').show(700)

        $('#form-kpa').hide()
        $('#form-kabagkeu').hide()
        $('#form-kabagren').hide()

        if(form == "kabagren")
        {
            $('#form-kabagren').show()
        }
        else if(form == "kabagkeu")
        {
            $('#form-kabagkeu').show()
        }
        else if(form == "kpa")
        {
            $('#form-kpa').show()
        }
    }

    function loadHistory(id_ticketing)
    {
        $('#history-penerbitan-pok').show()
        $('.wrap-history').empty().load('{{route('ticketing.view-log')}}?id_ticketing='+id_ticketing)   
    }

    function checkStatusKabagkeu()
    {
        $('#note_dinas_kabagkeu_wrap').hide()
        var status = $('#status_proses_kabagkeu').val()

        if(status == 'disetujui')
        {
            $('#catatan_kabagkeu_wrap').hide()
            $('#note_dinas_kabagkeu_wrap').show()
        }
        else if(status == "perbaikan")
        {
            $('#catatan_kabagkeu_wrap').show()
            $('#note_dinas_kabagkeu_wrap').hide()
        }
    }

    function checkStatusKpa()
    {
        $('#note_dinas_kpa_wrap').hide()
        var status = $('#status_proses_kpa').val()

        if(status == 'disetujui')
        {
            $('#catatan_kpa_wrap').hide()
            $('#note_dinas_kpa_wrap').show()
        }
        else if(status == "perbaikan")
        {
            $('#catatan_kpa_wrap').show()
            $('#note_dinas_kpa_wrap').hide()
        }
    }

    function clearFormProses()
    {
        $('#id_revisi_proses').val("")
        $('#status_proses_kabagkeu').val("")

        $("textarea[name=catatan_proses_kabagkeu]").each(function () {
            $(this).val("")
        });
    }

    function loadDetailProses(id, form)
    {
        $.post('{{ route('ticketing.detail-revisi') }}', {id, _token: '{{csrf_token()}}'}, function(e){

            $('#id_revisi_proses').val(id)
            $('#kak_proses').empty().append(e.download_kak)
            $('#satker_proses').empty().append(e.satker)
            $('#jabatan_proses').empty().append(e.jabatan)
            $('#perihal_proses').empty().append(e.perihal)
            $('#created_by_proses').empty().append(e.creator)
            $('#provinsi_proses').empty().append(e.nama_provinsi)
            $('#keterangan_proses').empty().append(e.keterangan)
            $('#matrik_rab_proses').empty().append(e.download_matrik_rab)
            $('#nomor_surat_proses').empty().append(e.nomor_surat)
            $('#jenis_revisi_proses').empty().append(e.jenis_revisi)
            $('#nama_pejabat_proses').empty().append(e.nama_lkp_pjb)
            $('#direktorat_proses').empty().append(e.nama_direktorat)
            $('#created_at_proses').empty().append(e.created_at_masked)
            $('#tahun_anggaran_proses').empty().append(e.tahun_anggaran)
            $('#nota_dinas_pptk_proses').empty().append(e.download_nota_dinas_pptk)
            $('#tanggal_surat_proses').empty().append(e.tanggal_surat_masked)
            $('#dokumen_pendukung_proses').empty().append(e.download_dokumen_pendukung)

            $('#content-kak').empty()
            $('#content-nota-pptk').empty()
            $('#content-matrik-rab').empty()
            $('#content-dokumen-pendukung').empty()

            if(form == "kabagren")
            {
                $('#direktorat_kabagren').empty().append(e.nama_direktorat)
                $('#nama_file_kabagren').empty().append(e.nota_pengantar_kabagren)
                $('#id_nota_dinas_pengantar').val(e.id_nota_pengantar_kabagren)
            }
            else if(form == "kabagkeu")
            {
                $('#nota_dinas_pengantar_proses').empty().append(e.download_nota_pengantar_kabagren)
            }
            else if(form == "kpa")
            {
                $('#lampiran_kabagkeu_proses').empty().append(e.download_lampiran_kabagkeu)
                $('#nota_dinas_pengantar_proses').empty().append(e.download_nota_pengantar_kabagren)
            }

            // KAK
            if (Array.isArray(e.kak_old) && e.kak_old.length)
            {
                var no = 1;
                e.kak_old.forEach(kak_old => 
                {
                    var data = '<tr><td class="text-center">'+no+'.</td><td>'+kak_old+'</td></tr>'
                    $('#dokumen-kak > tbody:last-child').append(data);
                    no++
                });
            }
            else
            {
                var content_kak = '<tr><td class="text-center" colspan="2"><em>Tidak Ada Dokumen Lama</em></td></tr>';
                $('#dokumen-kak > tbody:last-child').append(content_kak);
            }

            // PPTK
            if (Array.isArray(e.nota_dinas_pptk_old) && e.nota_dinas_pptk_old.length)
            {
                var no = 1;
                e.nota_dinas_pptk_old.forEach(nota_dinas_pptk_old => 
                {
                    var data = '<tr><td class="text-center">'+no+'.</td><td>'+nota_dinas_pptk_old+'</td></tr>'
                    $('#dokumen-pptk > tbody:last-child').append(data);
                    no++
                });
            }
            else
            {
                var content_nota_dinas_pptk = '<tr><td class="text-center" colspan="2"><em>Tidak Ada Dokumen Lama</em></td></tr>';
                $('#dokumen-pptk > tbody:last-child').append(content_nota_dinas_pptk);
            }

            // Matrik RAB
            if (Array.isArray(e.matrik_rab_old) && e.matrik_rab_old.length)
            {
                var no = 1;
                e.matrik_rab_old.forEach(matrik_rab_old => 
                {
                    var data = '<tr><td class="text-center">'+no+'.</td><td>'+matrik_rab_old+'</td></tr>'
                    $('#dokumen-rab > tbody:last-child').append(data);
                    no++
                });
            }
            else
            {
                var data = '<tr><td class="text-center" colspan="2"><em>Tidak Ada Dokumen Lama</em></td></tr>';
                $('#dokumen-rab > tbody:last-child').append(data);
            }

            // Dokumen Pendukung
            if (Array.isArray(e.dokumen_pendukung_old) && e.dokumen_pendukung_old.length)
            {
                var no = 1;
                e.dokumen_pendukung_old.forEach(dokumen_pendukung_old => 
                {
                    var data = '<tr><td class="text-center">'+no+'.</td><td>'+dokumen_pendukung_old+'</td></tr>'
                    $('#dokumen-pendukung > tbody:last-child').append(data);
                    no++
                });
            }
            else
            {
                var data = '<tr><td class="text-center" colspan="2"><em>Tidak Ada Dokumen Lama</em></td></tr>';
                $('#dokumen-pendukung > tbody:last-child').append(data);
            }

            if(e.status == "BUTUH PERBAIKAN")
            {
                $('#btn-update').show()
                $('#wrap-upload-kak').show()
                $('#wrap-upload-matrik-rab').show()
                $('#wrap-upload-nota-dinas-pptk').show()
                $('#wrap-upload-dokumen-pendukung').show()
            }
            else
            {
                $('#btn-update').hide()
                $('#wrap-upload-kak').hide()
                $('#wrap-upload-matrik-rab').hide()
                $('#wrap-upload-nota-dinas-pptk').hide()
                $('#wrap-upload-dokumen-pendukung').hide()
            }

            $('#loader-proses').hide()

        });
    }

    function submitKabagrenRevisi()
    {
        $('#loader-kabagren').show()
        var id = $('#id_revisi_proses').val();
        var nota_kabagren = $('#id_nota_dinas_pengantar').val()
        
        if(nota_kabagren == "none")
        {
            $('#loader-kabagren').hide()
            swal('Nota Dinas Pengantar Belum Dipilih', 'Mohon Upload Nota Dinas Terlebih Dulu', 'error')
        }
        else
        {
            $.post('{{ route('pok.submit-kabagren') }}', {id, nota_kabagren, _token: '{{csrf_token()}}'}, function(e){

                $('#loader-kabagren').hide()
                
                Toast.fire({
                    icon: 'success',
                    title: e.title
                })

                openData()

            });
        }
    }

    function addCatatanKpa()
    {
        var element = '<div class="row mt-3"><div class="col-md-8"><textarea class="form-control" id="catatan_proses_kpa" name="catatan_proses_kpa"></textarea></div><div class="col-md-2 text-center"><button class="btn btn-success" onclick="addCatatanKpa()"> <i class="font-weight-bolder fas fa-plus-circle"></i> </button></div><div class="col-md-2 text-center"><button class="btn btn-danger" onclick="removeCatatanKpa()"> <i class="font-weight-bolder fas fa-times-circle"></i> </button></div></div>';

        if(currentCount < 2)
        {
            currentCount += 1;
            $('#wrap-catatan-kpa').append(element)
        }
    }

    function addCatatanKabagKeu()
    {
        var element = '<div class="row mt-3"><div class="col-md-8"><textarea class="form-control" id="catatan_proses_kabagkeu" name="catatan_proses_kabagkeu"></textarea></div><div class="col-md-2 text-center"><button class="btn btn-success" onclick="addCatatanKabagKeu()"> <i class="font-weight-bolder fas fa-plus-circle"></i> </button></div><div class="col-md-2 text-center"><button class="btn btn-danger" onclick="removeCatatan()"> <i class="font-weight-bolder fas fa-times-circle"></i> </button></div></div>';

        if(currentCount < 2)
        {
            currentCount += 1;
            $('#wrap-catatan').append(element)
        }
    }

    function addCatatanKabagren()
    {
        var element = '<div class="row mt-3"><div class="col-md-8"><textarea class="form-control" id="catatan_proses_kabagren" name="catatan_proses_kabagren"></textarea></div><div class="col-md-2 text-center"><button class="btn btn-success" onclick="addCatatanKabagren()"> <i class="font-weight-bolder fas fa-plus-circle"></i> </button></div><div class="col-md-2 text-center"><button class="btn btn-danger" onclick="removeCatatanBagren()"> <i class="font-weight-bolder fas fa-times-circle"></i> </button></div></div>';

        if(currentCount < 2)
        {
            currentCount += 1;
            $('#wrap-catatan-bagren').append(element)
        }
    }

    function removeCatatan()
    {
        currentCount -= 1;
        $("#wrap-catatan").children().last().remove();
    }

    function removeCatatanKpa()
    {
        currentCount -= 1;
        $("#wrap-catatan-kpa").children().last().remove();
    }

    function removeCatatanBagren()
    {
        currentCount -= 1;
        $("#wrap-catatan-bagren").children().last().remove();
    }

    function submitProsesKabagKeu()
    {
        catatan = ""

        $("textarea[name=catatan_proses_kabagkeu]").each(function () {
            catatan += $(this).val() + "|";
        });

        $('#loader-keuangan').show()
        var id     = $('#id_revisi_proses').val()
        var status = $('#status_proses_kabagkeu').val()
        var lampiran_kabagkeu   = $('#nota_dinas_kabagkeu').prop('files')[0];

        var form_data = new FormData();

        form_data.append('id', id);
        form_data.append('status', status);
        form_data.append('catatan', catatan);
        form_data.append('lampiran_kabagkeu', lampiran_kabagkeu);

        form_data.append('_token', '{{csrf_token()}}')

        $.ajax({
        url: "{{route('pok.submit-kabagkeu')}}",
        type: "POST",
        data: form_data,
        cache: false,
        processData: false,
        contentType: false,
        success: function (e)
        {
            $('#loader-keuangan').hide()

            if(e.status == "success")
            {
                Toast.fire({
                    icon: 'success',
                    title: e.title
                })

                openData()
            }
            else
            {
                Toast.fire({
                    icon: 'error',
                    title: e.message
                })
            }
        }});
    }

    function submitProsesKpa()
    {
        catatan = ""

        $('#loader-kpa').show()

        $("textarea[name=catatan_proses_kpa]").each(function () {
            catatan += $(this).val() + "|";
        });

        var id     = $('#id_revisi_proses').val()
        var status = $('#status_proses_kpa').val()
        var lampiran_kpa   = $('#nota_dinas_kpa').prop('files')[0];

        var form_data = new FormData();

        form_data.append('id', id);
        form_data.append('status', status);
        form_data.append('catatan', catatan);
        form_data.append('lampiran_kpa', lampiran_kpa);

        form_data.append('_token', '{{csrf_token()}}')

        $.ajax({
        url: "{{route('pok.submit-kpa')}}",
        type: "POST",
        data: form_data,
        cache: false,
        processData: false,
        contentType: false,
        success: function (e)
        {
            $('#loader-kpa').show()

            if(e.status == "success")
            {
                Toast.fire({
                    icon: 'success',
                    title: e.title
                })

                openData()
            }
            else
            {
                Toast.fire({
                    icon: 'error',
                    title: e.message
                })
            }
        }});
    }
</script>

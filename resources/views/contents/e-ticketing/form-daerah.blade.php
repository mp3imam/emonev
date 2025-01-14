<!-- Main content -->
<section class="content" style="display:none" id="wrap-form">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="overlay" id="loader-form" style="display: none">
                <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="tahun_anggaran">Tahun Anggaran</label>
                    <input type="text" class="form-control" id="tahun_anggaran" name="tahun_anggaran" value="{{date('Y')}}" disabled/>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat"/>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="tanggal_surat">Tanggal Surat</label>
                        <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat"/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="satker">Satuan Kerja</label>
                        @if(!empty(Auth::user()->kdsatker))
                            <input type="text" class="form-control" id="satker" name="satker" value="{{getSatker(Auth::user()->kdsatker, 'kode')}} - {{getSatker(Auth::user()->kdsatker, 'nama_satker')}}" disabled/>
                        @else
                            <select class="form-control select2" name="satker" id="satker">
                                <option value="Sekretariat Daerah">SETDA</option>
                                <option value="Badan Perencanaan Pembangunan Daerah">BAPEDA</option>
                                <option value="Inspektorat">INSPEKTORAT</option>
                                <option value="Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu">DPMPTSP</option>
                            </select>
                        @endif
                    </div>
                    <div class="form-group col-md-4 col-xs-12 d-none">
                        <label for="direktorat">Unit Kerja</label>
                        <select class="form-control" style="width: 100%;" id="direktorat" name="direktorat" disabled></select>
                    </div>
                    <div class="form-group col-md-2 col-xs-12">
                        <div class="form-group">
                            <label for="jenis_revisi">Jenis Revisi</label>
                            <div class="form-group clearfix">
                                <div class="icheck-info d-inline">
                                    <input type="radio" id="pok" value="pok" name="jenis_revisi" checked />
                                    <label for="pok"> POK </label>
                                </div>
                                <div class="icheck-info d-inline ml-3">
                                    <input type="radio" id="dipa" value="dipa" name="jenis_revisi" checked />
                                    <label for="dipa"> DIPA </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group d-none">
                    <label for="perihal">Provinsi</label>
                    <select class="form-control" style="width: 100%" id="provinsi" name="provinsi" disabled></select>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="nama_pejabat">Nama Pejabat</label>
                        <input type="text" class="form-control" id="nama_pejabat" name="nama_pejabat" style="width:100%">
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="jabatan">Jabatan</label>
                        <div class="row">
                            <div class="col-md-10">
                                <select class="form-control" style="width: 100%" id="jabatan" name="jabatan"></select>
                            </div>
                            <div class="col-md-1">
                                <button onclick="openFormJabatan()" class="btn btn-success btn-rounded"> <i class="fas fa-plus"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="perihal">Perihal</label>
                    <input type="text" class="form-control" id="perihal" name="perihal"/>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nota_dinas_ppk">Nota Dinas PPK <small>(Maksimal 10MB)</small></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="nota_dinas_ppk">
                                <label class="custom-file-label" for="nota_dinas_ppkk">Pilih File</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="dokumen_pendukung">Dokumen Pendukung Lainnya (Optional) <small>(PDF/JPG/DOCX, Maksimal 10MB)</small></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="dokumen_pendukung">
                            <label class="custom-file-label" for="dokumen_pendukung">Pilih File</label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="matrik_rab">Matrik RAB Semula Menjadi <small>(Maksimal 10MB)</small></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="matrik_rab">
                            <label class="custom-file-label" for="matrik_rab">Pilih File</label>
                        </div>
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan Revisi</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" class="btn btn-danger" onclick="openData()"> <i class="fas fa-times-circle"></i> &nbsp;CANCEL</button>
                <button type="button" onclick="submitRevisi()" class="btn btn-success float-right">
                    <i class="fas fa-save"></i>&nbsp;SUBMIT
                </button>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-add-jabatan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="overlay" id="loader-modal-add-jabatan" style="display: none">
                <i class="text-navy fas fa-2x fa-spinner fa-spin"></i> &nbsp;
            </div>
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <div class="form-group">
                    <label for="nama_jabatan">Nama Jabatan</label>
                    <textarea class="form-control" style="width: 100%;" id="nama_jabatan" name="nama_jabatan"></textarea>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" style="margin: 2px" class="btn btn-danger shadow" class="close" data-dismiss="modal"> <i class="fas fa-times-circle"></i> &nbsp; Cancel</button>
                <button type="button" style="margin: 2px" class="btn btn-success shadow" onclick="submitJabatan()"> <i class="fas fa-save"></i> &nbsp; Tambah</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openForm()
        {
            // loadPptk()
            loadJabatan()
            loadProvinsi()
            loadDirektorat()
            // loadPejabatDaerah()
            $('#wrap-data').hide(700)
            $('#wrap-form').show(700)
            $('#wrap-form-proses').hide(700)
        }

        function submitJabatan()
        {
            $('#loader-modal-add-jabatan').show()
            var nama_jabatan = $('#nama_jabatan').val()

            $.post('{{ route('tools.submit-jabatan') }}', {nama_jabatan, _token: '{{csrf_token()}}'}, function(e){

                    loadJabatan()
                    $('#modal-add-jabatan').modal('hide')
                    $('#nama_jabatan').val("")
                    $('#loader-modal-add-jabatan').hide()

            });
        }

        function openFormJabatan()
        {
            $('#modal-add-jabatan').modal('show')    
        }

        function loadProvinsi()
        {
            $('#provinsi').select2()
            $('#provinsi').empty()
            $('#provinsi').select2('destroy')

            $.post('{{ route('tools.provinsi') }}', { _token: '{{csrf_token()}}'}, function(e){

                $("#provinsi").select2({
                    data: e,
                    theme: 'bootstrap4'
                }).val("{{Auth::user()->prov}}").trigger('change')
            });
        }

        function loadJabatan()
        {
            $('#jabatan').select2()
            $('#jabatan').empty()
            $('#jabatan').select2('destroy')

            $.post('{{ route('tools.jabatan') }}', { _token: '{{csrf_token()}}'}, function(e){

                $("#jabatan").select2({
                    data: e,
                    theme: 'bootstrap4'
                })
            });
        }

        function loadPejabatDaerah()
        {
            $('#nama_pejabat').select2()
            $('#nama_pejabat').empty()
            $('#nama_pejabat').select2('destroy')

            $.post('{{ route('tools.pejabat-daerah') }}', { _token: '{{csrf_token()}}'}, function(e){

                $("#nama_pejabat").select2({
                    data: e,
                    theme: 'bootstrap4'
                })
            });
        }

        function loadPptk()
        {
            $('#nama_pejabat').select2()
            $('#nama_pejabat').empty()
            $('#nama_pejabat').select2('destroy')

            $.post('{{ route('tools.pejabat-pptk') }}', { _token: '{{csrf_token()}}'}, function(e){

                $("#nama_pejabat").select2({
                    data: e,
                    theme: 'bootstrap4'
                })

                fillJabatan()
            });
        }
        
        function fillJabatan()
        {
            var id_pejabat = $('#nama_pejabat').val()
            
            $.post('{{ route('tools.detail-pejabat') }}', {id_pejabat, _token: '{{csrf_token()}}'}, function(e){

                $('#jabatan').val(e.jabatan)

            });
        }

        function loadDirektorat()
        {
            $('#direktorat').select2()
            $('#direktorat').empty()
            $('#direktorat').select2('destroy')

            $.post('{{ route('tools.direktorat') }}', { _token: '{{csrf_token()}}'}, function(e){

                $("#direktorat").select2({
                    data: e,
                    theme: 'bootstrap4'
                }).val("{{Auth::user()->id_dir}}").trigger('change')
            });
        }

        function submitRevisi()
        {
            $('#loader-form').show()

            var satker              = $('#satker').val()
            var jabatan             = $('#jabatan').val()
            var perihal             = $('#perihal').val()
            var provinsi            = $('#provinsi').val()
            var keterangan          = $('#keterangan').val()
            var direktorat          = $('#direktorat').val()
            var nomor_surat         = $('#nomor_surat').val()
            var tanggal_surat       = $('#tanggal_surat').val()
            var tahun_anggaran      = $('#tahun_anggaran').val()
            var nama_pejabat        = $('#nama_pejabat').val()
            var jenis_revisi        = $("input[name='jenis_revisi']:checked").val();

            var type                = "{{$kegiatan}}"

            var matrik_rab          = $('#matrik_rab').prop('files')[0];
            var nota_dinas_ppk      = $('#nota_dinas_ppk').prop('files')[0];
            var dokumen_pendukung   = $('#dokumen_pendukung').prop('files')[0];

            var form_data = new FormData();

            form_data.append('satker', satker);
            form_data.append('jabatan', jabatan);
            form_data.append('perihal', perihal);
            form_data.append('provinsi', provinsi);
            form_data.append('keterangan', keterangan);
            form_data.append('direktorat', direktorat);
            form_data.append('nomor_surat', nomor_surat);
            form_data.append('nama_pejabat', nama_pejabat);
            form_data.append('jenis_revisi', jenis_revisi);
            form_data.append('tanggal_surat', tanggal_surat);
            form_data.append('tahun_anggaran', tahun_anggaran);

            form_data.append('type', type);
            form_data.append('matrik_rab', matrik_rab);
            form_data.append('nota_dinas_ppk', nota_dinas_ppk);
            form_data.append('dokumen_pendukung', dokumen_pendukung);

            form_data.append('_token', '{{csrf_token()}}')

            $.ajax({
            url: "{{route('ticketing.submit-revisi')}}",
            type: "POST",
            data: form_data,
            cache: false,
            processData: false,
            contentType: false,
            success: function (e)
            {
                $('#loader-form').hide();
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

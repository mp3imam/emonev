<?php

namespace App\Http\Controllers;

use Auth;
use Validator;

use App\User;
use App\Usulan;
use App\Provinsi;
use App\LogUsulan;
use App\Direktorat;
use App\MasterPejabat;
use App\MasterDokumen;

use Illuminate\Http\Request;
use App\Http\Controllers\ToolsController;

class UsulanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        $modul      = 'E-Ticketing';
        $current    = "Usulan Kegiatan";

        return view('contents.usulan.index', compact('current', 'modul'));
    }

    public function data(Request $request)
    {
        $usulan = new Usulan;

        try
        {
            $i      = 0;
            $data   = $usulan->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')->where('created_by', Auth::user()->id_akses)->orderBy('id', 'DESC');

            if(Auth::user()->level == "2")
            {
                $data = $usulan
                        ->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')
                        ->where('provinsi', 'undefined')
                        ->where('direktorat', Auth::user()->id_dir)->orderBy('id', 'DESC');

                if(is_numeric(Auth::user()->prov))
                {
                    $data = $usulan
                        ->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')
                        ->where('type', $request->type)
                        ->where('direktorat', Auth::user()->id_dir)->orderBy('id', 'DESC');
                }

                if(Auth::user()->username == "198505062004121001")
                {
                    $data = $usulan
                        ->leftJoin('tbm_dir', 'tb_ticket_rev.direktorat', '=', 'tbm_dir.id_dir')
                        ->where('provinsi', 'undefined')->orderBy('id', 'DESC');

                    if($request->type == "gwpp")
                    {
                        $data = $usulan
                            ->leftJoin('tbm_dir', 'tb_ticket_rev.direktorat', '=', 'tbm_dir.id_dir')
                            ->where('type', $request->type)->orderBy('id', 'DESC');
                    }
                    else if($request->type == "sarpras")
                    {
                        $data = $usulan
                            ->leftJoin('tbm_dir', 'tb_ticket_rev.direktorat', '=', 'tbm_dir.id_dir')
                            ->where('type', $request->type)->orderBy('id', 'DESC');
                    }
                }
            }
            else if(Auth::user()->level == "3")
            {
                if(is_numeric(Auth::user()->prov))
                {
                    $data   = $usulan
                                ->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')
                                ->where('created_by', Auth::user()->id_akses)
                                ->where('type', $request->type)
                                ->orderBy('id', 'DESC');
                }
                
            }
            else if(Auth::user()->level == "1")
            {
                if(strtolower(Auth::user()->prov ) == "all")
                {
                    $data = $usulan
                            ->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')
                            ->where('direktorat', Auth::user()->id_dir)
                            ->where('type', $request->type)
                            ->orderBy('id', 'DESC');
                }
            }
            else if(Auth::user()->level == "5")
            {
                $data = $usulan
                        ->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')
                        ->whereNotNull('approved_by')
                        ->where('provinsi', 'undefined')
                        ->orderBy('id', 'DESC');

                if(strtolower(Auth::user()->prov) == "all")
                {
                    if($request->type == "gwpp")
                    {
                        $data = $usulan
                            ->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')
                            ->where('provinsi', 'not like', '%undefined%')
                            // ->whereNotNull('status_fasgub')
                            ->where('type', $request->type)
                            ->orderBy('id', 'DESC');
                    }
                    else
                    {
                        $data = $usulan
                            ->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')
                            ->where('provinsi', 'not like', '%undefined%')
                            // ->whereNotNull('status_ban')
                            ->where('type', $request->type)
                            ->orderBy('id', 'DESC');
                    }
                }
            }
            else if(Auth::user()->level == "0")
            {
                $data = $usulan->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')->orderBy('id', 'DESC');
            }
            else if(Auth::user()->level == "7")
            {
                $data = $usulan
                            ->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')
                            ->where('created_by', Auth::user()->id_akses)
                            ->orderBy('id', 'DESC');

                if($request->type == "gwpp")
                {
                    $data = $usulan
                            ->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')
                            ->where('provinsi', 'not like', '%undefined%')
                            ->whereNotNull('status_kpa')
                            ->where('type', $request->type)
                            ->orderBy('id', 'DESC');
                }
            }
            else if(Auth::user()->level == "8")
            {
                $data = $usulan
                            ->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')
                            ->where('provinsi', 'not like', '%undefined%')
                            ->where('type', $request->type)
                            ->orderBy('id', 'DESC');
            }

            // if($request->status != "all")
            // {
            //     $data = $usulan->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')->where('status', 'like', '%'.$request->status.'%')->orderBy('id', 'DESC')->get();

            //     if(Auth::user()->level == "2" || Auth::user()->level == "3")
            //     {
            //         $data = $usulan->leftJoin('tbm_dir', 'tb_usulan.direktorat', '=', 'tbm_dir.id_dir')->where('created_by', Auth::user()->id_akses)->where('status', 'like', '%'.$request->status.'%')->orderBy('id', 'DESC')->get();
            //     }
            // }

            if($request->status != "all")
            {
                $data   = $data->where('status', 'like', $request->status);
            }

            if($request->jenis != "all")
            {
                $data   = $data->where('jenis', 'like', $request->jenis);
            }
            
            $data   = $data->where('tahun_anggaran', $request->tahun);
            $data   = $data->get();

            foreach($data as $value)
            {
                if($value->status == "approved" || strtolower($value->status) == "disetujui")
                {
                    $data[$i]->status_style = '<span class="bg-success p-2">SELESAI DIPROSES</span>';
                }
                else if($value->status == "BUTUH PERBAIKAN" || $value->status == "DITOLAK")
                {
                    $data[$i]->status_style = '<span class="bg-danger p-2">'.$value->status.'</span>';
                }
                else if($value->status == "new")
                {
                    $data[$i]->status_style = '<span class="bg-info p-2">PENGAJUAN BARU</span>';
                }
                else
                {
                    $data[$i]->status_style = '<span class="bg-warning p-2">'.strtoupper($value->status).'</span>';
                }

                $data[$i]->aksi     = '<div class="btn-group">
                    <button type="button" class="btn btn-info">Action</button>
                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="javascript:void(0)" onclick="openDetail('.$value->id.')">Lihat Detail
                        <div class="dropdown-divider"></div>
                    </div>
                </div>
                ';

                $data[$i]->tahap1           = '<span class="bg-success text-uppercase p-2">'.date("d/m/Y H:i", strtotime($value->created_at)).'</span>';
                // $data[$i]->tahap2           = '<span class="bg-warning text-uppercase p-2">Belum Diproses</span>';
                // $data[$i]->tahap3           = '<span class="bg-warning text-uppercase p-2">Belum Diproses</span>';
                // $data[$i]->tahap_status     = '<span class="bg-warning text-uppercase p-2">Belum Diproses</span>';

                $data[$i]->tahap2           = '';
                $data[$i]->tahap3           = '';
                $data[$i]->tahap_status     = '';

                $data[$i]->tahap1_daerah    = '<span class="bg-success text-uppercase p-2">'.date("d/m/Y H:i", strtotime($value->created_at)).'</span>';
                // $data[$i]->tahap2_daerah    = '<span class="bg-warning text-uppercase p-2">Belum Diproses</span>';
                // $data[$i]->tahap3_daerah    = '<span class="bg-warning text-uppercase p-2">Belum Diproses</span>';
                // $data[$i]->tahap4_daerah    = '<span class="bg-warning text-uppercase p-2">Belum Diproses</span>';

                $data[$i]->tahap2_daerah    = '';
                $data[$i]->tahap3_daerah    = '';
                $data[$i]->tahap4_daerah    = '';
                
                $data[$i]->keterangan_usulan     = '<a href="javascript:void(0)" onclick="openDetail('.$value->id.')">'.$value->nomor_surat.'<br> <small>'.$value->perihal.'</small>'.'</a>';

                if($request->type == "gwpp")
                {
                    if($value->status_fasgub== "disetujui")
                    {
                        $data[$i]->tahap3_daerah    = '<span class="bg-success text-uppercase p-2">'.date("d/m/Y H:i", strtotime($value->fasgub_at)).'</span>';
                    }
                    else if($value->status_fasgub== "perbaikan")
                    {
                        $data[$i]->tahap3_daerah    = '<span class="bg-danger text-uppercase p-2">BUTUH PERBAIKAN</span>';
                    }
                }
                else
                {
                    if($value->status_ban== "disetujui")
                    {
                        $data[$i]->tahap3_daerah    = '<span class="bg-success text-uppercase p-2">'.date("d/m/Y H:i", strtotime($value->ban_at)).'</span>';
                    }
                    else if($value->status_ban== "perbaikan")
                    {
                        $data[$i]->tahap3_daerah    = '<span class="bg-danger text-uppercase p-2">BUTUH PERBAIKAN</span>';
                    }
                }

                if($value->status_kpa== "disetujui")
                {
                    $data[$i]->tahap2_daerah    = '<span class="bg-success text-uppercase p-2">'.date("d/m/Y H:i", strtotime($value->kpa_at)).'</span>';
                }
                else if($value->status_kpa== "perbaikan")
                {
                    $data[$i]->tahap2_daerah    = '<span class="bg-danger text-uppercase p-2">BUTUH PERBAIKAN</span>';
                }

                if($value->status == "BUTUH PERBAIKAN")
                {
                    $data[$i]->tahap1           = '<span class="bg-danger text-uppercase p-2">BUTUH PERBAIKAN</span>';
                    $data[$i]->tahap1_daerah    = '<span class="bg-danger text-uppercase p-2">BUTUH PERBAIKAN</span>';
                }

                if($value->status_approval == "disetujui")
                {
                    $data[$i]->tahap2           = '<span class="bg-success text-uppercase p-2">'.date("d/m/Y H:i", strtotime($value->approved_at)).'</span>';
                }
                else if($value->status_approval == "perbaikan")
                {
                    $data[$i]->tahap2           = '<span class="bg-danger text-uppercase p-2">BUTUH PERBAIKAN</span>';
                }

                if($value->status_verifikasi == "disetujui")
                {
                    $data[$i]->tahap3           = '<span class="bg-success text-uppercase p-2">'.date("d/m/Y H:i", strtotime($value->verified_at)).'</span>';

                    $data[$i]->tahap4_daerah    = '<span class="bg-success text-uppercase p-2">'.date("d/m/Y H:i", strtotime($value->verified_at)).'</span>';
                }
                else if($value->status_verifikasi == "perbaikan")
                {
                    $data[$i]->tahap3           = '<span class="bg-danger text-uppercase p-2">BUTUH PERBAIKAN</span>';
                }

                if(Auth::user()->level == "0" || Auth::user()->level == "2")
                {
                    $data[$i]->keterangan_usulan     = '<a href="javascript:void(0)" onclick="openFormProses('.$value->id.', \'ppk\')">'.$value->nomor_surat.'<br> <small>'.$value->perihal.'</small>'.'</a>';

                    $data[$i]->aksi     = '<div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="openDetail('.$value->id.')">Lihat Detail</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="openFormProses('.$value->id.', \'ppk\')">Approval Pengajuan</a>
                        </div>
                    </div>
                    ';
                }
                else if(Auth::user()->level == "0" || Auth::user()->level == "5")
                {
                    $data[$i]->keterangan_usulan     = '<a href="javascript:void(0)" onclick="openFormProses('.$value->id.', \'bagren\')">'.$value->nomor_surat.'<br> <small>'.$value->perihal.'</small>'.'</a>';

                    $data[$i]->aksi     = '<div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="openDetail('.$value->id.')">Lihat Detail</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="openFormProses('.$value->id.', \'bagren\')">Verifikasi Pengajuan</a>
                        </div>
                    </div>
                    ';
                }
                else if(Auth::user()->level == "1")
                {
                    $data[$i]->keterangan_usulan     = '<a href="javascript:void(0)" onclick="openFormProses('.$value->id.', \'kpa\')">'.$value->nomor_surat.'<br> <small>'.$value->perihal.'</small>'.'</a>';

                    $data[$i]->aksi     = '<div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="openDetail('.$value->id.')">Lihat Detail</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="openFormProses('.$value->id.', \'kpa\')">Verifikasi Pengajuan</a>
                        </div>
                    </div>
                    ';
                }
                else if(Auth::user()->level == "7")
                {
                    $data[$i]->keterangan_usulan     = '<a href="javascript:void(0)" onclick="openFormProses('.$value->id.', \'fasgub\')">'.$value->nomor_surat.'<br> <small>'.$value->perihal.'</small>'.'</a>';

                    $data[$i]->aksi     = '<div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="openDetail('.$value->id.')">Lihat Detail</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="openFormProses('.$value->id.', \'fasgub\')">Verifikasi Pengajuan</a>
                        </div>
                    </div>
                    ';
                }
                else if(Auth::user()->level == "8")
                {
                    $data[$i]->keterangan_usulan     = '<a href="javascript:void(0)" onclick="openFormProses('.$value->id.', \'ban\')">'.$value->nomor_surat.'<br> <small>'.$value->perihal.'</small>'.'</a>';

                    $data[$i]->aksi     = '<div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="openDetail('.$value->id.')">Lihat Detail</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="openFormProses('.$value->id.', \'ban\')">Verifikasi Pengajuan</a>
                        </div>
                    </div>
                    ';
                }

                // $status_bagren1 = '<div class="bg-danger text-uppercase p-2 mt-1">Subbagian DME [ON REVIEW]</div>';
                // $status_bagren2 = '<div class="bg-danger text-uppercase p-2 mt-1">Subbagian Program [ON REVIEW]</div>';
                // $status_bagren3 = '<div class="bg-danger text-uppercase p-2 mt-1">Subbagian SPIP [ON REVIEW]</div>';

                $status_bagren1 = '';
                $status_bagren2 = '';
                $status_bagren3 = '';

                if(strtolower($data[$i]->status_bagren1) == "disetujui")
                {
                    $status_bagren1 = '<div class="bg-success text-uppercase p-2 mt-1">Subbagian DME [OK]</div>';
                }
                else
                {
                    if($value->status_approval == "disetujui")
                    {
                        $status_bagren1 = '<div class="bg-warning text-uppercase p-2 mt-1">Subbagian DME [PENDING REVIEW]</div>';
                    }
                }

                if(strtolower($data[$i]->status_bagren2) == "disetujui")
                {
                    $status_bagren2 = '<div class="bg-success text-uppercase p-2 mt-1">Subbagian Program [OK]</div>';
                }
                else
                {
                    if($value->status_approval == "disetujui")
                    {
                        $status_bagren2 = '<div class="bg-warning text-uppercase p-2 mt-1">Subbagian Program [PENDING REVIEW]</div>';
                    }
                }

                if(strtolower($data[$i]->status_bagren3) == "disetujui")
                {
                    $status_bagren3 = '<div class="bg-success text-uppercase p-2 mt-1">Subbagian SPIP [OK]</div>';
                }
                else
                {
                    if($value->status_approval == "disetujui")
                    {
                        $status_bagren3 = '<div class="bg-warning text-uppercase p-2 mt-1">Subbagian SPIP [PENDING REVIEW]</div>';
                    }
                }

                $data[$i]->tahap3                   = $status_bagren1.$status_bagren2.$status_bagren3;

                if(strtolower($value->status) == "ditolak")
                {
                    $data[$i]->tahap1               = '<span class="bg-danger text-uppercase p-2">DITOLAK</span>';
                    $data[$i]->tahap2               = '<span class="bg-danger text-uppercase p-2">DITOLAK</span>';
                    $data[$i]->tahap3               = '<span class="bg-danger text-uppercase p-2">DITOLAK</span>';
                    $data[$i]->keterangan_usulan    = $value->nomor_surat.'<br> <small>'.$value->perihal.'</small>';
                }

                $i++;
            }

            return $data;
        }
        catch (\Illuminate\Database\QueryException $e)
        {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Oopps.. Error Submit. Please Try Again'
            ]);
        }
    }

    public function detail(Request $request)
    {
        $user       = new User;
        $usulan     = new Usulan;
        $provinsi   = new Provinsi;
        $direktorat = new Direktorat;
        $pejabat    = new MasterPejabat;
        $dokumen    = new MasterDokumen;

        $data       = $usulan->where('id', $request->id)->first();

        $data->tanggal_surat_masked     = dateMasked($data->tanggal_surat);
        $data->created_at_masked        = date("d/m/Y H:i:s", strtotime($data->created_at));

        $data->nama_lkp_pjb     = $data->nama_pejabat;
        $data->creator          = $user->where('id_akses', $data->created_by)->first()->nama;
        $data->nama_provinsi    = $provinsi->where('id_prov', $data->provinsi)->first()->namaprov;
        $data->nama_direktorat  = $direktorat->where('id_dir', $data->direktorat)->first()->nama_dir;

        if(is_numeric($data->nama_pejabat))
        {
            $data->nama_lkp_pjb     = $pejabat->where('id', $data->nama_pejabat)->first()->nama_pejabat;
        }

        $data->download_nota_dinas_pptk  = '<a href="'.route('download.dokumen-usulan', ['jenis_file' => 'nota_dinas_pptk', 'nama_file' => $data->nota_dinas_pptk]).'?id_ticket='.$request->id.'" class="btn btn-success"> <i class="fas fa-download"></i> <br> Download</a>';

        $data->download_nota_dinas_ppk  = '<a href="'.route('download.dokumen-usulan', ['jenis_file' => 'nota_dinas_ppk', 'nama_file' => $data->nota_dinas_ppk]).'?id_ticket='.$request->id.'" class="btn btn-success"> <i class="fas fa-download"></i> <br> Download</a>';

        $data->download_kak  = '<a href="'.route('download.dokumen-usulan', ['jenis_file' => 'kak', 'nama_file' => $data->kak]).'?id_ticket='.$request->id.'" class="btn btn-success"> <i class="fas fa-download"></i> <br> Download</a>';

        $data->download_matrik_rab  = '<a href="'.route('download.dokumen-usulan', ['jenis_file' => 'matrik_rab', 'nama_file' => $data->matrik_rab]).'?id_ticket='.$request->id.'" class="btn btn-success"> <i class="fas fa-download"></i> <br> Download</a>';

        $data->download_dokumen_pendukung  = '<a href="'.route('download.dokumen-usulan', ['jenis_file' => 'dokumen_pendukung', 'nama_file' => $data->dokumen_pendukung]).'?id_ticket='.$request->id.'" class="btn btn-success"> <i class="fas fa-download"></i> <br> Download</a>';

        $data->download_lampiran_kabagkeu  = '-';

        // Dokumen Pengantar Kabagren
        $dokumen_kabagren = $dokumen->where('id', $data->lampiran_kabagren)->first();
        
        $data->download_nota_pengantar_kabagren  = '-';

        if($data->kak == "Tidak Ada File")
        {
            $data->download_kak  = '-';
        }

        if($data->matrik_rab == "Tidak Ada File")
        {
            $data->download_matrik_rab  = '-';
        }

        if($data->dokumen_pendukung == "Tidak Ada File")
        {
            $data->download_dokumen_pendukung  = '-';
        }

        if($data->nota_dinas_pptk == "Tidak Ada File")
        {
            $data->download_nota_dinas_pptk  = '-';
        }

        if($data->nota_dinas_ppk == "Tidak Ada File")
        {
            $data->download_nota_dinas_ppk  = '-';
        }

        if($data->lampiran_kabagren != null || !empty($data->lampiran_kabagren))
        {
            $data->download_nota_pengantar_kabagren  = '<a href="'.env('APP_URL').$dokumen_kabagren->path.$dokumen_kabagren->file.'?id_ticket='.$request->id.'" class="btn btn-success"> <i class="fas fa-download"></i> <br> Download</a>';
        }

        if($data->lampiran_kabagkeu != null || !empty($data->lampiran_kabagkeu))
        {
            $data->download_lampiran_kabagkeu  = $data->download_lampiran_kabagkeu  = '<a href="'.route('download.dokumen-usulan', ['jenis_file' => 'lampiran_kabagkeu', 'nama_file' => $data->lampiran_kabagkeu]).'?id_ticket='.$request->id.'" class="btn btn-success"> <i class="fas fa-download"></i> <br> Download</a>';
        }

        $nota_pengantar_kabagren = $dokumen->where(['direktorat' => $data->direktorat, 'owned_by' => '5', 'status' => '1'])->get();

        $data->nota_pengantar_kabagren = "Belum Ada Nota Pengantar";
        $data->id_nota_pengantar_kabagren = "none";

        if(!empty($nota_pengantar_kabagren))
        {
            $nota_pengantar_kabagren = $dokumen->where(['direktorat' => $data->direktorat, 'owned_by' => '5', 'status' => '1'])->first();

            $data->nota_pengantar_kabagren = '<a href="'.env('APP_URL').$nota_pengantar_kabagren->path.$nota_pengantar_kabagren->file.'" target="_blank">'.$nota_pengantar_kabagren->file.'</a>';
            $data->id_nota_pengantar_kabagren = $nota_pengantar_kabagren->id;
        }

        return $data;
    }

    public function submit(Request $request)
    {
        $user       = new User;
        $dir        = new Direktorat;
        $usulan     = new Usulan;
        $pejabat    = new MasterPejabat;
        $tools      = new ToolsController;

        $validation = [
            'tahun_anggaran'    => 'required|integer',
            'nomor_surat'       => 'required',
            'jenis'             => 'required',
            'tanggal_surat'     => 'required|date',
            'satker'            => 'required',
            'provinsi'          => 'required',
            'direktorat'        => 'required',
            'jenis_usulan'      => 'required',
            'nama_pejabat'      => 'required',
            'jabatan'           => 'required',
            'perihal'           => 'required',
            'nota_dinas_pptk'   => 'max:10240',
            'nota_dinas_ppk'    => 'max:10240',
            'matrik_rab'        => 'max:10240',
            'dokumen_pendukung'   => 'max:10240',
            'kak'   => 'max:10240',
        ];

        $message    = [
            'required'  => ':attribute tidak boleh kosong',
            'integer'   => ':attribute tidak valid',
            'date'      => ':attribute tidak valid',
            'size'      => ':attribute Ukuran Maksimal 10 MB'
        ];

        $names      = [
            'jenis'             => 'Jenis Usulan',
            'tahun_anggaran'    => 'Tahun Anggaran',
            'nomor_surat'       => 'Nomor Surat',
            'tanggal_surat'     => 'Tanggal Surat',
            'satker'            => 'Satuan Kerja',
            'provinsi'          => 'Provinsi',
            'direktorat'        => 'Unit Kerja',
            'jenis_usulan'      => 'Jenis Usulan',
            'nama_pejabat'      => 'Nama Pejabat',
            'jabatan'           => 'Jabatan',
            'perihal'           => 'Perihal',
            'matrik_rab'        => 'Dokumen Matrik RAB',
            'kak'               => 'Dokumen KAK'
        ];

        $validator = Validator::make($request->all(), $validation, $message, $names);

        if ($validator->fails())
        {
            return response()->json([
                'status'    => 'failed',
                'title'     => 'Validasi Error',
                'message'   => $validator->errors()->all()
            ]);
        }

        try
        {
            $kak                = "Tidak Ada File";
            $matrik_rab         = "Tidak Ada File";
            $nota_dinas_ppk     = "Tidak Ada File";
            $nota_dinas_pptk    = "Tidak Ada File";
            $dokumen_pendukung  = "Tidak Ada File";

            $direktorat         = $dir->where('id_dir', $request->direktorat)->first()->nama_dir;

            if($request->hasFile('nota_dinas_pptk'))
            {
                $nota_dinas_pptk = $this->uploadFile($request, 'nota_dinas_pptk', $direktorat);
            }

            if($request->hasFile('nota_dinas_ppk'))
            {
                $nota_dinas_ppk = $this->uploadFile($request, 'nota_dinas_ppk', $direktorat);
            }

            if($request->hasFile('matrik_rab'))
            {
                $matrik_rab     = $this->uploadFile($request, 'matrik_rab', $direktorat);
            }

            if($request->hasFile('kak'))
            {
                $kak = $this->uploadFile($request, 'kak', $direktorat);
            }

            if($request->hasFile('dokumen_pendukung'))
            {
                $dokumen_pendukung = $this->uploadFile($request, 'dokumen_pendukung', $direktorat);
            }

            $id_usulan = $usulan->create([
                'token'             => md5($request->nomor_surat.strtotime(date("ymdhis"))),
                'key'               => random_int(100000, 999999),
                'jenis'             => $request->jenis,
                'tahun_anggaran'    => $request->tahun_anggaran,
                'nomor_surat'       => $request->nomor_surat,
                'tanggal_surat'     => $request->tanggal_surat,
                'satker'            => $request->satker,
                'provinsi'          => $request->provinsi,
                'direktorat'        => $request->direktorat,
                'jenis_usulan'      => $request->jenis_usulan,
                'nama_pejabat'      => $request->nama_pejabat,
                'jabatan'           => $request->jabatan,
                'perihal'           => $request->perihal,
                'nota_dinas_pptk'   => $nota_dinas_pptk,
                'nota_dinas_ppk'    => $nota_dinas_ppk,
                'matrik_rab'        => $matrik_rab,
                'kak'               => $kak,
                'dokumen_pendukung' => $dokumen_pendukung,
                'nota_dinas_pptk_old'   => ["BELUM ADA DOKUMEN LAMA"],
                'nota_dinas_ppk_old'    => ["BELUM ADA DOKUMEN LAMA"],
                'matrik_rab_old'        => ["BELUM ADA DOKUMEN LAMA"],
                'kak_old'               => ["BELUM ADA DOKUMEN LAMA"],
                'dokumen_pendukung' => $dokumen_pendukung,
                'keterangan'        => $request->keterangan,
                'status'            => 'new',
                'type'              => $request->type,
                'created_by'        => Auth::user()->id_akses
            ]);

            $data_pejabat   = $pejabat->where('id_dir', Auth::user()->id_dir)->first();
            $email_pejabat  = $data_pejabat->email;
            $text = Auth::user()->nama." telah mengajukan usulan kegiatan baru. Mohon segera ditindak lanjut";
            // $tools->sendingEmail($text, $email_pejabat, $request->nomor_surat);
            $this->record($id_usulan->id, "Mengajukan Usulan Kegiatan", Auth::user()->id_akses);

            $no_hp_ppk = $user->where([
                'id_dir'    => Auth::user()->id_dir,
                'level'     => 2,
                'prov'      => Auth::user()->prov
            ])->first()->no_hp;
            
            if($request->provinsi == "undefined")
            {
                $message_pptk   = "Pengajuan Usulan Kegiatan Anda Berhasil Dikirim. Nomor Surat: ".$request->nomor_surat;
                $message_ppk    = Auth::user()->nama." telah mengajukan Usulan Kegiatan baru dengan Nomor Surat: ".$request->nomor_surat.". Mohon segera ditindak lanjut";
                $message_bagren = Auth::user()->nama." telah mengajukan Usulan Kegiatan baru dengan Nomor Surat: ".$request->nomor_surat.". Mohon segera ditindak lanjut";
                $message_bang_arief = "Ijin Bang Arief, ".Auth::user()->nama." telah mengajukan Usulan Kegiatan baru dengan Nomor Surat: ".$request->nomor_surat;

                $tools->sendingWa(Auth::user()->no_hp, $message_pptk, $request->nomor_surat, "Usulan Kegiatan");
                $tools->sendingWa(Auth::user()->no_hp, $message_ppk, $request->nomor_surat, "Usulan Kegiatan");
                $tools->sendingWa("081213833316", $message_bang_arief, $request->nomor_surat, "Usulan Kegiatan");
            }
            else
            {
                $message_ppk    = "Pengajuan Usulan Kegiatan Anda Berhasil Dikirim. Nomor Surat: ".$request->nomor_surat;
                $message_bagren = Auth::user()->nama." telah mengajukan Usulan Kegiatan daerah baru dengan Nomor Surat: ".$request->nomor_surat.". Mohon segera ditindak lanjut";
                $message_bang_arief = "Ijin Bang Arief, ".Auth::user()->nama." telah mengajukan Usulan Kegiatan daerah baru dengan Nomor Surat: ".$request->nomor_surat;

                // $tools->sendingWa(Auth::user()->no_hp, $message_ppk);
                $tools->sendingWa("081213833316", $message_bang_arief, $request->nomor_surat, "Usulan Kegiatan");

            }

            // $tools->sendingWa("089604187227", $message_bagren);
            // $tools->sendingWa("087887635898", $message_bagren);
            // $tools->sendingWa("081267651127", $message_bagren);

            return response()->json([
                'status'    => 'success',
                'title'     => 'Usulan Kegiatan Berhasil Dibuat',
                'message'   => 'Pengajuan Usulan Kegiatan Akan Segera Diproses'
            ]);
        }
        catch (\Illuminate\Database\QueryException $e)
        {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Oopps.. Error Submit. Please Try Again'
            ]);
        }
    }

    public function submitPpk(Request $request)
    {
        $catatan    = [];

        if($request->has('catatan') && !empty($request->catatan))
        {
            $catatan    = [];
            $notes      = explode('|',$request->catatan);

            foreach($notes as $note)
            {
                if(!empty($note))
                {
                    $catatan[] = $note;
                }
            }
        }

        try
        {
            $usulan         = new Usulan;
            $dir            = new Direktorat;
            $nota_dinas_ppk = "Tidak Ada File";
            $tools          = new ToolsController;
            $histatus       = "";

            $nomor_surat = $usulan->where('id', $request->id)->first()->nomor_surat;

            if($request->hasFile('nota_dinas_ppk'))
            {
                $direktorat         = $dir->where('id_dir', $usulan->where('id', $request->id)->first()->direktorat)->first()->nama_dir;
                $nota_dinas_ppk     = $this->uploadFile($request, 'nota_dinas_ppk', $direktorat);
            }

            if($request->status == "disetujui")
            {
                $usulan->where('id', $request->id)->update([
                    'catatan_approval'  => $catatan,
                    'nota_dinas_ppk'    => $nota_dinas_ppk,
                    'status_approval'   => $request->status,
                    'status'            => "Selesai Diproses PPK",
                    'approved_at'       => date("Y-m-d H:i:s"),
                    'approved_by'       => Auth::user()->id_akses
                ]);

                $histatus = "Approval";

                $message_pptk   = "Pengajuan Usulan Kegiatan Anda dengan Nomor Surat: ".$nomor_surat." Sudah Diproses oleh ".Auth::user()->nama." dan akan diteruskan ke Bagian Perencanaan untuk ditindak lanjut";

                $message_bagren    = "Usulan Kegiatan baru dengan Nomor Surat: ".$nomor_surat." selesai diproses oleh ".Auth::user()->nama." dan diteruskan ke Bagian Perencanaan. Mohon segera ditindak lanjut";

                $message_bang_arief = "Ijin Bang Arief, Usulan Kegiatan baru dengan Nomor Surat: ".$nomor_surat." selesai diproses oleh ".Auth::user()->nama." [PPK] dan diteruskan ke Bagian Perencanaan";

                $tools->sendingWa(Auth::user()->no_hp, $message_pptk, $nomor_surat, "Usulan Kegiatan");
                $tools->sendingWa("087887635898", $message_bagren, $nomor_surat, "Usulan Kegiatan"); // Andriano
                $tools->sendingWa("081267651127", $message_bagren, $nomor_surat, "Usulan Kegiatan"); // Dita
                $tools->sendingWa("082119902524", $message_bagren, $nomor_surat, "Usulan Kegiatan"); // Alpi

                $tools->sendingWa("08989901596", $message_bagren, $nomor_surat, "Usulan Kegiatan"); // Ahsan
                $tools->sendingWa("085821875831", $message_bagren, $nomor_surat, "Usulan Kegiatan"); // Riska
                $tools->sendingWa("082111804152", $message_bagren, $nomor_surat, "Usulan Kegiatan"); // Chrizant

                $tools->sendingWa("081393228104", $message_bagren, $nomor_surat, "Usulan Kegiatan"); // Suyat
                $tools->sendingWa("082283791530", $message_bagren, $nomor_surat, "Usulan Kegiatan"); // Gentha
                $tools->sendingWa("081380392500", $message_bagren, $nomor_surat, "Usulan Kegiatan"); // Tian
            }
            else
            {
                $usulan->where('id', $request->id)->update([
                    'catatan_approval'  => $catatan,
                    'nota_dinas_ppk'    => $nota_dinas_ppk,
                    'status_approval'   => NULL,
                    'status'            => "BUTUH PERBAIKAN",
                    'approved_at'       => date("Y-m-d H:i:s"),
                    'approved_by'       => Auth::user()->id_akses
                ]);

                $histatus = "Penolakan";

                $message_pptk   = "Pengajuan Usulan Kegiatan Anda dengan Nomor Surat: ".$request->nomor_surat." *DITOLAK* oleh ".Auth::user()->nama.". Mohon segera diperbaiki sesuai catatan";

                $message_bang_arief = "Ijin Bang Arief, Usulan Kegiatan baru dengan Nomor Surat: ".$nomor_surat." ditolak oleh ".Auth::user()->nama." [PPK] dan diteruskan ke Bagian Perencanaan";

                $tools->sendingWa(Auth::user()->no_hp, $message_pptk, $nomor_surat, "Usulan Kegiatan");
            }

            $tools->sendingWa("081213833316", $message_bang_arief, $nomor_surat, "Usulan Kegiatan");

            $catatan_simpan = "<ol>";

            foreach ($catatan as $value)
            {
                $catatan_simpan .= '<li>'.$value.'</li>';
            }

            $catatan_simpan .= "</ol>";

            $this->record($request->id, "Melakukan ".$histatus." Usulan Kegiatan. Dokumen: ".$nota_dinas_ppk.". Catatan: ".$catatan_simpan, Auth::user()->id_akses);

            return response()->json([
                'status'    => 'success',
                'title'     => 'Status Pengajuan Berhasil Diubah',
                'message'   => 'Status Pengajuan Berhasil Diubah'
            ]);
        }
        catch (\Illuminate\Database\QueryException $e)
        {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Oopps.. Error Processing. Please Try Again'
            ]);
        }
    }

    public function submitBagren(Request $request)
    {
        $catatan    = [];

        if($request->has('catatan') && !empty($request->catatan))
        {
            $catatan    = [];
            $notes      = explode('|',$request->catatan);

            foreach($notes as $note)
            {
                if(!empty($note))
                {
                    $catatan[] = $note;
                }
            }
        }

        try
        {
            $user           = new User;
            $usulan         = new Usulan;
            $dir            = new Direktorat;
            $tools          = new ToolsController;

            $nomor_surat = $usulan->where('id', $request->id)->first()->nomor_surat;

            $status_akhir   = "Menolak Usulan Baru";

            if($request->status == "disetujui")
            {

                $status_akhir   = "Menyetujui Usulan Baru";

                if(Auth::user()->username == "andriano")
                {
                    $usulan->where('id', $request->id)->update([
                        'status_bagren1'    => "disetujui",
                        'note_bagren1'      => $catatan,
                    ]);    
                }

                if(Auth::user()->username == "dita")
                {
                    $usulan->where('id', $request->id)->update([
                        'status_bagren2'    => "disetujui",
                        'note_bagren2'      => $catatan,
                    ]);    
                }

                if(Auth::user()->username == "alpi")
                {
                    $usulan->where('id', $request->id)->update([
                        'status_bagren3'    => "disetujui",
                        'note_bagren3'      => $catatan,
                    ]);    
                }

                $message_bagren     = "Anda sudah melakukan approval usulan kegiatan dengan Nomor Surat: ".$nomor_surat.".";
                $message_bang_arief = "Ijin Bang Arief, ".Auth::user()->nama." [Bagren] telah melakukan approval Usulan Kegiatan baru dengan Nomor Surat: ".$nomor_surat;

                $tools->sendingWa(Auth::user()->no_hp, $message_bagren, $nomor_surat, "Usulan Kegiatan");
            }
            else
            {
                $tolak = $usulan->where('id', $request->id)->first()->tolak;
                $jumlah_tolak = $tolak+1;

                if($jumlah_tolak >= 3)
                {
                    $usulan->where('id', $request->id)->update([
                        'catatan_verifikasi'    => $catatan,
                        'status'                => "DITOLAK",
                        'status_approval'       => NULL,
                        'status_verifikasi'     => NULL,
                        'verified_at'           => date("Y-m-d H:i:s"),
                        'verified_by'           => Auth::user()->id_akses,
                        'tolak'                 => $jumlah_tolak
                    ]);
                    error_log('jumlah tolakan : '.$jumlah_tolak);
                    $status             = "DITOLAK";
                    $status_verifikasi  = "DITOLAK";
                }
                else
                {
                    $usulan->where('id', $request->id)->update([
                        'catatan_verifikasi'    => $catatan,
                        'status'                => "BUTUH PERBAIKAN",
                        'status_approval'       => NULL,
                        'status_verifikasi'     => NULL,
                        'verified_at'           => date("Y-m-d H:i:s"),
                        'verified_by'           => Auth::user()->id_akses,
                        'tolak'                 => $jumlah_tolak
                    ]);
                    error_log('jumlah tolakan di else : '.$jumlah_tolak);
                    $status             = "BUTUH PERBAIKAN";
                    $status_verifikasi  = "BUTUH PERBAIKAN";
                }

                $message_bagren = "Anda sudah menolak usulan kegiatan dengan Nomor Surat: ".$nomor_surat.".";
                $message_bang_arief = "Ijin Bang Arief, ".Auth::user()->nama." [Bagren] telah menolak Usulan Kegiatan baru dengan Nomor Surat: ".$nomor_surat;

                $tools->sendingWa(Auth::user()->no_hp, $message_bagren, $nomor_surat, "Usulan Kegiatan");
            }

            $data_usulan        = $usulan->where('id', $request->id)->first();
            $status             = "diproses bagren";
            $status_verifikasi  = "diproses bagren";

            $no_hp_pptk = $user->where([
                'id_akses'    => $data_usulan->created_by
            ])->first()->no_hp;

            $message_pptk   = "Pengajuan Usulan Kegiatan Anda dengan Nomor Surat: ".$nomor_surat." dikaji oleh Bagren [".Auth::user()->nama."]";
            
            if($data_usulan->status_bagren1 == "disetujui" && $data_usulan->status_bagren2 == "disetujui" && $data_usulan->status_bagren3 == "disetujui")
            {
                $message_pptk   = "Pengajuan Usulan Kegiatan Anda dengan Nomor Surat: ".$nomor_surat." *DISETUJUI* oleh Bagren [".Auth::user()->nama."]";

                $status             = "disetujui";
                $status_verifikasi  = "disetujui";
            }

            $tools->sendingWa($no_hp_pptk, $message_pptk, $nomor_surat, "Usulan Kegiatan");

            $usulan->where('id', $request->id)->update([
                'status'                => $status,
                'status_verifikasi'     => $status_verifikasi,
                'verified_at'           => date("Y-m-d H:i:s"),
                'verified_by'           => Auth::user()->id_akses
            ]);

            
            $catatan_simpan = "<ol>";

            foreach ($catatan as $value)
            {
                $catatan_simpan .= '<li>'.$value.'</li>';
            }

            $catatan_simpan .= "</ol>";

            $this->record($request->id, $status_akhir.". Catatan: ".$catatan_simpan, Auth::user()->id_akses);

            $tools->sendingWa("081213833316", $message_bang_arief, $nomor_surat, "Usulan Kegiatan");

            return response()->json([
                'status'    => 'success',
                'title'     => 'Status Pengajuan Berhasil Diubah',
                'message'   => 'Status Pengajuan Berhasil Diubah'
            ]);
        }
        catch (\Illuminate\Database\QueryException $e)
        {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Oopps.. Error Processing. Please Try Again'
            ]);
        }
    }

    public function uploadFile($request, $type, $direktorat)
    {
        $files = $request->File($type);

        if(!empty($files))
        {
            $ext        = "usulan_".$type."_".strtotime(date("Y-m-d H:i:s"))."." .$files->clientExtension();
            $name_file  = $ext;

            $files->storeAs('./assets/files/'.$direktorat.'/', $ext);

            return $name_file;
        }
    }

    public function record($id_ticketing, $activity, $user)
    {
        $log = new LogUsulan;

        $log->create([
            'user'          => $user,
            'activity'      => $activity,
            'id_ticketing'  => $id_ticketing
        ]);
    }

    public function loadHistory(Request $request)
    {
        $log    = new LogUsulan;

        $data   = $log
                ->select('*', 'tb_log_usulan.created_at as created_at')
                ->leftJoin('tb_akses', 'tb_log_usulan.user', '=', 'tb_akses.id_akses')
                ->where('id_ticketing', $request->id_usulan)->orderBy('tb_log_usulan.created_at', 'DESC')->get();

        $return = '<div class="timeline timeline-inverse">';

        foreach ($data as $value)
        {
            $return .= '<div>
                <i class="fas fa-file bg-info"></i>

                <div class="timeline-item">
                    <span class="time">'.date("d/m/Y H:i", strtotime($value->created_at)).'</span>

                    <h3 class="timeline-header"><a href="#">'.$value->nama.'</a> </h3>

                    <div class="timeline-body">
                        '.$value->activity.'
                    </div>
                </div>
            </div>';
        }

        $return .= '<div>
                        <i class="far fa-clock bg-gray"></i>
                    </div>
                </div>';

        return $return;
    }

    public function updateUsulan(Request $request)
    {
        $dir        = new Direktorat;
        $usulan     = new Usulan;
        $pejabat    = new MasterPejabat;
        $tools      = new ToolsController;

        try
        {
            $data_old   = $usulan->where('id', $request->id)->first(); 
            $direktorat = $dir->where('id_dir', $data_old->direktorat)->first()->nama_dir;

            if($request->hasFile('nota_dinas_pptk'))
            {
                $nota_dinas_pptk_old     = $data_old->nota_dinas_pptk;
                $arr_nota_dinas_pptk_old = $data_old->nota_dinas_pptk_old;
                
                if(!in_array("BELUM ADA DOKUMEN LAMA", $arr_nota_dinas_pptk_old))
                {
                    array_push($arr_nota_dinas_pptk_old, $nota_dinas_pptk_old);
                }
                else
                {
                    $arr_nota_dinas_pptk_old = [$nota_dinas_pptk_old];
                }

                $nota_dinas_pptk = $this->uploadFile($request, 'nota_dinas_pptk', $direktorat);

                $usulan->where('id', $request->id)->update([
                    'nota_dinas_pptk'       => $nota_dinas_pptk,
                    'nota_dinas_pptk_old'   => $arr_nota_dinas_pptk_old
                ]);
            }

            if($request->hasFile('nota_dinas_ppk'))
            {
                $nota_dinas_ppk_old     = $data_old->nota_dinas_ppk;
                $arr_nota_dinas_ppk_old = $data_old->nota_dinas_ppk_old;
                
                if(!in_array("BELUM ADA DOKUMEN LAMA", $arr_nota_dinas_ppk_old))
                {
                    array_push($arr_nota_dinas_ppk_old, $nota_dinas_ppk_old);
                }
                else
                {
                    $arr_nota_dinas_ppk_old = [$nota_dinas_ppk_old];
                }

                $nota_dinas_ppk = $this->uploadFile($request, 'nota_dinas_ppk', $direktorat);

                $usulan->where('id', $request->id)->update([
                    'nota_dinas_ppk'       => $nota_dinas_ppk,
                    'nota_dinas_ppk_old'   => $arr_nota_dinas_ppk_old
                ]);
            }

            if($request->hasFile('matrik_rab'))
            {
                $matrik_rab_old     = $data_old->matrik_rab;
                $arr_matrik_rab_old = $data_old->matrik_rab_old;

                if(!in_array("BELUM ADA DOKUMEN LAMA", $arr_matrik_rab_old))
                {
                    array_push($arr_matrik_rab_old, $matrik_rab_old);
                }
                else
                {
                    $arr_matrik_rab_old = [$matrik_rab_old];
                }

                $matrik_rab = $this->uploadFile($request, 'matrik_rab', $direktorat);

                $usulan->where('id', $request->id)->update([
                    'matrik_rab'       => $matrik_rab,
                    'matrik_rab_old'   => $arr_matrik_rab_old
                ]);
            }

            if($request->hasFile('kak'))
            {
                $kak_old     = $data_old->kak;
                $arr_kak_old = $data_old->kak_old;

                if(!in_array("BELUM ADA DOKUMEN LAMA", $arr_kak_old))
                {
                    array_push($arr_kak_old, $kak_old);
                }
                else
                {
                    $arr_kak_old = [$kak_old];
                }

                $kak = $this->uploadFile($request, 'kak', $direktorat);

                $usulan->where('id', $request->id)->update([
                    'kak'       => $kak,
                    'kak_old'   => $arr_kak_old
                ]);
            }

            if($request->hasFile('dokumen_pendukung'))
            {
                $dokumen_pendukung_old     = $data_old->dokumen_pendukung;
                $arr_dokumen_pendukung_old = $data_old->dokumen_pendukung_old;

                if(!in_array("BELUM ADA DOKUMEN LAMA", $arr_dokumen_pendukung_old))
                {
                    array_push($arr_dokumen_pendukung_old, $dokumen_pendukung_old);
                }
                else
                {
                    $arr_dokumen_pendukung_old = [$dokumen_pendukung_old];
                }

                $dokumen_pendukung = $this->uploadFile($request, 'dokumen_pendukung', $direktorat);

                $usulan->where('id', $request->id)->update([
                    'dokumen_pendukung'       => $dokumen_pendukung,
                    'dokumen_pendukung_old'   => $arr_dokumen_pendukung_old
                ]);
            }

            $usulan->where('id', $request->id)->update([
                'status' => 'Perbaikan Disubmit'
            ]);

            $data_pejabat   = $pejabat->where('id_dir', Auth::user()->id_dir)->first();
            $email_pejabat  = $data_pejabat->email;
            $text = Auth::user()->nama." telah mengajukan perubahan usulan kegiatan. Mohon segera ditindak lanjut";
            // $tools->sendingEmail($text, $email_pejabat, $data_old->nomor_surat);
            $this->record($request->id, "Mengubah Data Usulan Kegiatan", Auth::user()->id_akses);

            // $message_pptk   = "Pengajuan Revisi E-Ticketing Anda Berhasil Dikirim. Nomor Surat: ".$data_old->nomor_surat;
            // $message_ppk    = Auth::user()->nama." telah mengajukan revisi E-Ticketing baru dengan Nomor Surat: ".$data_old->nomor_surat.". Mohon segera ditindak lanjut";

            // $tools->sendingWa(Auth::user()->no_hp, $message_pptk);
            // $tools->sendingWa(Auth::user()->no_hp, $message_ppk);

            return response()->json([
                'status'    => 'success',
                'title'     => 'Usulan Kegiatan Berhasil Diubah',
                'message'   => 'Pengajuan Revisi Akan Segera Diproses'
            ]);
        }
        catch (\Illuminate\Database\QueryException $e)
        {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Oopps.. Error Submit. Please Try Again'
            ]);
        }
    }
}

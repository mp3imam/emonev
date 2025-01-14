<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/" class="nav-link @if($current == "Dashboard") active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <li class="nav-item @if($modul == "E-Ticketing") menu-open @endif">
            <a href="#" class="nav-link @if($current == "Pengajuan Revisi") active @endif">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    E-Ticketing
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if(empty(Auth::user()->prov) || Auth::user()->level == "0" || Auth::user()->prov == "pusat" || Auth::user()->username == "198505062004121001")
                <li class="nav-item">
                    <a href="{{route('ticketing.view-revisi-pusat')}}" class="nav-link @if($current == "Pengajuan Revisi Pusat") active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pengajuan Revisi Pusat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('usulan.kegiatan')}}" class="nav-link @if($current == "Usulan Kegiatan") active @endif">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Usulan Kegiatan
                        </p>
                    </a>
                </li>
                @endif
                @if(!empty(Auth::user()->prov) || Auth::user()->level == "0"  || Auth::user()->username == "198505062004121001")
                    <li class="nav-item @if($current == "Kegiatan GWPP" || $current == "Sarana & Prasarana") menu-open @endif">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengajuan Revisi Daerah</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('ticketing.view-ggwp-daerah')}}" class="nav-link @if($current == "Kegiatan GWPP") active @endif">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Revisi Kegiatan GWPP</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('ticketing.view-sarpras-daerah')}}" class="nav-link @if($current == "Sarana & Prasarana") active @endif">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Revisi Kegiatan Sarpras</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </li>

        @if(empty(Auth::user()->prov)  || Auth::user()->username == "198505062004121001")
            @if(Auth::user()->level == 0 || Auth::user()->level == 1 || Auth::user()->level == 5 || Auth::user()->level == 6  || Auth::user()->username == "198505062004121001")
            <li class="nav-item">
                <a href="{{route('pok.terbit-pok')}}" class="nav-link @if($current == "Penerbitan POK") active @endif">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Penerbitan POK
                    </p>
                </a>
            </li>
            @endif
        @endif
        
        @if(Auth::user()->level == 0 || Auth::user()->level == 5 || Auth::user()->level == 2 || Auth::user()->level == 3  || Auth::user()->username == "198505062004121001")
        <li class="nav-item @if($modul == "Capaian") menu-open @endif">
            <a href="#" class="nav-link @if($modul == "Capaian") active @endif">
                <i class="nav-icon far fa-chart-bar"></i>
                <p>
                    Capaian Output
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if(empty(Auth::user()->prov))
                    <li class="nav-item @if($current == "Capaian Pusat" || $current == "Validasi Capaian") menu-open @endif">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Capaian Pusat</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('capaian.capaian-output')}}" class="nav-link @if($current == "Capaian Pusat") active @endif">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Capaian Output Pusat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('capaian.validasi-capaian-output')}}" class="nav-link @if($current == "Validasi Capaian") active @endif">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Validasi Capaian Output</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('capaian.capaian-output-daerah')}}" class="nav-link @if($current == "Capaian Daerah") active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Capaian Daerah</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif

        @if(Auth::user()->level == 0  || Auth::user()->username == "198505062004121001")
            <li class="nav-item @if($modul == "Master") menu-open @endif">
                <a href="#" class="nav-link @if($modul == "Master") active @endif">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                        Master
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('master.data-subdit')}}" class="nav-link @if($current == "Data Subdit") active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Subdit</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('master.satuan-kerja')}}" class="nav-link @if($current == "Data Satuan Kerja") active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Satuan Kerja</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('master.satker-eselon-1')}}" class="nav-link @if($current == "Satker Eselon 1") active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Satker Eselon 1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('master.view-users')}}" class="nav-link @if($current == "Data Pengguna") active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Pengguna</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('master.users-request')}}" class="nav-link @if($current == "Pengajuan Pengguna") active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengajuan Pengguna</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('master.subkomponen-pusat')}}" class="nav-link @if($current == "Kode Subkomponen Pusat") active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kode Subkomponen Pusat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('master.subkomponen-dekon')}}" class="nav-link @if($current == "Kode Subkomponen Dekon") active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kode Subkomponen Dekon</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('capaian.target-capaian-output')}}" class="nav-link @if($current == "Target Capaian") active @endif">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>Target Capaian</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('master.history-pagu')}}" class="nav-link @if($current == "Riwayat Pagu") active @endif">
                    <i class="nav-icon fas fa-history"></i>
                    <p>
                        Riwayat Pagu
                    </p>
                </a>
            </li>
        @endif

        @if(is_numeric(Auth::user()->prov) || Auth::user()->level == "0"  || Auth::user()->username == "198505062004121001")
        <li class="nav-item">
            <a href="https://sipgwpp.kemendagri.go.id/" target="_blank" class="nav-link">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>
                    SIP GWPP
                </p>
            </a>
        </li>
        @endif

        @if(Auth::user()->level == "0"  || Auth::user()->username == "198505062004121001")
            <li class="nav-item @if($modul == "Sakti") menu-open @endif">
                <a href="#" class="nav-link @if($modul == "Sakti") active @endif">
                    <i class="nav-icon fas fa-sync"></i>
                    <p>
                        Integrasi Sakti
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('sakti.data-anggaran')}}" class="nav-link @if($current == "Data Anggaran") active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Anggaran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('sakti.data-realisasi')}}" class="nav-link @if($current == "Data Realisasi") active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Realisasi</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="changePassword('{{Auth::user()->username}}')">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Ubah Password
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('profile')}}" class="nav-link @if($current == "Profile") active @endif">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Profile
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>

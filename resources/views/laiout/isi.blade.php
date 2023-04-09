<div class="section" id="user-section">
    <div id="user-detail">
        <div class="avatar">
            @php
                $jalan = Storage::url('uploads/profile/' . Auth::guard('pegawai')->user()->foto);
            @endphp
            @if (!empty(Auth::guard('pegawai')->user()->foto))
                <img src="{{ url($jalan) }}" alt="avatar" class="imaged w64 rounded" style="height: 70px;">
            @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
            @endif
        </div>
        <div id="user-info">
            <h2 id="user-name">{{ Auth::guard('pegawai')->user()->nama_lengkap }}</h2>
            <span id="user-role">{{ Auth::guard('pegawai')->user()->jabatan }}</span>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/editprof" class="green" style="font-size: 40px;">
                            <ion-icon name="person-sharp"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Profil</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/ijin" class="danger" style="font-size: 40px;">
                            <ion-icon name="calendar-number"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Cuti</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/presensi/riwayat" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="orange" style="font-size: 40px;">
                            <ion-icon name="location"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        Lokasi
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/proses_keluar" class="orange" style="font-size: 40px;">
                            <ion-icon name="exit-outline"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        Keluar
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($absen != null)
                                    @php
                                        $jalur = Storage::url('uploads/absensi/' . $absen->foto_in);
                                    @endphp
                                    <img src="{{ url($jalur) }}" class="imaged w64 rounded">
                                @else
                                    <ion-icon name="enter-outline"></ion-icon>
                                @endif

                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle"><a href="/presensi/create"><b>Masuk</b></a></h4>

                                <span>{{ $absen != null ? $absen->jam_in : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($absen != null)
                                    @php
                                        $jalur = Storage::url('uploads/absensi/' . $absen->foto_out);
                                    @endphp
                                    @if ($absen->foto_out != null)
                                    <img src="{{ url($jalur) }}" class="imaged w64 rounded">
                                    @else
                                    <ion-icon name="exit-outline"></ion-icon>
                                    @endif
                                @else
                                <ion-icon name="exit-outline"></ion-icon>
                                @endif

                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle"><a href="/presensi/create"><b>Pulang</b></a> </h4>
                                <span>{{ $absen != null && $absen->jam_out != null ? $absen->jam_out : 'Masih Kerja' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="rekappresensi">
        <h4>Rekap Absensi Bulan: {{ $namabln }} , Tahun: {{ $thnini }}</h4>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 16px 12px !important">
                        <span class="badge bg-danger"
                            style="position: absolute; top: 3px; right: 10px; font-size: 0.5rem;z-index: 999;">{{ $rekapabsen->jmlhdr }}</span>
                        <ion-icon name="accessibility-outline" style="font-size: 1.5rem;" class="text-success">
                        </ion-icon>
                        <br>
                        <span style="font-size: 0.7rem">hadir</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 16px 12px !important">
                        <span class="badge bg-danger"
                            style="position: absolute; top: 3px; right: 10px; font-size: 0.5rem;z-index: 999;">{{$rekapijincuti}}</span>
                        <ion-icon name="person-remove-outline" style="font-size: 1.5rem;" class="text-danger">
                        </ion-icon>
                        <br>
                        <span style="font-size: 0.7rem">Ijin</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 16px 12px !important">
                        <span class="badge bg-danger"
                            style="position: absolute; top: 3px; right: 10px; font-size: 0.5rem;z-index: 999;">{{$rekapsakit}}</span>
                        <ion-icon name="sad-outline" style="font-size: 1.5rem;" class="text-danger -mb-2">
                        </ion-icon>
                        <br>
                        <span style="font-size: 0.7rem">sakit</span>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 16px 12px !important">
                        <span class="badge bg-danger"
                            style="position: absolute; top: 3px; right: 10px; font-size: 0.5rem;z-index: 999;">{{ $rekapabsen->jmtlt }}</span>
                        <ion-icon name="walk-outline" style="font-size: 1.5rem;" class="text-warning mb-1">
                        </ion-icon>
                        <br>
                        <span style="font-size: 0.7rem">telat</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="presencetab mt-2">
        <div class="tab-pane fade show active" id="pilled" role="tabpanel">
            <ul class="nav nav-tabs style1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        Bulan Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                        Leaderboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-2" style="margin-bottom:100px;">
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($sejarahAbsen as $data)
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    @php
                                        $jalur = Storage::url('uploads/absensi/' . $data->foto_out);
                                    @endphp
                                    <img src="{{ url($jalur) }}" alt="" class="imaged w32 rounded">
                                </div>
                                <div class="in">
                                    <div>Tgl: {{ date('d-m-Y', strtotime($data->tgl_absen)) }}</div>
                                    <span
                                        class="badge {{ $data->jam_in < '06:00' ? 'badge-warning' : 'badge-danger' }}
                                    ">{{ $data->jam_in }}</span>
                                    <span
                                        class="badge badge-success">{{ $data != null && $data->jam_out != null ? $data->jam_out : 'Masih Aktif' }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($leaderboard as $lead)
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div><b>{{ $lead->nama_lengkap }}</b><br>
                                        <span class="text-muted">{{ $lead->jabatan }}</span>
                                    </div>
                                    <span
                                        class="badge
                                {{ $lead->jam_in < '06:00' ? 'bg-success' : 'bg-danger' }}
                                ">{{ $lead->jam_in }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach



                </ul>
            </div>


        </div>
    </div>
</div>

@extends('laiout.presensi')

@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Pengajuan Ijin</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 4rem">
        <div class="col">
            @php
                $psnsukses = Session::get('sukses');
                $psnirsukses = Session::get('gagal');
            @endphp
            @if (Session::get('sukses'))
                <div class="alert alert-success">
                    <h4>{{ $psnsukses }}</h4>
                </div>
            @else
                <h4>{{ $psnirsukses }}</h4>
            @endif
        </div>
    </div>

    <ul class="listview image-listview" >
        @foreach ($dtijin as $jin)
            <li>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important">
                            <div class="row">
                                <div class="col-4">
                                    <span class="badge bg-danger"
                                        style="position: absolute; top: 3px; right: 10px; font-size: 0.5rem;z-index: 999;"></span>
                                    <ion-icon name="calendar-outline" style="font-size: 1.5rem;" class="text-success">
                                    </ion-icon>
                                    <br>
                                    <span style="font-size: 0.7rem">Tanggal:</span><br>
                                    <span style="font-size: 0.8rem">{{ date('d-m-Y', strtotime($jin->tgl_ijin)) }}</span>
                                </div>

                                <div class="col-4">
                                    <span class="badge bg-danger"
                                        style="position: absolute; top: 3px; right: 10px; font-size: 0.5rem;z-index: 999;"></span>
                                    <ion-icon name="library-outline" style="font-size: 1.5rem;" class="text-success">
                                    </ion-icon>
                                    <br>
                                    <span style="font-size: 0.7rem">Alasan:</span><br>
                                    <span style="font-size: 0.8rem"><b>
                                            @if ($jin->status == 'i')
                                                Ijin
                                            @else
                                                Sakit
                                            @endif


                                        </b></span><br>
                                        <span style="font-size: 0.6rem">{{$jin->keterangan}}</span>
                                </div>

                                <div class="col-4">
                                    <span class="badge bg-danger"
                                        style="position: absolute; top: 3px; right: 10px; font-size: 0.5rem;z-index: 999;"></span>
                                    <ion-icon name="accessibility-outline" style="font-size: 1.5rem;" class="text-success">
                                    </ion-icon>
                                    <br>
                                    <span style="font-size: 0.7rem"><b>Status:</b></span><br>
                                    @if ($jin->status_appvl == 0)
                                    <span class="badge bg-warning "> Tunda</span>
                                    @elseif($jin->status_appvl == 1)
                                    <span class="badge bg-success "> Disetujui</span>
                                    @else
                                    <span class="badge bg-danger "> Ditolak</span>
                                    @endif

                                </div>

                            </div>
                        </div>

                    </div></div>
                </div>


            </li>
        @endforeach
    </ul>

    <div style="margin-bottom: 80px"></div>

    <div class="fab-button bottom-right" style="margin-bottom: 80px">
        <a href="/presensi/buatijin" class="fab">
            <ion-icon name="add-outline"></ion-icon>
        </a>
    </div>
@endsection

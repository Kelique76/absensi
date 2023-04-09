@extends('laiout.presensi')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Edit Profile</div>
        <div class="right"></div>
    </div>
@endsection

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

<div style="margin-top: 80px; ">

    <form action="/presensi/update/{{ $krywn->nik }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col">
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" class="form-control" value="{{ $krywn->nama_lengkap }}" name="nama_lengkap"
                        placeholder="Nama Lengkap" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" class="form-control" value="{{ $krywn->no_wa }}" name="no_wa"
                        placeholder="No. HP" autocomplete="off">
                </div>
            </div>

            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="password" class="form-control" name="password" placeholder="Password"
                        autocomplete="off">
                </div>
            </div>

            <div class="custom-file-upload" id="fileUpload1">
                <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                <label for="fileuploadInput">
                    <span>
                        <strong>
                            @php
                                $jalan = Storage::url('uploads/profile/' .$krywn->foto);
                            @endphp
                            @if (!empty(Auth::guard('pegawai')->user()->foto))
                                <img src="{{ url($jalan) }}" alt="foto profile" class="imaged w64 rounded">
                            @else
                                <ion-icon name="cloud-upload-outline" role="img" class="md hydrated"
                                    aria-label="cloud upload outline"></ion-icon>
                            @endif

                            <i>Tap to Upload</i>
                        </strong>
                    </span>
                </label>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <button type="submit" class="btn btn-primary btn-block">
                        <ion-icon name="refresh-outline"></ion-icon>
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@extends('laiout.presensi')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Absen Wajah</div>
        <div class="right"></div>
    </div>

    <style>
        .webcam-capture,
        .webcam-capture video {
            display: inline-block;
            width: 100% !important;
            margin: auto;
            height: auto !important;
            border-radius: 15px;

        }

        #map {
            height: 380px;
        }
    </style>
    <link rel="manifest" href="public/manifest.json" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
@endsection

@section('content')
    <div class="container">
        <div class="row" style="margin-top: 70px">
            <div class="col">
                <input type="hidden" id="lokasi">
                <div class="webcam-capture"></div>
            </div>
        </div>
        <div class="row">
            @if ($cek>0)
            <div class="col">
                <button class="btn btn-danger btn-block" id="takeabsen">
                    Keluar Absen

                    <ion-icon name="camera-outline"></ion-icon>
                </button>
            </div>
            @else
            <div class="col">
                <button class="btn btn-primary btn-block" id="takeabsen">
                    Masuk Absen

                    <ion-icon name="camera-outline"></ion-icon>
                </button>
            </div>
            @endif

        </div>

        <div class="row mt-2">
            <div class="col">
                <div id="map"></div>
            </div>
        </div>
        <audio id="notif_in">
            <source src="{{asset('assets/sound/BotikaTTSClaraMasuk.mp3')}}" type="audio/mpeg">
        </audio>
        <audio id="notif_out">
            <source src="{{asset('assets/sound/BotikaTTSyifaKeluar.mp3')}}" type="audio/mpeg">
        </audio>
        <audio id="notif_gagal">
            <source src="{{asset('assets/sound/BotikaTTSClaraGagal.mp3')}}" type="audio/mpeg">
        </audio>
    </div>
@endsection

@push('myscript')
    <script>
        var notifIn = document.getElementById('notif_in');
        var notifOut = document.getElementById('notif_out');
        var notifGGL = document.getElementById('notif_gagal');
        Webcam.set({
                height: 280,
                width: 340,
                image_format: 'jpeg',
                jpeg_quality: 80
            }


        );
        Webcam.attach('.webcam-capture');

        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        function successCallback(pos) {
            lokasi.value = pos.coords.latitude + "," + pos.coords.longitude;
            var map = L.map('map').setView([pos.coords.latitude, pos.coords.longitude], 14);
           var lokktr ="{{$lok->koordinat}}";
            var koor = lokktr.split(",");
            var lat = koor[0];
            var lon = koor[1];
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            var radius = "{{$lok->radius}}";
            var marker = L.marker([pos.coords.latitude, pos.coords.longitude]).addTo(map);

            var circle = L.circle([lat, lon], {
                color: 'green',
                fillColor: 'yellow',
                fillOpacity: 0.2,
                radius: radius
            }).addTo(map);

        }

        function errorCallback() {

        }
        $('#takeabsen').click(function(e) {
            Webcam.snap(function(uri) {
                image = uri;
            });
            var loks = $("#lokasi").val();
            $.ajax({
                type: 'POST',
                url: '/presensi/store',
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    lokasi: loks
                },
                cache: false,
                success: function(res) {
                    var status = res.split("|")
                    if (status[0] == "Sukses") {
                        if(status[2] == "in"){
                            notifIn.play();
                        }else{
                            notifOut.play();
                        }
                        Swal.fire({
                            title: 'Berhasil!',
                            text: status[1],
                            icon: 'success',

                        });
                        setTimeout("location.href='/admin'", 4000);
                    } else {
                        if(status[2] == "out"){
                            notifGGL.play();
                        }else{
                            notifGGL.play();
                        }
                        Swal.fire({
                            title: 'Error!',
                            text: status[1],
                            icon: 'error',
                            confirmButtonText: 'Ulangi'
                        });
                    }
                }
            });
            // alert('keno klik');
        });
    </script>
@endpush

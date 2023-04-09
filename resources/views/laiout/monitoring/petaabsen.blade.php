@extends('laiout.admin.table')


@section('content')
    <style>
        #map {
            height: 380px;
        }
    </style>
    <div class="page-body">
        <div class="container-xl">
            <a href="/panel/absennya"> <button type="button" class="btn btn-outline-danger">Balik</button></a>

            <br>


            <div id="map" style="margin-top: 16px"></div>


        </div>
    </div>
@endsection
@push('myscript')
    <script>
        var lok = "{{ $sio->lokasi_in }}";
        var loks = lok.split(",");
        var lat = loks[0];
        var lon = loks[1];

        var lokktr = "{{ $lok->koordinat }}";
        var koor = lokktr.split(",");
        var latk = koor[0];
        var lonk = koor[1];

        var map = L.map('map').setView([lat, lon], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([lat, lon]).addTo(map);

        var circle = L.circle([latk, lonk], {
            color: 'green',
            fillColor: '#f03',
            fillOpacity: 0.3,
            radius: {{$lok->radius}}
        }).addTo(map);

        var popup = L.popup()
            .setLatLng([lat, lon])
            .setContent("{{ $sio->nama_lengkap }}")
            .openOn(map);
    </script>
@endpush

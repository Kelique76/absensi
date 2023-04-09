<?php
function selisih($jam_masuk, $jam_keluar)
{
    [$h, $m, $s] = explode(':', $jam_masuk);
    $dtAwal = mktime($h, $m, $s, '1', '1', '1');
    [$h, $m, $s] = explode(':', $jam_keluar);
    $dtAkhir = mktime($h, $m, $s, '1', '1', '1');
    $dtSelisih = $dtAkhir - $dtAwal;
    $totalmenit = $dtSelisih / 60;
    $jam = explode('.', $totalmenit / 60);
    $sisamenit = $totalmenit / 60 - $jam[0];
    $sisamenit2 = $sisamenit * 60;
    $jml_jam = $jam[0];
    return $jml_jam . ':' . round($sisamenit2);
}
?>

<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta17
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Laporan Absensi: {{ $bln}}, {{ $thn }}</title>
    <!-- CSS files -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-flags.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-payments.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-vendors.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/demo.min.css?1674944402') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        @page {
            size: A4
        }


        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class="A4">
    <script src="./dist/js/demo-theme.min.js?1674944402"></script>
    <div class="page">

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Laporan Absensi
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                                <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                    <path
                                        d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                </svg>
                                Print Laporan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card card-lg">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <img src="https://img.freepik.com/free-vector/branding-identity-corporate-b-logo-vector-design-template_460848-13934.jpg"
                                        alt="" width="80" height="90">
                                </div>
                                <div class="col-4">
                                    <p class="h3"><b>PT. MD Aesthetics Medica</b></p>
                                    <address>
                                        Periode:{{ $listbulan[$bln] }}, {{ $thn }}<br>
                                        Jl. Jeruk 9J,<br>
                                        Jagakarsa, <br>
                                        Jagakarsa, Jakarta Selatan, 12820
                                    </address>
                                </div>

                                <div class="col-3 text-end">
                                    @php
                                        $jalan = Storage::url('uploads/profile/' . $peg->foto);
                                    @endphp
                                    @if (!empty($peg->foto))
                                        <img src="{{ url($jalan) }}" alt="foto profile"
                                            style="width: 90px; height: 130px;">
                                    @else
                                        <ion-icon name="cloud-upload-outline" role="img" class="md hydrated"
                                            aria-label="cloud upload outline"></ion-icon>
                                    @endif
                                </div>
                                <div class="col-3 text-end">
                                    <p class="h3">Profile</p>

                                    <address>
                                        Nama Lengkap : {{ $peg->nama_lengkap }} <br>
                                        NIK : {{ $peg->nik }} <br>
                                        Jabatan : {{ $peg->jabatan }} <br>
                                        Bagian : {{ $peg->nama_dept }} <br>
                                        Handphone : {{ $peg->no_wa }} <br>


                                    </address>

                                </div>
                                <div class="col-12 my-5">
                                    <h1>Laporan Absen Individu:
                                        MD{{ date('d') }}/{{ $bln }}/{{ $thn }}</h1>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Jam Masuk</th>
                                                    <th>Foto In</th>
                                                    <th>Jam Pulang</th>
                                                    <th>Foto Out</th>
                                                    <th>Keterangan</th>
                                                    <th>Total Jam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($absensi as $item)
                                                    @php
                                                        $jalanIn = Storage::url('uploads/absensi/' . $item->foto_in);
                                                        $jalanOut = Storage::url('uploads/absensi/' . $item->foto_out);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($item->tgl_absen)) }}</td>
                                                        <td>{{ $item->jam_in != null ? $item->jam_in : 'Tidak Absen' }}
                                                        </td>
                                                        <td>

                                                            <img src="{{ url($jalanIn) }}" alt="foto profile"
                                                                style="width: 40px; height: 45px;">

                                                        </td>
                                                        <td>
                                                            {{ $item->jam_out != null ? $item->jam_out : 'Masih Aktif' }}
                                                        </td>
                                                        <td><img src="{{ url($jalanOut) }}" alt="foto profile"
                                                                style="width: 40px; height: 45px;"></td>

                                                        <td>
                                                            @if ($item->jam_in > '06:00')
                                                                @php
                                                                    $ketelatan = selisih('06:00:00', $item->jam_in);
                                                                @endphp
                                                                <span class="badge bg-red">Telat:
                                                                    {{ $ketelatan }}</span>
                                                            @else
                                                                <span class="badge bg-green">Pass</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($item->jam_out != null)
                                                            @php
                                                                $jmkrj = selisih($item->jam_in, $item->jam_out)
                                                            @endphp

                                                            @else
                                                            $jmkrj =0;
                                                            @endif
                                                            {{$jmkrj}}
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <table width:"100%" style="margin-top:10px">
                                    <tr>
                                        <td colspan="2" style="floating: right;">
                                            Jakarta: {{date('d-m-Y')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; vertical-align: bottom;">
                                            <u>Papi Nugie</u><br>
                                            <i><b>Manager HRD</b></i>
                                        </td>

                                        <td style="text-align: center; vertical-align: bottom;">
                                            <u>Mami Nugie</u><br>
                                            <i><b>Direktur HR</b></i>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('tabler/dist/libs/apexcharts/dist/apexcharts.min.js?1674944402') }}" defer></script>
    <script src="{{ asset('tabler/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1674944402') }}" defer></script>
    <script src="{{ asset('tabler/dist/libs/jsvectormap/dist/maps/world.js?1674944402') }}" defer></script>
    <script src="{{ asset('tabler/dist/libs/jsvectormap/dist/maps/world-merc.js?1674944402') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('tabler/dist/js/tabler.min.js?1674944402') }}" defer></script>
    <script src="{{ asset('tabler/dist/js/demo.min.js?1674944402') }}" defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
</body>

</html>

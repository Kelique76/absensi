@extends('laiout.admin.table')
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

@section('content')
    <div class="container">
        <div class="page-header d-print-none">
            <div class="container ml-5 mr-4">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Manajemen Ijin
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container"></div>
            <div class="card">


                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            @if (Session::get('sukses'))
                                <div class="alert alert-success">
                                    {{ Session::get('sukses') }}
                                </div>
                            @endif
                            @if (Session::get('gagal'))
                                <div class="alert alert-danger">
                                    {{ Session::get('gagal') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <form action="/panel/dataijin" method="GET">
                        <div class="row">
                            <div class="col-2">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-calendar" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                            </path>
                                            <path d="M16 3v4"></path>
                                            <path d="M8 3v4"></path>
                                            <path d="M4 11h16"></path>
                                            <path d="M11 15h1"></path>
                                            <path d="M12 15v3"></path>
                                        </svg>
                                    </span>
                                    <input type="text"  class="form-control"
                                        id="datepicker" name="dari" placeholder="tanggal awal">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-calendar" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                            </path>
                                            <path d="M16 3v4"></path>
                                            <path d="M8 3v4"></path>
                                            <path d="M4 11h16"></path>
                                            <path d="M11 15h1"></path>
                                            <path d="M12 15v3"></path>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control"
                                        id="datepicker2" name="sampai" placeholder="tanggal akhir">
                                </div>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="Nama Pegawai" name="nama">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="NIK" name="nik">
                            </div>
                            <div class="col-2">
                                <select name="status_appv" id="status" class="form-control">
                                    <option value="">pilih status</option>
                                    <option value="0">Baru</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Tolak</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-blue " type="submit">

                                        <!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M21 12a9 9 0 1 0 -9 9"></path>
                                            <path d="M9 10h.01"></path>
                                            <path d="M15 10h.01"></path>
                                            <path d="M9.5 15c.658 .672 1.56 1 2.5 1"></path>
                                            <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                            <path d="M20.2 20.2l1.8 1.8"></path>
                                         </svg>

                                </button>
                            </div>

                        </div>
                    </form>

                    <div class="row mt-8">
                        <div class="col-8">
                            <ul class="listview image-listview">
                                @foreach ($ijins as $jin)
                                    <a href="/panel/editijins/{{$jin->id}}">
                                        <div class="card card-sm mt-2">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span class="bg-twitter text-white avatar">
                                                            @if ($jin->status == 's')
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="icon icon-tabler icon-tabler-report-medical"
                                                                    width="24" height="24" viewBox="0 0 24 24"
                                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                    </path>
                                                                    <path
                                                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                                                    </path>
                                                                    <path
                                                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                                                    </path>
                                                                    <path d="M10 14l4 0"></path>
                                                                    <path d="M12 12l0 4"></path>
                                                                </svg>
                                                            @else
                                                                <span class="bg-facebook text-white avatar">
                                                                    <!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-old" width="24"
                                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                        stroke="currentColor" fill="none"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                        </path>
                                                                        <path d="M11 21l-1 -4l-2 -3v-6"></path>
                                                                        <path d="M5 14l-1 -3l4 -3l3 2l3 .5"></path>
                                                                        <path d="M8 4m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                                                        <path d="M7 17l-2 4"></path>
                                                                        <path d="M16 21v-8.5a1.5 1.5 0 0 1 3 0v.5"></path>
                                                                    </svg>
                                                                </span>
                                                            @endif

                                                        </span>
                                                    </div>
                                                    <div class="col">
                                                        <table>
                                                            <tr>
                                                                <th>Nama Pegawai</th>
                                                                <th>:</th>
                                                                <th>{{ $jin->nama_lengkap }}</th>

                                                            </tr>
                                                            <tr>
                                                                <td>Tanggal</td>
                                                                <td>:</td>
                                                                <td>{{date('d-m-Y', strtotime( $jin->tgl_ijin)) }}</td>

                                                            </tr>
                                                            <tr>
                                                                <td>Jenis</td>
                                                                <td>:</td>
                                                                <td> @if ($jin->status == 's')
                                                                    <span class="badge bg-red">Sakit </span>
                                                                    @else
                                                                    <span class="badge bg-yellow">Ijin/Cuti</span>
                                                                    @endif
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>Alasan</td>
                                                                <td>:</td>
                                                                <td>{{ $jin->keterangan }}</td>

                                                            </tr>
                                                            <tr>
                                                                <td>NIK</td>
                                                                <td>:</td>
                                                                <td>{{ $jin->nik }}</td>

                                                            </tr>
                                                            <tr>
                                                                <td>Status</td>
                                                                <td>:</td>
                                                                <td>
                                                                    @if ($jin->status_appvl == '0')
                                                                    <span class="badge bg-yellow">BARU </span>
                                                                    @elseif ($jin->status_appvl == '1')
                                                                    <span class="badge bg-green">Appvd </span>
                                                                    @elseif ($jin->status_appvl == '2')
                                                                    <span class="badge bg-red">Rejected </span>
                                                                    @endif
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modaleditcuti" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" id="loadeditform">



                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">BATAL</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script>

        $(function() {
            $("#datepicker").datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).datepicker('update', new Date());

            $("#datepicker2").datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            }).datepicker('update', new Date());


        });
    </script>
@endpush

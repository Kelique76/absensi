@extends('laiout.admin.table')


@section('content')

    <div class="page-body">

        <div class="container-xl">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->

                        <h2 class="page-title">
                            Data Absensi
                        </h2>


                    </div>
                    <!-- Page title actions -->

                </div>


            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">

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
                                            <input type="text" value="{{ date('Y-m-d') }}" class="form-control"
                                                id="datepicker" name="tanggal" placeholder="tanggal kehadiran">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-12">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>NIK</th>
                                                <th>Unit</th>
                                                <th>Tanggal Absen</th>
                                                <th>Masuk</th>
                                                <th>Pulang</th>
                                                <th>FotoIn</th>
                                                <th>FotoOut</th>
                                                <th>Ket. Telat</th>
                                                <th>Cek</th>

                                            </tr>
                                        </thead>
                                        <tbody id="loadabsensi">


                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modalnambahkry" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="muatpeta">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>

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

            function muatAbsensi() {
                var tgl = $("#datepicker").val();
                $.ajax({
                    type: "POST",
                    url: "/panel/absensi",
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",

                        tgl: tgl
                    },
                    success: function(r) {
                        $("#loadabsensi").html(r);
                    }
                });
            }

            $("#datepicker").change(function(e) {
                muatAbsensi();
            });

            muatAbsensi();


        });
    </script>
@endpush

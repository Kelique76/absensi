
@extends('laiout.admin.table')


@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        Data Departemen
                    </h2>


                </div>
                <!-- Page title actions -->

            </div>


        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="row mt-3 ml-3 mr-3">
                            <div class="col-3">
                                <a href="#" id="btntambah" class="btn btn-primary d-none d-sm-inline-block">
                                    <!-- /panel/mbahkaryawan Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>

                                </a>
                            </div>
                        </div>
                        <div class="card-body">


                            <div class="row">
                                <div class="col-12">
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

                            <br>
                            <div class="row mb-12">

                            </div>
                            <br>

                            <div class="row mt-12">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Dept</th>
                                                <th>Nama Dept</th>

                                                <th>Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($dep as $item)
                                                {{-- @php
                                                    $jalan = Storage::url('uploads/profile/' . $item->foto);
                                                @endphp --}}
                                                <tr>

                                                    <td> {{ $loop->iteration }}</td>
                                                    <td>{{ $item->dept }}</td>
                                                    <td>{{ $item->nama_dept }}</td>

                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="#" class="btnaddit" dept={{$item->dept}}>
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="icon icon-tabler icon-tabler-edit" width="24"
                                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                    stroke="currentColor" fill="none"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                    </path>
                                                                    <path
                                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                    </path>
                                                                    <path
                                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                    </path>
                                                                    <path d="M16 5l3 3"></path>
                                                                </svg>
                                                            </a> |
                                                            <form method="POST" action="/panel/deleteunit/{{ $item->dept }}">
                                                                @csrf
                                                                <a href="#" class="btndelete" id="cfm-del">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-trash-filled"
                                                                        width="24" height="24" viewBox="0 0 24 24"
                                                                        stroke-width="1" stroke="currentColor"
                                                                        fill="none" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none"></path>
                                                                        <path
                                                                            d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z"
                                                                            stroke-width="0" fill="red"></path>
                                                                        <path
                                                                            d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z"
                                                                            stroke-width="0" fill="currentColor"></path>
                                                                    </svg>
                                                                </a>
                                                            </form>
                                                        </div>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- {{$kar->links()}} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modaltbhunit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <form class="card" action="/panel/nambahunit" id="formunita" method="POST"
                       >
                        @csrf


                        <div class="input-icon mb-2">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                </svg>
                            </span>
                            <input type="text" class="form-control" placeholder="Nama Departemen" id="nama"
                                name="nama">
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <button  class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </div>



                    </form>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">BATAL</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modaleditkry" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body" id="formeditu">


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
            $("#btntambah").click(function() {
                $("#modaltbhunit").modal("show");
            });

            $(".btnaddit").click(function() {
                var dpt = $(this).attr('dept');
                // alert(dpt);
                $.ajax({
                    type: "POST",
                    url: "/panel/editunit",
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",

                        dep: dpt
                    },
                    success: function(r) {
                        $("#formeditu").html(r);
                    }
                });
                $("#modaleditkry").modal("show");
            });

            $(".btndelete").click(function(e) {
                var form = $(this).closest("form");
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin mau menghapus data karyawan?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Gak Yakin',
                    denyButtonText: `Yakin`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.fire('Ok!', 'Data Tetap Ada', 'success')
                    } else if (result.isDenied) {
                        // alert('kena');
                        form.submit();
                        Swal.fire('Data Terhapus', 'Jangan menyesal...', 'warning')
                    } else {
                        Swal.fire('Ya sudah lah...', ':-()', 'info')
                    }
                })

            });

            $("#formunita").submit(function() {
                // alert('NIK kosong');
                var nama = $("#nama").val();

                if (nama == "") {
                    // alert('NIK kosong');
                    $("#nama").focus();
                    Swal.fire({
                        title: 'Data Nama Dept Kosong',
                        text: 'Data Nama Dept agar di isi',
                        icon: 'warning',
                        confirmButtonText: 'Isi Lagi!'
                    });
                    return false;
                }

            });
        });
    </script>
@endpush

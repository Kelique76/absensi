@extends('laiout.admin.table')


@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        Data Karyawan
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
                                <div class="col-12">
                                    <form action="/panel/karyawan" method="GET">
                                        @csrf
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <input name="nama_karyawan" id="nama_karyawan" class="form-control"
                                                        type="text" placeholder="cari nama karyawan"
                                                        value="{{ Request('nama_karyawan') }}">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <select name="kode_dept" id="kode_dept" class="form-select">
                                                        <option value="">pilih dept</option>
                                                        @foreach ($dep as $item)
                                                            <option
                                                                {{ Request('kode_dept') == $item->dept ? 'selected' : '' }}
                                                                value="{{ $item->dept }}">{{ $item->nama_dept }}</option>
                                                        @endforeach

                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-dnager">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-search" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                            <path d="M21 21l-6 -6"></path>
                                                        </svg>Cari
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="col-3">
                                                <a href="#" id="btntambah"
                                                    class="btn btn-primary d-none d-sm-inline-block">
                                                    <!-- /panel/mbahkaryawan Download SVG icon from http://tabler-icons.io/i/plus -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 5l0 14" />
                                                        <path d="M5 12l14 0" />
                                                    </svg>

                                                </a>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br>

                            <div class="row mt-12">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>NIK</th>
                                                <th>No HP</th>
                                                <th>Jabatan</th>
                                                <th>Dept</th>
                                                <th>Foto</th>
                                                <th>Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($kar as $item)
                                                @php
                                                    $jalan = Storage::url('uploads/profile/' . $item->foto);
                                                @endphp
                                                <tr>

                                                    <td> {{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama_lengkap }}</td>
                                                    <td>{{ $item->nik }}</td>
                                                    <td>{{ $item->no_wa }}</td>
                                                    <td>{{ $item->jabatan }}</td>
                                                    <td>{{ $item->nama_dept }}</td>
                                                    <td>
                                                        @if ($item->foto != null)
                                                            <img src="{{ url($jalan) }}" alt="foto profile"
                                                                class="avatar">
                                                        @else
                                                            <span
                                                                class="avatar">{{ mb_substr($item->nama_lengkap, 0, 1) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="#" class="btnedit" nik="{{ $item->nik }}">
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
                                                            <form action="/panel/deletekaryawan/{{ $item->nik }}"
                                                                method="POST">
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
    <div class="modal modal-blur fade" id="modalnambahkry" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">

                        <form class="card" action="/panel/nambahkaryawan" id="formkry" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Formulir Nambah Karyawan</h3>
                            </div>


                            <div class="card-body">


                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Nama Karyawan</label>
                                    <div class="col">
                                        <input type="text" id="nama" name="nama" class="form-control"
                                            placeholder="Nama Karyawan">

                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">NIK</label>
                                    <div class="col">
                                        <input type="text" id="nik" name="nik" class="form-control"
                                            placeholder="NIK Karyawan">

                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Password</label>
                                    <div class="col">
                                        <input id="password" type="password" name="password" class="form-control"
                                            placeholder="Password">
                                        <small class="form-hint">
                                            Password harusnya 8 karakter
                                        </small>
                                    </div>
                                </div>


                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Hand Phone</label>
                                    <div class="col">
                                        <input type="number" id="phone" name="phone" class="form-control"
                                            placeholder="HP Karyawan">

                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label required">Jabatan</label>
                                    <div class="col">
                                        <input type="text" id="jabatan" name="jabatan" class="form-control"
                                            placeholder="Jabatan Karyawan">

                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-3 col-form-label">Pilih Departemen</label>
                                    <div class="col">
                                        <select name="dept" id="dept" class="form-select" required>
                                            <option>Pilih Unit</option>
                                            @foreach ($dep as $item)
                                                <option value="{{ $item->dept }}">{{ $item->nama_dept }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">


                                            <div class="fallback">
                                                <input name="foto" type="file" />
                                            </div>

                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary">Simpan Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>

                </div>

            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modaleditkry" tabindex="-1" role="dialog" aria-hidden="true">
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
            $("#btntambah").click(function() {
                $("#modalnambahkry").modal("show");
            });

            $(".btnedit").click(function() {
                var nik = $(this).attr('nik');
                $.ajax({
                    type: "POST",
                    url: "/panel/editkaryawan",
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",

                        nik: nik
                    },
                    success: function(r) {
                        $("#loadeditform").html(r);
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
                    }else{
                        Swal.fire('Ya sudah lah...', ':-()', 'info')
                    }
                })

            });

            $("#formkry").submit(function() {
                // alert('NIK kosong');
                var nik = $("#nik").val();
                var nama = $("#nama").val();
                var password = $("#password").val();
                var dept = $("#dept").val();
                var jabatan = $("#jabatan").val();
                var phone = $("#phone").val();
                var foto = $("#foto").val();
                // var dept = $("#dept").val();
                var dept = $("#formkry").find("#dept").val();
                if (phone == "") {
                    // alert('NIK kosong');
                    $("#phone").focus();
                    Swal.fire({
                        title: 'Data HP Kosong',
                        text: 'Data HP agar di isi',
                        icon: 'warning',
                        confirmButtonText: 'Isi Lagi!'
                    });
                    return false;
                }
                if (jabatan == "") {
                    // alert('NIK kosong');
                    $("#jabatan").focus();
                    Swal.fire({
                        title: 'Data Jabatan Kosong',
                        text: 'Data jabatan agar di isi',
                        icon: 'warning',
                        confirmButtonText: 'Isi Lagi!'
                    });
                    return false;
                }
                if (dept == "") {
                    // alert('NIK kosong');
                    $("#dept").focus();
                    Swal.fire({
                        title: 'Dept Belum Dipilih',
                        text: 'Data dept harap di isi',
                        icon: 'warning',
                        confirmButtonText: 'Isi Lagi!'
                    });
                    return false;
                }
                if (nik == "") {
                    // alert('NIK kosong');
                    $("#nik").focus();
                    Swal.fire({
                        title: 'Data Kosong',
                        text: 'Data NIK harap di isi',
                        icon: 'warning',
                        confirmButtonText: 'Isi Lagi!'
                    });
                    return false;
                }
                if (nama == "") {
                    // alert('NIK kosong');
                    $("#nama").focus();
                    Swal.fire({
                        title: 'Data Kosong',
                        text: 'Data nama harap di isi',
                        icon: 'warning',
                        confirmButtonText: 'Isi Lagi!'
                    });
                    return false;
                }
                if (password == "") {
                    // alert('NIK kosong');
                    $("#password").focus();
                    Swal.fire({
                        title: 'Data Kosong',
                        text: 'Data Password harap di isi',
                        icon: 'warning',
                        confirmButtonText: 'Isi Lagi!'
                    });
                    return false;
                }
            });
        });
    </script>
@endpush

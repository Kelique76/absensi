@extends('laiout.admin.table')


@section('content')
    <div class="container">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Setting Kantor
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <div class="col-6">
                        <div class="card">

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

                            <div class="card-body">
                                <form action="/panel/simpansetting"  method="POST">
                                    @csrf
                                    <div class="input-icon mb-2">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pin-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M15.113 3.21l.094 .083l5.5 5.5a1 1 0 0 1 -1.175 1.59l-3.172 3.171l-1.424 3.797a1 1 0 0 1 -.158 .277l-.07 .08l-1.5 1.5a1 1 0 0 1 -1.32 .082l-.095 -.083l-2.793 -2.792l-3.793 3.792a1 1 0 0 1 -1.497 -1.32l.083 -.094l3.792 -3.793l-2.792 -2.793a1 1 0 0 1 -.083 -1.32l.083 -.094l1.5 -1.5a1 1 0 0 1 .258 -.187l.098 -.042l3.796 -1.425l3.171 -3.17a1 1 0 0 1 1.497 -1.26z" stroke-width="0" fill="currentColor"></path>
                                             </svg>
                                        </span>

                                        <input type="text" value="{{$lok->koordinat}}"  class="form-control" placeholder="Koordinat Kantor" id="lat"
                                            name="lokktr">
                                    </div>


                                    <div class="input-icon mb-2">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-dashed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95"></path>
                                                <path d="M3.69 8.56a9 9 0 0 0 -.69 3.44"></path>
                                                <path d="M3.69 15.44a9 9 0 0 0 1.95 2.92"></path>
                                                <path d="M8.56 20.31a9 9 0 0 0 3.44 .69"></path>
                                                <path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95"></path>
                                                <path d="M20.31 15.44a9 9 0 0 0 .69 -3.44"></path>
                                                <path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92"></path>
                                                <path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69"></path>
                                             </svg>
                                        </span>
                                        <input type="text" value="{{$lok->radius}}"  class="form-control" placeholder="Luas Radius" id="rad"
                                            name="rad">
                                    </div>

                                    <div class="row mt-2">

                                            <div class="form-group">
                                                <button type="submit" name="cetak" class="btn btn-danger w-100">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                            <path d="M14 4l0 4l-6 0l0 -4"></path>
                                                         </svg>
                                                    </span>Simpan
                                                </button>
                                            </div>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

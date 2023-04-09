@extends('laiout.admin.table')


@section('content')
    <div class="container-xl">
        <div class="col-md-12">
            <form class="card" action="/panel/nambahkaryawan" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h3 class="card-title">Formulir Nambah Karyawan</h3>
                </div>

                <br>

                <div class="col">
                    @php
                        $psnsukses = Session::get('sukses');
                        $psnirsukses = Session::get('gagal');
                    @endphp
                    @if (Session::get('sukses'))
                        <div class="alert alert-success">
                            <h4 style="color: greenyellow">{{ $psnsukses }}</h4>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <h4 style="color: greenyellow">{{ $psnirsukses }}</h4>
                        </div>
                    @endif
                </div>
                <br>
                <div class="card-body">


                    <div class="mb-3 row">
                        <label class="col-3 col-form-label required">Nama Karyawan</label>
                        <div class="col">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Karyawan">

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-3 col-form-label required">Password</label>
                        <div class="col">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <small class="form-hint">
                                Password harusnya 8 karakter
                            </small>
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label class="col-3 col-form-label required">Hand Phone</label>
                        <div class="col">
                            <input type="number" name="phone" class="form-control" placeholder="HP Karyawan">

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-3 col-form-label required">Jabatan</label>
                        <div class="col">
                            <input type="text" name="jabatan" class="form-control" placeholder="Jabatan Karyawan">

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-3 col-form-label">Pilih Departemen</label>
                        <div class="col">
                            <select name="dept" class="form-select">
                                <option>Pilih Unit</option>
                                @foreach ($dep as $item)
                                    <option value="{{ $item->dept }}">{{ $item->nama_dept }}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Upload Foto</h3>
                                <form class="dropzone" name="foto" id="dropzone-default" autocomplete="off" novalidate>
                                    <div class="fallback">
                                        <input name="file" type="file" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection

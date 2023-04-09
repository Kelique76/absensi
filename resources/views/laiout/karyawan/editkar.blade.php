<form class="card" action="/panel/updatekaryawan/{{$sidia->nik}}" id="formedkry" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-icon mb-2">
        <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-abc" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M3 16v-6a2 2 0 1 1 4 0v6"></path>
                <path d="M3 13h4"></path>
                <path d="M10 8v6a2 2 0 1 0 4 0v-1a2 2 0 1 0 -4 0v1"></path>
                <path d="M20.732 12a2 2 0 0 0 -3.732 1v1a2 2 0 0 0 3.726 1.01"></path>
            </svg>
        </span>
        <input type="text" readonly value="{{$sidia->nik}}" class="form-control" id="nik" name="nik" placeholder="NIK">
    </div>

    <div class="input-icon mb-2">
        <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
            </svg>
        </span>
        <input type="text" value="{{$sidia->nama_lengkap}}" class="form-control" placeholder="Nama Karyawan" id="nama"
            name="nama">
    </div>

    <div class="input-icon mb-2">
        <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-landline-phone"
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M20 3h-2a2 2 0 0 0 -2 2v14a2 2 0 0 0 2 2h2a2 2 0 0 0 2 -2v-14a2 2 0 0 0 -2 -2z"></path>
                <path d="M16 4h-11a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3h11"></path>
                <path d="M12 8h-6v3h6z"></path>
                <path d="M12 14v.01"></path>
                <path d="M9 14v.01"></path>
                <path d="M6 14v.01"></path>
                <path d="M12 17v.01"></path>
                <path d="M9 17v.01"></path>
                <path d="M6 17v.01"></path>
            </svg>
        </span>
        <input type="text" value="{{$sidia->no_wa}}" id="phone" type="number" name="phone" class="form-control"
            placeholder="HP Karyawan" id="nama" name="nama">
    </div>

    <div class="input-icon mb-2">
        <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-air-balloon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 19m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                <path d="M12 16c3.314 0 6 -4.686 6 -8a6 6 0 1 0 -12 0c0 3.314 2.686 8 6 8z"></path>
                <path d="M12 9m-2 0a2 7 0 1 0 4 0a2 7 0 1 0 -4 0"></path>
             </svg>
        </span>
        <input type="text" value="{{$sidia->jabatan}}" id="jabatan" type="text" name="jabatan" class="form-control"
            placeholder="Jabatan Karyawan" id="nama" name="nama">
    </div>

    <div class="col mb-2">

        <div class="col">
            <select name="dept" id="dept" class="form-select" required>

                @foreach ($dep as $item)
                    <option {{$sidia->kode_dep==$item->dept? 'selected':''}} value="{{ $item->dept }}  ">{{ $item->nama_dept }}</option>
                @endforeach
                {{--  --}}

            </select>
        </div>
    </div>

    {{-- <div class="col mb-2">
                <div class="fallback">
                    <input name="foto" type="file" />
                    <input type="hidden" name="fotolama" value="{{$sidia->foto}}">
                </div>
    </div> --}}

    <div class="row mb-3">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
    </div>



</form>

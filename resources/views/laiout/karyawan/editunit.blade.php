<form class="card" action="/panel/updateunit/{{$dep->dept}}" id="formeditu" method="POST">
    @csrf


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
        <input type="text" value="{{$dep->nama_dept}}" class="form-control" placeholder="Nama Departemen" id="nama"
            name="nama">
    </div>



    <div class="row mb-3">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-primary">Simpan Data</button>
            </div>
        </div>
    </div>



</form>

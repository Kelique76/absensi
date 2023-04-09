@extends('laiout.admin.table')
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
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
                            Approval Ijin
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container">
                <div class="card">
                    <form action="/panel/updateijins/{{$ijins->id}}" method="POST">
                        @csrf
                        <div class="card-body">

                                <div class="col">
                                    <table>
                                        <tr>
                                            <th>Nama Pegawai</th>
                                            <th>:</th>
                                            <th>{{ $ijins->nama_lengkap }}</th>

                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td>{{date('d-m-Y', strtotime( $ijins->tgl_ijin)) }}</td>

                                        </tr>
                                        <tr>
                                            <td>Jenis</td>
                                            <td>:</td>
                                            <td> @if ($ijins->status == 's')
                                                <span class="badge bg-red">Sakit </span>
                                                @else
                                                <span class="badge bg-yellow">Ijin/Cuti</span>
                                                @endif
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Alasan</td>
                                            <td>:</td>
                                            <td>{{ $ijins->keterangan }}</td>

                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            <td>
                                               <select name="status" id="">
                                                <option value="">Pilih Approval</option>
                                                <option value="{{1}}">Setuju</option>
                                                <option value="{{2}}">Tolak</option>

                                               </select>
                                            </td>

                                        </tr>

                                    </table>
                                </div>
                                <br>
                            <button type="submit" class="btn btn-success w-50">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

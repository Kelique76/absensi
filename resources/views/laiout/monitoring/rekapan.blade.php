@extends('laiout.admin.table')


@section('content')
    <div class="container">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Data Rekap Absen
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
                            <div class="card-body">
                                <form action="/panel/cetakrekap" target="_blank" method="POST">
                                    @csrf
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select name="bulan" id="bulan" class="form-select">
                                                    <option value="">Pilih Bulan</option>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ date('m') == $i ? 'selected' : ' ' }}>{{ $listbulan[$i] }}
                                                        </option>
                                                    @endfor

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select name="tahun" id="tahun" class="form-select">
                                                    <option value="">Tahun</option>
                                                    @php
                                                        $tahunawal = 2022;
                                                        $thnsekrg = date('Y');
                                                    @endphp
                                                    @for ($thn = $tahunawal; $thn <= $thnsekrg; $thn++)
                                                        <option value="{{ $thn }}"
                                                            {{ date('Y') == $thn ? 'selected' : ' ' }}>{{ $thn }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <button type="submit" name="cetak" class="btn btn-danger w-100">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-printer" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                                                            </path>
                                                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                            <path
                                                                d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z">
                                                            </path>
                                                        </svg>
                                                    </span>CETAK
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <button type="submit" name="exportxl" class="btn btn-warning w-100">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-file-spreadsheet"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                            <path
                                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                                            </path>
                                                            <path d="M8 11h8v7h-8z"></path>
                                                            <path d="M8 15h8"></path>
                                                            <path d="M11 11v7"></path>
                                                        </svg>
                                                    </span>DONWLOAD
                                                </button>
                                            </div>
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

@extends('laiout.presensi')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Riwayat Absen</div>
        <div class="right"></div>
    </div>
@endsection


@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">


            <div class="form-group boxed">
                <div class="input-wrapper">
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="">Pilih Bulan</option>

                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i  }}" {{date("m")==$i ? "selected":" "}}>{{ $listbulan[$i] }}</option>
                        @endfor

                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="">Pilih Tahun</option>
                            @php
                                $tahunawal = 2022;
                                $thnsekrg = date('Y');
                            @endphp
                            @for ($thn = $tahunawal; $thn <= $thnsekrg; $thn++)
                            <option value="{{$thn}}" {{date("Y")==$thn ? "selected":" "}}>{{$thn}}</option>
                            @endfor

                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group boxed">
                <div class="input-wrapper">
                    <button type="submit" class="btn btn-primary btn-block" id="cari">
                        <ion-icon name="search-outline"></ion-icon>
                        Cari
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col" id="showhistory">

        </div>
    </div>

@endsection

@push('myscript')
<script>
    $(function() {
        $("#cari").click(function(s){
            var bulan = $("#bulan").val();
            var thn = $("#tahun").val();
            // alert(bulan +"dan"+ thn)
            $.ajax(
                {
                    type: 'POST',
                    url : '/presensi/gethis',
                    data: {
                        _token: "{{csrf_token()}}",
                        bulan :bulan,
                        tahun : thn
                    },
                    chache: false,
                    success: function(r){
                       $("#showhistory").html(r);
                    }
                }
            );

        });
    })
</script>
@endpush

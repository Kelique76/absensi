@extends('laiout.presensi')
@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <style>
        .datepicker-modal{
            max-height: 430px !important;
        },
        .datepicker-date-display{
            background-color: #0f3a7e !important;
        }
    </style>

    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Form Pengajuan Ijin</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 80px">
        <div class="col">
            <form method="POST" action="/presensi/dataijin" id="frmijin">
                @csrf
                <div class="form-group">
                    <input type=text name="tglijin" id="tglijin" autocomplete="off" class="datepicker" required  placeholder="Input tgl ijin">

                </div>


                <div class="form-group">
                    <select name="status" id="status" class="form-control" required>
                        <option value="">pilih: sakit/ijin</option>
                        <option value="s">sakit</option>
                        <option value="i">ijin</option>
                    </select>

                </div>


                <div class="form-group">
                    <textarea name="keterangan" id="keterangan" cols="7" rows="5" class="form-control" required
                        placeholder="isi keterangan ijin"></textarea>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary w-100">AJUKAN</button>
                </div>

            </form>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        var currYear = (new Date()).getFullYear();

        $(document).ready(function() {
            $(".datepicker").datepicker({
                defaultDate: new Date(currYear, 1, 31),
                // setDefaultDate: new Date(2000,01,31),
                maxDate: new Date(currYear + 5, 12, 31),
                yearRange: [2022, currYear],
                format: "yyyy/mm/dd"
               // 2021-04-26 00:14:38
            });

           $("#tglijin").change(function(e){
               var tgl_ijins = $(this).val();
               $.ajax({
                type:"POST",
                url:'/panel/cekajuijin',
                data: {
                    _token : "{{csrf_token()}}",
                    tgl: tgl_ijins
                },
                cache: false,
                success: function(r){
                    if(r==1){
                        Swal.fire({
                            title: 'Error!',
                            text: 'Sudah Ada pengajuan di tgl sama',
                            icon: 'error',
                            confirmButtonText: 'Ulangi'
                        }).then((r)=>{
                            $("#tglijin").val("");
                        });
                    }
                }
               });
           });


        });


    </script>
@endpush

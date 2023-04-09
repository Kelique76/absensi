<?php

namespace App\Http\Controllers;

use App\Models\Ajuijin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MonitorCTRL extends Controller
{


    public function monitorupdateijin(Request $rek,$id)
    {
        $stts= $rek->status;
        // dd($stts);
        $updt = DB::table('ijins')->where('id',$id)->update(['status_appvl'=>$stts]);
        if($updt){
            return redirect('/panel/dataijin')->with('sukses', ' Berhasil update data');
        }else{
            return redirect('/panel/dataijin')->with('gagal', ' Gagal update data');
        }
    }

    public function monitoreditijin($id)
    {
        $ijins = DB::table('ijins')->where('id',$id)
        ->join('pegawais', 'pegawais.nik', '=', 'ijins.nik')
        ->first();
        return view('laiout.monitoring.ijinsappv', compact('ijins'));
    }
    public function monitorijin(Request $rek)
    {

        $month = date('m');

        $kueri = Ajuijin::query();
        $kueri->select('id','tgl_ijin','ijins.nik','nama_lengkap','status','keterangan','status_appvl');
        $kueri->join('pegawais', 'pegawais.nik', '=', 'ijins.nik')->whereRaw('MONTH(tgl_ijin)="' . $month . '"');
        if(!empty($rek->dari) && !empty($rek->sampai)){
            $kueri->whereBetween('tgl_ijin',[$rek->dari, $rek->sampai]);
        }
        if(!empty($rek->nik)){
            $kueri->where('pegawais.nik',$rek->nik);
        }
        if(!empty($rek->nama)){
            $kueri->where('pegawais.nama_lengkap','like','%'.$rek->nama.'%');
        }
        if(!empty($rek->status_appv)){
            $kueri->where('status_appvl',$rek->status_appv);
        }
        $kueri->orderBy('tgl_ijin','desc');
        $ijins = $kueri->get();
        // dd($ijins);
       return view('laiout.monitoring.ijins', compact( 'ijins'));
    }
    public function settingktr()
    {
        $lok = DB::table('loka')->where('id', 1)->first();
        return view('laiout.monitoring.setting', compact('lok'));
    }

    public function settingsave(Request $rek)
    {
        $lokktr = $rek->lokktr;
        $rad = $rek->rad;

        $update = DB::table('loka')->where('id', 1)->update([
            'koordinat' => $lokktr,
            'radius' => $rad
        ]);

        if ($update) {
            return Redirect::back()->with('sukses', ' Berhasil update data');
        } else {
            return Redirect::back()->with('gagal', ' Gagal update data');
        }
    }
    public function monitorlap(Request $rek)
    {
        $bln = $rek->bulan;
        $thn = $rek->tahun;
        $nk = $rek->nik;
        $peg = DB::table('pegawais')->where('nik', $nk)
            ->join('departemen', 'pegawais.kode_dep', '=', 'departemen.dept')
            ->first();
        $listbulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $absensi = DB::table('absensi')
            ->whereRaw('MONTH(tgl_absen)="' . $bln . '"')
            ->whereRaw('YEAR(tgl_absen)="' . $thn . '"')
            ->where('nik', $nk)
            ->orderBy('tgl_absen')
            ->get();
        return view('laiout.monitoring.laporan', compact('bln', 'thn', 'nk', 'listbulan', 'peg', 'absensi'));
    }

    public function monitorrekap(Request $req)
    {
        $bln = $req->bulan;
        $thn = $req->tahun;
        $rekap = DB::table('absensi')
            ->selectRaw('
        absensi.nik, nama_lengkap,
        MAX(IF(DAY(tgl_absen) = 1, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_1,
        MAX(IF(DAY(tgl_absen) = 2, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_2,
        MAX(IF(DAY(tgl_absen) = 3, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_3,
        MAX(IF(DAY(tgl_absen) = 4, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_4,
        MAX(IF(DAY(tgl_absen) = 5, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_5,
        MAX(IF(DAY(tgl_absen) = 6, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_6,
        MAX(IF(DAY(tgl_absen) = 7, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_7,
        MAX(IF(DAY(tgl_absen) = 8, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_8,
        MAX(IF(DAY(tgl_absen) = 9, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_9,
        MAX(IF(DAY(tgl_absen) = 10, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_10,
        MAX(IF(DAY(tgl_absen) = 11, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_11,
        MAX(IF(DAY(tgl_absen) = 12, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_12,
        MAX(IF(DAY(tgl_absen) = 13, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_13,
        MAX(IF(DAY(tgl_absen) = 14, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_14,
        MAX(IF(DAY(tgl_absen) = 15, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_15,
        MAX(IF(DAY(tgl_absen) = 16, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_16,
        MAX(IF(DAY(tgl_absen) = 17, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_17,
        MAX(IF(DAY(tgl_absen) = 18, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_18,
        MAX(IF(DAY(tgl_absen) = 19, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_19,
        MAX(IF(DAY(tgl_absen) = 20, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_20,
        MAX(IF(DAY(tgl_absen) = 21, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_21,
        MAX(IF(DAY(tgl_absen) = 22, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_22,
        MAX(IF(DAY(tgl_absen) = 23, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_23,
        MAX(IF(DAY(tgl_absen) = 24, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_24,
        MAX(IF(DAY(tgl_absen) = 25, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_25,
        MAX(IF(DAY(tgl_absen) = 26, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_26,
        MAX(IF(DAY(tgl_absen) = 27, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_27,
        MAX(IF(DAY(tgl_absen) = 28, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_28,
        MAX(IF(DAY(tgl_absen) = 29, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_29,
        MAX(IF(DAY(tgl_absen) = 30, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_30,
        MAX(IF(DAY(tgl_absen) = 31, CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_31
        ')
            ->join('pegawais', 'absensi.nik', '=', 'pegawais.nik')
            ->whereRaw('MONTH(tgl_absen)="' . $bln . '"')
            ->whereRaw('YEAR(tgl_absen)="' . $thn . '"')
            ->groupByRaw('absensi.nik, nama_lengkap')
            ->get();
        $listbulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('laiout.monitoring.laporans', compact('rekap', 'bln', 'thn', 'listbulan'));
    }

    public function monitorecap(Request $rek)
    {

        $listbulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('laiout.monitoring.rekapan', compact('listbulan'));
    }
    public function monitorindi()
    {

        $peg = DB::table('pegawais')->get();
        $listbulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('laiout.monitoring.individu', compact('peg', 'listbulan'));
    }
    public function lokmonitor($id)
    {

        $sio = DB::table('absensi')
            ->select('absensi.*', 'nama_lengkap')
            ->join('pegawais', 'absensi.nik', '=', 'pegawais.nik')
            ->join('departemen', 'pegawais.kode_dep', '=', 'departemen.dept')
            ->where('id', $id)->first();
        $lok = DB::table('loka')->where('id', 1)->first();
        return view('laiout.monitoring.petaabsen', compact('sio', 'lok'));
    }
    public function monitor()
    {
        return view('laiout.monitoring.apsensi',);
    }

    public function monitorab(Request $rek)
    {
        $tglnya = $rek->tgl;
        $apps = DB::table('absensi')
            ->select('absensi.*', 'nama_lengkap', 'nama_dept')
            ->join('pegawais', 'absensi.nik', '=', 'pegawais.nik')
            ->join('departemen', 'pegawais.kode_dep', '=', 'departemen.dept')
            ->where('tgl_absen', $tglnya)
            ->get();
        return view('laiout.monitoring.getpresensi', compact('apps'));
    }
}

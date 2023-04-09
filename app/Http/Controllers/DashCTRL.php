<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashCTRL extends Controller
{
    public function omahindex()
    {
        $hrini = date('Y-m-d');
        $blnini = date("m")*1;
        $thnini = date("Y");
        $nik = Auth::guard('pegawai')->user()->nik;
        $absen = DB::table('absensi')->where('nik',$nik)->where('tgl_absen', $hrini)->first();
      //  $absensi = DB::table('pegawais')->where('nik',$nik)->first();

        $sejarahAbsen = DB::table('absensi')->where('nik', $nik)->whereRaw('MONTH(tgl_absen)="'.$blnini.'"')
        ->whereRaw('YEAR(tgl_absen)="'.$thnini.'"')->orderBy('tgl_absen')->get();

       $rekapabsen = DB::table('absensi')->selectRaw('COUNT(nik) as jmlhdr, SUM(IF(jam_in > "06:00", 1,0)) as jmtlt')
       ->where('nik', $nik)
       ->whereRaw('MONTH(tgl_absen)="'.$blnini.'"')
       ->whereRaw('YEAR(tgl_absen)="'.$thnini.'"')
       ->first();
        $rekapijincuti = DB::table('ijins')->where('status','i')->where('status_appvl',1)
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_ijin)="'.$blnini.'"')
        ->whereRaw('YEAR(tgl_ijin)="'.$thnini.'"')
        ->count();
        $rekapsakit = DB::table('ijins')->where('status','s')->where('status_appvl',1)
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_ijin)="'.$blnini.'"')
        ->whereRaw('YEAR(tgl_ijin)="'.$thnini.'"')
        ->count();
       $listbulan =["","Januari","Februari", "Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
       $namabln = $listbulan[$blnini];

       $leaderboard  = DB::table('absensi')->join('pegawais','absensi.nik','=','pegawais.nik')
       ->where('tgl_absen', $hrini)->orderBy('jam_in')
       ->get();

       $jmlijin = DB::table('ijins')

       ->selectRaw('SUM(IF(status="i", 1,0)) as jijin, SUM(IF(status="s", 1,0)) as jatit')
       ->where('nik', $nik)
       ->whereRaw('MONTH(tgl_ijin)="'.$blnini.'"')
       ->whereRaw('YEAR(tgl_ijin)="'.$thnini.'"')->where('status_appvl',1)
       ->first();

        return view('dashboard.dashboard', compact('rekapsakit','rekapijincuti','jmlijin','absen','leaderboard', 'sejarahAbsen','namabln','thnini','rekapabsen'));
    }

    public function admindash()
    {
        if(Auth::guard('user')){
        return view('dashboard.dashadmin');
        }else{
            return redirect()->back()->with(['warning'=>'Anda bukan Admin']);
        }
    }
}

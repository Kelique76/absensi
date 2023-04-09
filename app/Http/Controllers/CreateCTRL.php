<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CreateCTRL extends Controller
{
    //    var $lat1 ="";
    //    var $lon1 ="";var $lat2 = "";
    //    var $lon2 = "";
    public function buat()
    {
        $harini = date('Y-m-d');
        $nik = Auth::guard('pegawai')->user()->nik;
        $cek = DB::table('absensi')->where('tgl_absen', $harini)->where('nik', $nik)->count();
        $lok = DB::table('loka')->where('id',1)->first();
        return view('presensi.create', compact('cek','lok'));
    }

    public function simpan(Request $req)
    {
        $nik = Auth::guard('pegawai')->user()->nik;
        $lok = DB::table('loka')->where('id',1)->first();
        $tgl_absen = date("Y-m-d");
        $jam = date("H:m:s");
        $lokasi = $req->lokasi;
        $radiusktr = $lok->radius;
        $splitlok = explode(',', $lokasi);
        $lokktr = explode(',', $lok->koordinat);
        $titikKTRLat = $lokktr[0];
        $titikKTRLon = $lokktr[1];
        $lat = $splitlok[0];
        $lon = $splitlok[1];
        $jarakktr = $this->distance($titikKTRLat, $titikKTRLon,  $lat, $lon);
        $radius = round($jarakktr['meters']);

        $cek = DB::table('absensi')->where('tgl_absen', $tgl_absen)->where('nik', $nik)->count();
        if ($cek > 0) {
            $ket = "out";
        } else {
            $ket = "in";
        }
        $image = $req->image;
        $tmptSimpan = "public/uploads/absensi/";
        $formatFile  = $nik . "-" . $tgl_absen . "-" . $ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $extensi = $formatFile . ".png";
        $file = $tmptSimpan . $extensi;
        $t=date('d-m-Y');

        $newDate = date('l', strtotime($t));

        if($newDate=="Saturday"||$newDate=="Sunday"){
            $radiusktr = 18000;
        }else{
            $radiusktr = $lok->radius;
        }
        if ($radius > $radiusktr) { //ini harusnya hanya beberapa meter misal 100 m
            echo "Gagal| Anda diluar Jangkauan, jarak dari kantor adalah: " . $radius . " meter |radius";
        } else {
            if ($cek > 0) {
                $datapul = [

                    'jam_out' => $jam,
                    'foto_out' => $extensi,
                    'lokasi_out' => $lokasi
                ];

                $update = DB::table('absensi')->where('tgl_absen', $tgl_absen)->where('nik', $nik)->update($datapul);

                if ($update) {
                    echo "Sukses| Terima Kasih, TTDJ|out";
                    Storage::put($file, $image_base64);
                } else {
                    echo "Gagal| Ulangi atau tanya admin|out";
                }
            } else {
                $data = [
                    'nik' => $nik,
                    'tgl_absen' => $tgl_absen,
                    'jam_in' => $jam,
                    'foto_in' => $extensi,
                    'lokasi_in' => $lokasi
                ];
                $simpan = DB::table('absensi')->insert($data);
                if ($simpan) {
                    echo "Sukses| Terima Kasih, Kerja yg Baik|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "Gagal| Ulangi atau tanya admin|in";
                }
            }
        }
    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editProfile()
    {
        $nik = Auth::guard('pegawai')->user()->nik;
        $krywn = DB::table('pegawais')->where('nik', $nik)->first();
        return view('presensi.editprof', compact('krywn'));
    }

    public function updateprofile(Request $rek, $id)
    {
        $nik = Auth::guard('pegawai')->user()->nik;
        $namanya = $rek->nama_lengkap;
        $hpnya = $rek->no_wa;
        $krywn = DB::table('pegawais')->where('nik', $nik)->first();
        $pasnya = Hash::make($rek->password);

        if ($rek->hasFile('foto')) {
            $potonya = $nik . "." . $rek->file('foto')->getClientOriginalName();
            // $tmptSimpan = "public/uploads/profile/";
            // $formatFile  = $nik . "-" . $namanya;
            // $image_parts = explode(";base64", $image);
            // $image_base64 = base64_decode($image_parts[0]);
            // $potonya = $formatFile . ".png";
            // $file = $tmptSimpan . $potonya;
        } else {
            $potonya = "";
        }


        if (empty($rek->password)) {
            $data = [
                'nama_lengkap' => $namanya,
                'no_wa' => $hpnya,
                'foto' => $potonya

            ];
        } else {
            $data = [
                'nama_lengkap' => $namanya,
                'no_wa' => $hpnya,
                'password' => $pasnya,  'foto' => $potonya
            ];
        }

        $updatan = DB::table('pegawais')->where('nik', $nik)->update($data);
        if ($updatan) {
            if ($rek->hasFile('foto')) {
                $tmptSimpan = "public/uploads/profile/";
                $rek->file('foto')->storeAs($tmptSimpan, $potonya);
            }
            return Redirect::back()->with('sukses', 'Berhasil Update Data');
        } else {
            return redirect()->back()->with('gagal', 'Tidak Berhasil Update Data');;
        }
    }

    public function history()
    {
        $blnini = date('m');
        $listbulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        // $namabln = $listbulan[$blnini];
        return view('presensi.history', compact('listbulan'));
    }

    public function gethistory(Request
    $req)
    {
        $bln = $req->bulan;
        $th = $req->tahun;
        $nik = Auth::guard('pegawai')->user()->nik;
        // echo $bln ."dan".$th;
        $cekhis = DB::table('absensi')
        ->whereRaw('MONTH(tgl_absen)="'. $bln.'"')
        ->whereRaw('YEAR(tgl_absen)="'. $th.'"')
        ->where('nik', $nik)
        ->orderBy('tgl_absen')
        ->get();
        return view('presensi.gethistory', compact('cekhis'));
       // dd($cekhis);
    }

    public function ijin()
    {  $nik = Auth::guard('pegawai')->user()->nik;
        $dtijin = DB::table('ijins')->where('nik',$nik)->get();
        return view('presensi.ajuijin', compact('dtijin'));
    }

    public function buatijin()
    {
        return view('presensi.buatijin', );
    }

    public function simpanijin(Request $req)
    {
        $tglaju = $req->tglijin;
        $stts = $req->status;
        $ket = $req->keterangan;
        $nik = Auth::guard('pegawai')->user()->nik;

        $data = [
            'nik'=> $nik,
            'tgl_ijin'=>$tglaju,
            'status'=>$stts,
            'keterangan'=>$ket

        ];

        $svijin = DB::table('ijins')->insert($data);
        if($svijin){
            return redirect('/ijin')->with('sukses', 'Berhasil Ajukan Ijin');
        }else{
            return redirect('/ijin')->with('gagal', 'Gagal Ajukan Ijin');
        }

    }
    public function monitortglijin(Request $rek)
    {
       $tgl_izin = $rek->tgl;
       $nik = Auth::guard('pegawai')->user()->nik;
       $dtijin = DB::table('ijins')->where('nik',$nik)->where('tgl_ijin',$tgl_izin)->count();
        return $dtijin;
    }
}

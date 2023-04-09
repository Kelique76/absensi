<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PegawaiCTRL extends Controller
{

    public function units()
    {


        $dep = DB::table('departemen')->get();
        return view('laiout.karyawan.unitdex', compact('dep'));
    }
    public function simpanunit(Request $rek)
    {

        try {
            $data = [
                'nama_dept' => $rek->nama,

            ];
            $sv = DB::table('departemen')->insert($data);
            if ($sv) {
                return Redirect::back()->with('sukses', ' Berhasil nambah data');
            } else {
                return redirect()->back()->with('gagal', ' Gagal nambah data');
            }
        } catch (\Exception $th) {
            return redirect()->back()->with('gagal', ' Gagal nambah data' . $th);
        }
    }
    public function delkar($nik)
    {

        $del  = DB::table('pegawais')->where('nik', $nik)->delete();
        if ($del) {
            return Redirect::back()->with('sukses', ' Berhasil hapus data');
        } else {
            return Redirect::back()->with('gagal', ' Gagal nambah data');
        }
    }

    public function delunit($dep)
    {
        $del  = DB::table('departemen')->where('dept', $dep)->delete();
        if ($del) {
            return Redirect::back()->with('sukses', ' Berhasil hapus data');
        } else {
            return Redirect::back()->with('gagal', ' Gagal nambah data');
        }
    }
    public function simpan(Request $rek)
    {

        $nama = $rek->nama;
        $nik = $rek->nik;
        $jabatan = $rek->jabatan;
        $no_wa = $rek->phone;
        $kode_dep = $rek->dept;
        $pass = Hash::make($rek->password);
        // $krywn = DB::table('pegawais')->where('nik', $nik)->first();
        $peg = new Pegawai();


        if ($rek->hasFile('foto')) {
            $potonya = $nik . "." . $rek->file('foto')->getClientOriginalName();
        } else {
            $potonya = null;
        }

        // if($validated){
        try {
            $data = [
                'nama_lengkap' => $nama,
                'jabatan' => $jabatan,
                'no_wa' => $no_wa,
                'kode_dep' => $kode_dep,
                'password' => $pass,
                'nik' => $nik,
                'foto' => $potonya,
            ];
            $save = DB::table('pegawais')->insert($data);
            if ($save) {
                if ($rek->hasFile('foto')) {
                    $tmptSimpan = "public/uploads/profile/";
                    $rek->file('foto')->storeAs($tmptSimpan, $potonya);
                }
                return Redirect::back()->with('sukses', ' Berhasil nambah data');
            } else {
                return redirect()->back()->with('gagal', ' Gagal nambah data');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('gagal', ' Gagal nambah data krn: ' . $ex->getMessage());
        }

        // }else{
        //     return redirect()->back()->with('gagal', ' Gagal ada yang kurang');
        // }

    }

    public function udetunit(Request $rk, $dep)
    {
        try {
            $data = [
                'nama_dept' => $rk->nama,

            ];
            $udt = DB::table('departemen')->where('dept', $dep)->update($data);
            if ($udt) {
                return Redirect::back()->with('sukses', ' Berhasil ubah data');
            } else {
                return redirect()->back()->with('gagal', ' Gagal ubah data');
            }
        } catch (\Exception $th) {
            return redirect()->back()->with('gagal', ' Gagal ubah data' . $th);
        }
    }

    public function updatek(Request $rek, $nik)
    {
        $nama = $rek->nama;

        $jabatan = $rek->jabatan;
        $no_wa = $rek->phone;
        $kode_dep = $rek->dept;
        $fotolama = $rek->fotolama;



        if ($rek->hasFile('foto')) {
            $potonya = $nik . "." . $rek->file('foto')->getClientOriginalName();
        } else {
            $potonya = $fotolama;
        }

        // if($validated){
        try {
            $dataup = [
                'nama_lengkap' => $nama,
                'jabatan' => $jabatan,
                'no_wa' => $no_wa,
                'kode_dep' => $kode_dep,
                'foto' => $potonya,
            ];
            $sudate = DB::table('pegawais')->where('nik', $nik)->update($dataup);
            if ($sudate) {
                if ($rek->hasFile('foto')) {

                    $tmptSimpan = "public/uploads/profile/";
                    $tmptLamaSimpan = "public/uploads/profile/" . $fotolama;
                    Storage::delete($tmptLamaSimpan);
                    $rek->file('foto')->storeAs($tmptSimpan, $potonya);
                }
                return Redirect::back()->with('sukses', ' Berhasil edit data');
            } else {
                return redirect()->back()->with('gagal', ' Gagal edit data');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('gagal', ' Gagal edit data krn: ' . $ex->getMessage());
        }
    }
    public function indexing(Request $rek)
    {
        $kueri = Pegawai::query();
        $kueri->select('pegawais.*', 'nama_dept');
        $kueri->join('departemen', 'pegawais.kode_dep', '=', 'departemen.dept');
        $kueri->orderBy('nama_lengkap');
        if (!empty($rek->nama_karyawan)) {
            $kueri->where('nama_lengkap', 'like', '%' . $rek->nama_karyawan . '%');
        }
        if (!empty($rek->kode_dept)) {
            $kueri->where('kode_dep', $rek->kode_dept);
        }
        $kar = $kueri->get();

        $dep = DB::table('departemen')->get();
        return view('laiout.karyawan.index', compact('kar', 'dep'));
    }

    public function nambah()
    {
        $dep = DB::table('departemen')->get();
        return view('laiout.karyawan.nambah', compact('dep'));
    }

    public function editk(Request $rek)
    {
        $nik = $rek->nik;
        $dep = DB::table('departemen')->get();
        $sidia = DB::table('pegawais')->where('nik', $nik)->first();
        return view('laiout.karyawan.editkar', compact('dep', 'sidia'));
    }

    public function editu(Request $rek)
    {
        $id = $rek->dep;

        $dep = DB::table('departemen')->where('dept', $id)->first();

        return view('laiout.karyawan.editunit', compact('dep'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KaryawanController extends Controller
{
    public function index()
    {
        $data['jabatan'] = DB::table('tb_jabatan')->get();
        $data['karyawan'] = DB::table('tb_user')->join('tb_jabatan','tb_jabatan.id_jabatan','tb_user.id_jabatan')->get();
        return view('karyawan.index',$data);
    }

    public function add(Request $r)
    {
        $nama = $r->nama;
        $jabatan = $r->jabatan;
        $alamat = $r->alamat;
        $notelp = $r->notelp;
        $username = $r->username;
        $password = $r->password;
        $password1 = $r->password1;
        if($password == $password1)
        {
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $save = DB::table('tb_user')->insert([
                'nama' => $nama,
                'id_jabatan' => $jabatan,
                'username' => $username,
                'password' => $pass,
                'password_ulangi' => $password,
                'alamat' => $alamat,
                'notelpon' => $notelp
            ]);

            if($save == true)
            {
                return back()->with('pesan','Success');
            }else{
                return back()->with('pesan','Error');
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JabatanController extends Controller
{
    public function index()
    {
        $data['jabatan'] = DB::table('tb_jabatan')->get();
        return view('jabatan.index',$data);
    }

    public function add(Request $r)
    {
        $id = $r->id;
        $jabatan = $r->jabatan;
        if($id == '')
        {
            $data = DB::table('tb_jabatan')->insert(['jabatan' => $jabatan]);
        }else{
            $data = DB::table('tb_jabatan')->where('id_jabatan',$id)->update(['jabatan' => $jabatan]);
        }

        if($data == true)
        {
            return back()->with('pesan','Success');
        }else{
            return back()->with('pesan','Error');
        }
    }

    public function delete($id)
    {
        $del = DB::table('tb_jabatan')->where('id_jabatan',$id)->delete();
        if($del == true)
        {
            return back()->with('pesan','Success');
        }else{
            return back()->with('pesan','Error');
        }
    }
}

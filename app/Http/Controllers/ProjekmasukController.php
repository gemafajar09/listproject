<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProjekmasukController extends Controller
{
    public function index()
    {
        $data['projek'] = DB::table('tb_project')->get();
        return view('projek_m.index',$data);
    }

    public function add(Request $r)
    {
        $id = $r->id;
        $judul = $r->judul;
        $deskripsi = $r->deskripsi;
        $tanggal_masuk = $r->tgl_masuk;
        $tanggal_dateline = $r->tgl_dateline;
        $nama_client = $r->nama_client;
        $hp_client = $r->hp_client;
        $harga = $r->harga;
        if($id == '')
        {
            $data = DB::table('tb_project')->insert([
                'judul' => $judul,
                'deskripsi' => $deskripsi,
                'tanggal_masuk' => $tanggal_masuk,
                'tanggal_dateline' => $tanggal_dateline,
                'nama_client' => $nama_client,
                'no_hp_client' => $hp_client,
                'harga' => $harga
            ]);
        }else{
            $data = DB::table('tb_project')->where('id_project',$id)->update([
                'judul' => $judul,
                'deskripsi' => $deskripsi,
                'tanggal_masuk' => $tanggal_masuk,
                'tanggal_dateline' => $tanggal_dateline,
                'nama_client' => $nama_client,
                'no_hp_client' => $hp_client,
                'harga' => $harga
            ]);
        }

        if($data == true)
        {
            return back()->with('pesan','Success');
        }else{
            return back()->with('pesan','Error');
        }
    }

    public function deleteproject($id)
    {
        $del = DB::table('tb_project')->where('id_project',$id)->delete();
        $del_all = DB::table('tb_fitur')->where('id_project',$id)->delete();

        if($del == true)
        {
            return back()->with('pesan','Success');
        }else{
            return back()->with('pesan','Error');
        }
    }

    public function detailfitur($id)
    {
        $data['detail'] = DB::table('tb_fitur')->where('id_project',$id)->get();
        return view('projek_m.table',$data);
    }

    public function simpanfitur(Request $r)
    {
        $id = $r->id;
        $fitur = $r->fitur;

        $save = DB::table('tb_fitur')->insert(['id_project' => $id, 'fitur' => $fitur]);
        echo json_encode($save);
    }

    public function deletefitur(Request $r)
    {
        $id = $r->id;
        $del = DB::table('tb_fitur')->where('id_fitur', $id)->delete();

        echo json_encode($del);
    }
}

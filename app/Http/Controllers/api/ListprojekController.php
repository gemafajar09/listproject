<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ListprojekController extends Controller
{

    public function show($id)
    {
        $res = array();
        if($id == 100)
        {
            $data = DB::table('tb_project')->get();
        }else{
            $data = DB::table('tb_project')->where('status',$id)->get();
        }
        foreach($data as $i => $a){
            if($a->status == 0){
                $status = 'Waiting';
            }elseif($a->status == 1){
                $status = 'Progres';
            }elseif($a->status == 2){
                $status = 'Finish';
            }
        
            $res[] = array(
                'id_project' => $a->id_project,
                'judul' => $a->judul,
                'deskripsi' => $a->deskripsi,
                'status' => $a->status,
                'progres' => $status,
                'tgl_masuk' => $a->tanggal_masuk,
                'tgl_dateline' => $a->tanggal_dateline,
                'nama_client' => $a->nama_client,
                'no_hp_client' => $a->no_hp_client,
                'harga' => $a->harga,
            );
        }
        
        echo json_encode($res);
    }

    public function detail($id)
    {
        $res = array();
        $data = DB::table('tb_fitur')->where('id_project',$id)->get();
        foreach($data as $f)
        {
            $res[] = array(
                'id_fitur' => $f['id_fitur'],
                'fitur' => $f['fitur'],
                'status' => $f['status']
            );
        }

        echo json_encode($res);
    }

    public function detailproject($id)
    {
        $res = array();
        $data = DB::table('tb_project')->where('id_project',$id)->get();

        foreach($data as $i => $a){
            if($a->status == 0){
                $status = 'Waiting';
            }elseif($a->status == 1){
                $status = 'Progres';
            }elseif($a->status == 2){
                $status = 'Finish';
            }
        
            $res[] = array(
                'id_project' => $a->id_project,
                'judul' => $a->judul,
                'deskripsi' => $a->deskripsi,
                'status' => $a->status,
                'progres' => $status,
                'tgl_masuk' => $a->tanggal_masuk,
                'tgl_dateline' => $a->tanggal_dateline,
                'nama_client' => $a->nama_client,
                'no_hp_client' => $a->no_hp_client,
                'harga' => $a->harga,
            );
        }
        
        echo json_encode($res);
    }

    public function userprojek($id)
    {
        $res = array();
        $data = DB::table('tb_progres')
                ->join('tb_project','tb_progres.id_project','tb_project.id_project')
                ->where('tb_progres.id_user',$id)
                ->get();
        foreach($data as $i => $a){
            if($a->status == 0){
                $status = 'Waiting';
            }elseif($a->status == 1){
                $status = 'Progres';
            }elseif($a->status == 2){
                $status = 'Finish';
            }
        
            $res[] = array(
                'id_project' => $a->id_project,
                'judul' => $a->judul,
                'deskripsi' => $a->deskripsi,
                'status' => $a->status,
                'progres' => $status,
                'tgl_masuk' => $a->tanggal_masuk,
                'tgl_dateline' => $a->tanggal_dateline,
                'nama_client' => $a->nama_client,
                'no_hp_client' => $a->no_hp_client,
                'harga' => $a->harga,
            );
        }
        
        echo json_encode($res);
    }

}

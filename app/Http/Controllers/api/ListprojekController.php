<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ListprojekController extends Controller
{

    public function proses($id)
    {
        $res = array();
        $data = DB::table('tb_progres')->join('tb_project','tb_progres.id_project','tb_project.id_project')->where('tb_progres.id_user',$id)->where('tb_project.status',1)->get();
    
        foreach($data as $i => $a){
            $jumlahfitur = DB::table('tb_fitur')->where('id_project',$a->id_project)->select(DB::raw('COUNT(*) as jumlah'))->first();
            $jumlahfiturselesai = DB::table('tb_fitur')->where('id_project',$a->id_project)->where('status',1)->select(DB::raw('COUNT(*) as selesai'))->first();
            // cari persentase
            $pecah = 100 / $jumlahfitur->jumlah;
            $rank = $pecah * $jumlahfiturselesai->selesai;
            // ===============
            $res[] = array(
                'id_project' => $a->id_project,
                'judul' => $a->judul,
                'deskripsi' => $a->deskripsi,
                'progres' => round($rank),
                'tgl_masuk' => $a->tanggal_masuk,
                'tgl_dateline' => $a->tanggal_dateline,
                'nama_client' => $a->nama_client,
                'no_hp_client' => $a->no_hp_client,
                'harga' => $a->harga,
            );
        }
        
        echo json_encode($res);
    }

    public function fiturprogres($id)
    {
        $data = DB::table('tb_fitur')->where('id_project',$id)->get();
        echo json_encode($data);
    }

    public function updetstatusfitur(Request $r)
    {
        $id = $r->id;
        $status = $r->status;
        if($status == 1)
        {
            $bool = 0;
        }else{
            $bool = 1;
        }
        $sts = DB::table('tb_fitur')->where('id_fitur',$id)->update(['status' =>$bool]);
        if($sts == true)
        {
            echo json_encode(['pesan' => 'Success']);
        }else{
            echo json_encode(['pesan' => 'Error']);
        }
    }

    // waiting
    public function waiting($id)
    {
        $res = array();
        $data = DB::table('tb_project')->where('status',$id)->get();
    
        foreach($data as $i => $a){
            $res[] = array(
                'id_project' => $a->id_project,
                'judul' => $a->judul,
                'deskripsi' => $a->deskripsi,
                'tgl_masuk' => $a->tanggal_masuk,
                'tgl_dateline' => $a->tanggal_dateline,
                'nama_client' => $a->nama_client,
                'no_hp_client' => $a->no_hp_client,
                'harga' => $a->harga,
            );
        }
        
        echo json_encode($res);
    }

    // projek finis
    public function finish($id)
    {
        $res = array();
        $data = DB::table('tb_progres')->join('tb_project','tb_progres.id_project','tb_project.id_project')->where('tb_progres.id_user',$id)->where('tb_project.status',2)->get();
    
        foreach($data as $i => $a){
            $jumlahfitur = DB::table('tb_fitur')->where('id_project',$a->id_project)->select(DB::raw('COUNT(*) as jumlah'))->first();
            $jumlahfiturselesai = DB::table('tb_fitur')->where('id_project',$a->id_project)->where('status',1)->select(DB::raw('COUNT(*) as selesai'))->first();
            // cari persentase
            $pecah = 100 / $jumlahfitur->jumlah;
            $rank = $pecah * $jumlahfiturselesai->selesai;
            // ===============
            $res[] = array(
                'id_project' => $a->id_project,
                'judul' => $a->judul,
                'deskripsi' => $a->deskripsi,
                'progres' => round($rank),
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

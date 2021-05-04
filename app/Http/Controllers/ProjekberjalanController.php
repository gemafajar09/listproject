<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProjekberjalanController extends Controller
{
    public function index()
    {
        $projek = DB::table('tb_project')->get();
        $res = array();
        foreach($projek as $i => $a)
        {
            $jumlahfitur = DB::table('tb_fitur')->where('id_project',$a->id_project)->select(DB::raw('COUNT(*) as jumlah'))->first();
            $jumlahfiturselesai = DB::table('tb_fitur')->where('id_project',$a->id_project)->where('status',1)->select(DB::raw('COUNT(*) as selesai'))->first();
            // cari persentase
            $pecah = 100 / $jumlahfitur->jumlah;
            $rank = $pecah * $jumlahfiturselesai->selesai;
            // ===============
            $res[] = array(
                'id_project' => $a->id_project,
                'judul' => $a->judul,
                'tgl_masuk' => $a->tanggal_masuk,
                'progres' => $rank,
                'status' => $a->status
            );
        }
        $data['projek'] = $res;
        return view('projek_b.index',$data);
    }

    public function timeline()
    {
        return view('projek_b.timeline');
    }
}

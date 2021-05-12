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

    public function timeline($id)
    {
        // ambil id project
        $id_project = $id;

        // AMBIL DATA USER
        $user = DB::table('tb_progres')
                ->join('tb_user','tb_user.id_user','tb_progres.id_user')
                ->where('tb_progres.id_project',$id)
                ->get();
        // ambil data timeline project
        $data = DB::table('tb_timeline')
                ->join('tb_user', 'tb_timeline.id_user', '=', 'tb_user.id_user')
                ->where('tb_timeline.id_project', '=', $id)
                ->get();
                // dd($data);
        $event = [];
        foreach($data as $i => $a){
            // buat title, backgroundColor, borderColor
            if($a->status == 0){
                $t = 'Proses - ' . $a->nama;
                $c = '#ffffff';
                $bg = 'rgb(23, 162, 184)';
                $b = 'rgb(0,204,204)';
            }elseif($a->status == 1){
                $t = 'Izin - ' . $a->nama;
                $c = '#000000';
                $bg = 'rgb(255, 193, 7)';
                $b = 'rgb(255, 193, 7)';
            }elseif($a->status == 2){
                $t = 'Stop - ' . $a->nama;
                $c = '#ffffff';
                $bg = 'rgb(220, 53, 69)';
                $b = 'rgb(220, 53, 69)';
            }elseif($a->status == 3){
                $t = 'Selesai - ' . $a->nama;
                $c = '#ffffff';
                $bg = 'rgb(40, 167, 69)';
                $b = 'rgb(40, 167, 69)';
            }

            // buat back
            $event[] = [
                "title" => $t,
                "start" => $a->tanggal,
                "color" => $c,
                "backgroundColor" => $bg,
                "borderColor" => $b,
                "allDay" => true
            ];
        }
        // dd($event);
        return view('projek_b.timeline', compact('event', 'user', 'id_project'));
    }

    public function store(Request $req)
    {
        // ambil data timeline project
        $data = DB::table('tb_timeline')
                ->join('tb_user', 'tb_timeline.id_user', '=', 'tb_user.id_user')
                ->where('tb_timeline.id_project', '=', $req->id_project)
                ->orderBy('tb_timeline.status', 'ASC')
                ->get();
                // dd($data);
        $event = [];
        foreach($data as $i => $a){
            // buat title, backgroundColor, borderColor
            if($a->status == 0){
                $t = 'Proses - ' . $a->nama;
                $c = '#ffffff';
                $bg = 'rgb(23, 162, 184)';
                $b = 'rgb(0,204,204)';
            }elseif($a->status == 1){
                $t = 'Izin - ' . $a->nama;
                $c = '#000000';
                $bg = 'rgb(255, 193, 7)';
                $b = 'rgb(255, 193, 7)';
            }elseif($a->status == 2){
                $t = 'Stop - ' . $a->nama;
                $c = '#ffffff';
                $bg = 'rgb(220, 53, 69)';
                $b = 'rgb(220, 53, 69)';
            }elseif($a->status == 3){
                $t = 'Selesai - ' . $a->nama;
                $c = '#ffffff';
                $bg = 'rgb(40, 167, 69)';
                $b = 'rgb(40, 167, 69)';
            }

            // buat back
            $event[] = [
                "title" => $t,
                "start" => $a->tanggal,
                "color" => $c,
                "backgroundColor" => $bg,
                "borderColor" => $b,
                "allDay" => true
            ];
        }

        // cari apakah status sudah ada ditanggal yg sama
        $cek = DB::table("tb_timeline")
                ->where("id_project", '=', $req->id_project)
                ->where("id_user", '=', $req->id_user)
                ->where("tanggal", '=', $req->tanggal)
                ->count();
        if($cek > 0){
            return json_encode([
                'status' => 'error',
                'data' => 'reload', 
                'event' => $event
            ]);
        }else{
            DB::table('tb_timeline')->insert([
                'id_project' => $req->id_project,
                'id_user' => $req->id_user,
                'status' => $req->status,
                'tanggal' => $req->tanggal,
            ]);
            
            return json_encode([
                'status' => 'success',
                'data' => 'sukses', 
                'event' => $event
            ]);
        }

    }
}

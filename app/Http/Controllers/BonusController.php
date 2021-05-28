<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\UserModel;

class BonusController extends Controller
{
    public function index()
    {
        $data['project'] = DB::table('tb_bonus')
                            ->select('tb_project.judul', 'tb_project.id_project', 'tb_bonus.*')
                            ->join('tb_project', 'tb_project.id_project', '=', 'tb_bonus.id_project')
                            ->get();

        return view('bonus.index', $data);
    }

    public function bonus_detail($id)
    {
        $data['detail'] = DB::table('tb_bonus_programmer')
                        ->select('tb_user.nama', 'tb_bonus.bonus_harga', 'tb_bonus_programmer.*')
                        ->join('tb_bonus', 'tb_bonus.bonus_id', '=', 'tb_bonus_programmer.bonus_id')
                        ->join('tb_user', 'tb_user.id_user', '=', 'tb_bonus_programmer.id_user')
                        ->get();
        return view('bonus.detail', $data);
    }

    public function tambah()
    {
                // cari data project yg sudah selesai
        $data['project'] = DB::table('tb_project')
                        ->where('tb_project.status', '2')
                        ->where('tb_project.status_bonus', '0')
                        ->get();

        return view('bonus.tambah', $data);
    }

    public function cari_harga(Request $req)
    {
        // cari jumlah hari dari project
        $lama = DB::table('tb_timeline')
                    ->select(DB::raw('count(*) as total'))
                    ->where('status', '0')
                    ->where('id_project', $req->id_project)
                    ->groupBy('tanggal')
                    ->get();
        $lama = count($lama);

        // cari harga project
        $harga = DB::table('tb_project')
                ->where('id_project', $req->id_project)
                ->first();

        $data = [
            'lama' => $lama,
            'harga' => $harga->harga,
        ];
        
        return json_encode([
            'status' => 'success',
            'data' => $data  
        ]);        
    }

    public function cari_programmer($id)
    {
        // gaji ambill bulan kemaren
        $b = date('m') - 1;
        if($b == 0){
            $b = 12;
        }

        // cari jumlah hari kerja programmer dan biaya operasional
        $data['programmer'] = DB::table('tb_user')
                            ->select('tb_user.id_user', 'tb_user.nama', 'tb_gaji.gaji', 'tb_gaji.hari_kerja', 'tb_gaji.tanggal_gajian', DB::raw('count(tb_timeline.timeline_id) as total'))
                            ->join('tb_gaji', 'tb_gaji.id_user', '=', 'tb_user.id_user')
                            ->join('tb_timeline', 'tb_timeline.id_user', '=', 'tb_user.id_user')
                            ->where('tb_timeline.status', '=', '0')
                            ->where('tb_timeline.id_project', '=', $id)
                            ->whereMonth('tb_gaji.tanggal_gajian', '=', $b)
                            ->whereYear('tb_gaji.tanggal_gajian', '=', date('Y'))
                            ->groupBy('tb_user.id_user')
                            ->get();

        return view('bonus.programmer', $data);
    }

    public function simpan(Request $req)
    {
        // insert ke tb_bonus
        $bonus_id = DB::table('tb_bonus')->insertGetId([
            'id_project' => $req->id_project, 
            'bonus_hari' => $req->bonus_hari, 
            'bonus_harga_project' => $req->bonus_harga_project, 
            'bonus_harga_operasional' => $req->bonus_harga_operasional, 
            'bonus_harga_bersih' => $req->bonus_harga_bersih, 
            'bonus_persen' => $req->bonus_persen, 
            'bonus_harga' => $req->bonus_harga, 
        ]);

        // insert ke tb_bonus_programmer
        foreach ($req->id_user as $no => $a) {
            DB::table('tb_bonus_programmer')->insert([
                'bonus_id' => $bonus_id, 
                'id_user' => $a, 
                'id_project' => $req->id_project, 
                'bonus_programmer_operasional' => $req->bonus_programmer_operasional[$no], 
                'bonus_programmer_lama' => $req->bonus_programmer_lama[$no], 
                'bonus_programmer_persen' => $req->bonus_programmer_persen[$no], 
                'bonus_programmer_harga' => $req->bonus_programmer_harga[$no], 
            ]);
        }

        // update di tb_project bahwa bonus sudah cair
        DB::table('tb_project')
            ->where('id_project', '=', $req->id_project)
            ->update(['status_bonus' => 1]);

        if($bonus_id == true)
        {
            return redirect()
                ->route('bonus')
                ->with('pesan', 'Data berhasil ditambahkan');
        }else{
            return back()->with('pesan','Error');
        }

    }

    public function delete(Request $req)
    {
        // update di tb_project bahwa bonus belum cair
        DB::table('tb_project')
            ->where('id_project', '=', $req->id_project)
            ->update(['status_bonus' => 0]);

        // hapus di tb_bonus
        DB::table('tb_bonus')->where('id_project', '=', $req->id_project)->delete();
        // hapus di tb_bonus_programmer
        DB::table('tb_bonus_programmer')->where('id_project', '=', $req->id_project)->delete();

        return json_encode([
            'status' => 'sukses'
        ]);
    }
}

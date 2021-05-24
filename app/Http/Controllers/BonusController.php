<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\UserModel;

class BonusController extends Controller
{
    public function index()
    {
        // cari data project yg sudah selesai
        $project = DB::table('tb_project')
                        // ->join('tb_timeline', 'tb_project.id_project', '=', 'tb_timeline.id_project')
                        ->where('tb_project.status', '3')
                        ->get();
                        

        // tampung data
        $data['project'] = [];
    
        // cari bara hari progres
        foreach($project as $no => $row){
            // ambil id project
            $id_project = $row->id_project;
            // ambil tanggal

            $tanggal = DB::table('tb_timeline')
                        ->select('tanggal')
                        ->where('status', '3')
                        ->where('id_project', $id_project)
                        ->first();
            // ambil nama project
            $nama_project = $row->judul;

            // cari jumlah hari kerja masing project
            $lama = DB::table('tb_timeline')
                        ->select(DB::raw('count(*) as total'))
                        ->where('status', '0')
                        ->where('id_project', $id_project)
                        ->groupBy('id_project')
                        ->count();
            
            $data['project'][] = [
                'tanggal' => $tanggal->tanggal,
                'judul' => $nama_project,
                'lama' => $lama
            ];
            
        }
        // dd($data['project']);
        // 

        // dd($data['project'][0]->id_project);
        // $id_project = $data['project']->id_project;

        // $data['row'] = DB::table('tb_timeline')
        //                 ->select('id_project', DB::raw('count(*) as total'))
        //                 ->where('status', '0')
        //                 ->where('id_project', $id_project)
        //                 ->groupBy('id_project')
        //                 ->get('total');
        // dd($data['row']);
        // $row = $data['row'][0]->total;
        // $timeline = [];
        // for ($i=1; $i <= $row ; $i++) { 
        //     $tanggal = DB::table('tb_timeline')
        //             ->whereMonth('tanggal', $i)
        //             ->where('id_project', 'id_poject')
        //             ->get();
        //         $timeline [] = count($tanggal);
        // }
        // $data['lamaPengerjaan'] = count($timeline); 
        // dd($data['lamaPengerjaan']);
        
        // $data['done'] = DB::table('tb_timeline')
        //                 ->where('status', '3')
        //                 ->where('id_project', $id_project)
        //                 ->get();
        // // dd($data['done']);
        
        // $data['gaji'] = DB::table('tb_gaji')
        //         ->join('tb_user', 'tb_gaji.id_user', '=', 'tb_user.id_user')
        //         ->select('tb_gaji.*', 'tb_user.nama')
        //         ->get();
        // $data['karyawan'] = UserModel::get();

        return view('bonus.index', $data);
    }
}

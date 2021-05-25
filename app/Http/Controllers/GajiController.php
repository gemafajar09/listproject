<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\UserModel;

class GajiController extends Controller
{
    public function index()
    {
        // $data['gaji'] = DB::table('tb_gaji')
        //         ->join('tb_user', 'tb_gaji.id_user', '=', 'tb_user.id_user')
        //         ->select('tb_gaji.*', 'tb_user.nama')
        //         ->get();
        $data['karyawan'] = DB::table('tb_user')
                            ->join('tb_jabatan', 'tb_user.id_jabatan', '=', 'tb_jabatan.id_jabatan')
                            ->get();

        return view('gaji.index', $data);
    }

    
    public function add(Request $r)
    {
        $id = $r->id;
        $id_user = $r->id_user;
        $gaji = $r->gaji;
        $hari_kerja = $r->hari_kerja;   
        $tanggal_gajian = $r->tanggal_gajian;
        if($id == '')
        {
            $data = DB::table('tb_gaji')->insert(
                [
                    'id_user' => $id_user,
                    'gaji' => $gaji,
                    'hari_kerja' => $hari_kerja,
                    'tanggal_gajian' => $tanggal_gajian,
                ]);
        }else{
            $data = DB::table('tb_gaji')
                    ->where('id_gaji',$id)
                    ->update(
                        [
                            'id_user' => $id_user,
                            'gaji' => $gaji,
                            'hari_kerja' => $hari_kerja,
                            'tanggal_gajian' => $tanggal_gajian
                        ]);
        }

        if($data == true)
        {
            return back()->with('pesan','Success');
        }else{
            return back()->with('pesan','Error');
        }
    }

    public function delete(Request $r)
    {
        $del = DB::table('tb_gaji')->where('id_gaji',$r->id)->delete();
        
        return json_encode([
            'status' => 'success'
        ]);
    }

    public function detail($id)
    {
        $data['detail'] = DB::table('tb_gaji')
                        ->where('id_user',$id)
                        ->orderBy('tanggal_gajian', 'DESC')
                        ->get();
        return view('gaji.table',$data);
    }

}

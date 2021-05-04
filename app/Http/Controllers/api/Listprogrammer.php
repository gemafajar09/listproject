<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class Listprogrammer extends Controller
{
    public function show()
    {
        $res = array();
        $data = DB::table('tb_user')->join('tb_jabatan','tb_jabatan.id_jabatan','tb_user.id_jabatan')->get();
        foreach ($data as $i => $a) {
            $res[] = array(
                'id_user' => $a->id_user,
                'nama' => $a->nama,
                'jabatan' => $a->jabatan,
                'foto' => 'http://192.168.1.10/listproject/public/image/'.$a->foto,
            );
        }
        
        echo json_encode($res);
    }
}

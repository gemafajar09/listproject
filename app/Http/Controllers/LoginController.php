<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'username' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'password' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/'
        );
    }

    public function index()
    {
        if(session('id_admin') != null)
        {
            return redirect('back/home')->with('pesan','Selamat Datang');
        }else{
            return view('login.index');
        }
    }

    public function login(Request $r)
    {
        $validator = Validator::make($r->all(),$this->rules);
        if($validator->fails()){
            return back()->with('error','Silahkan Login Kembali');
        }else{
            $username = $r->username;
            $password = hash("sha512", md5($r->password));
    
            $cek = DB::table('tb_admin')->where('username',$username)->where('password',$password)->first();
            if($cek == TRUE)
            {
                $r->session()->put("id_admin", $cek->id_admin);
                $r->session()->put("nama", $cek->nama);
                return redirect('back/home')->with('pesan','Selamat Datang');
            }else{
                return back()->with('error','Silahkan Login Kembali');
            }
        }
    }

    public function logout(Request $r)
    {
    	$r->session()->forget('id_admin');
        $r->session()->forget('nama');
        $r->session()->flush();
    	return redirect("/")->with('pesan', 'Success Logout.');
    }
}

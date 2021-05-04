<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;
use App\UserModel;
use Validator;
use JWTAuth;
use DB;

class ApiloginController extends Controller
{
    private $response = [
        'message' => null,
        'id_user' => null,
        'nama' => null,
        'jabatan' => null,
        'foto' => null,
    ];

    public function login(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'username' => 'required',
            'password' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = UserModel::join('tb_jabatan','tb_jabatan.id_jabatan','tb_user.id_jabatan')->where('username',$r->username)->first();
        if(!$user || ! Hash::check($r->password,$user->password)){
            $this->response = [
                'message' => 'Username dan Password salah!',
                'token' => null,
                'id_user' => null,
                'nama' => null,
                'jabatan' => null,
                'foto' => null,
            ]; 
            return response()->json($this->response,200);
        }else{
            $this->response = [
                'message' => 'Selamat Datang',
                'token' => '1',
                'id_user' => $user->id_user,
                'nama' => $user->nama,
                'jabatan' => $user->jabatan,
                'foto' => 'http://192.168.100.31/listproject/public/image/'.$user->foto
            ];
        }

        return response()->json($this->response,200);
    }

    public function loginkaryawan(Request $request)
    {
        if ($token = Auth::guard('karyawans')->attempt(["username" => $request->username, "password" => $request->password])) {
            return $this->respondWithToken($token);
        } else {
            return response()->json("Error");
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function me()
    {
        return response()->json(Auth::guard('karyawans')->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
}

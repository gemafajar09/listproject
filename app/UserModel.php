<?php

namespace App;
use Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Authenticatable;

class UserModel extends Model implements AuthenticatableContract,JWTSubject
{
    use Notifiable,Authenticatable;
    public $timestamps = false;
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user ';
    protected $fillable = [
        'nama', 'id_jabatan', 'username','password','password_ulangi','alamat','notelpon','foto'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}

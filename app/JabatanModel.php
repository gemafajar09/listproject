<?php

namespace App;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    public $timestamps = false;
    protected $table = 'tb_jabatan';
    protected $primaryKey = 'id_jabatan ';
    protected $fillable = [
        'id_jabatan', 'jabatan'
    ];
}

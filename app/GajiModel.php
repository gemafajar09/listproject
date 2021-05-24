<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GajiModel extends Model
{
    public $timestamps = false;
    protected $table = 'tb_gaji';
    protected $primaryKey = 'id_gaji ';
    protected $fillable = [
        'id_user', 
        'gaji',
        'hari_kerja',
        'tanggal_gajian'
    ];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telepon extends Model
{
    //

    protected $table = 'telepon';
    protected $primaryKey = 'id_siswa';
    protected $fillable = ['id_siswa', 'nomoe_telepon'];

    public function siswa()
    {
        # code...
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }
}

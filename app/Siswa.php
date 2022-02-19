<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    // penetapan nama tabel di model
    protected $table='siswa';

    // penambahan fillabel atau fild yang mau kita input di model
    protected $fillable =[
        'nisn',
        'nama_siswa',
        'tanggal_lahir',
        'jenis_kelamin',
        'id_kelas',
        'foto',
    ];

    protected $dates =['tanggal_lahir'];


    public function getNamaSiswaAttribute($nama_siswa)
    {
        # code...
        return ucwords($nama_siswa);
    }

    // public function setNamaSiswaAttribute($nama_siswa)
    // {
    //     # code...
    //     return strtolower($nama_siswa);
    // }

    public function telepon()
    {
        # code...
        return $this->hasOne('App\Telepon', 'id_siswa');
    }

    public function kelas()
    {
        # code...
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }

    public function hobi()
    {
        # code...
        return $this->belongsToMany('App\Hobi', 'hobi_siswa','id_siswa', 'id_hobi')->withTimeStamps();
    }

    public function getHobiSiswaAttribute()
    {
        # code...
        return $this->hobi()->pluck('id')->toArray();
    }

    public function scopeKelas($query, $id_kelas)
    {
        return $query->where('id_kelas', $id_kelas);
    }

    public function scopeJenisKelamin($query, $jenis_kelamin)
    {
        return $query->where('jenis_kelamin', $jenis_kelamin);
    }

}

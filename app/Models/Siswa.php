<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    public $primaryKey = 'nis';
    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'nis', 'nis');
    }
}

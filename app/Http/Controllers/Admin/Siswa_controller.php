<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Facades\Datatables;

use App\Models\Siswa;
use App\Models\Kelas;

class Siswa_controller extends Controller
{
    public function index()
    {
        $title = 'List semua siswa';

        return view('admin.siswa.siswa_index', compact('title'));
    }

    public function yajra()
    {
        $siswas = Siswa::select(['nis','nama']);

        return Datatables::of($siswas)->addColumn('kelas', function ($siswas) {
            return $siswas->kelas->kelas;
        })->make(true);
    }
}

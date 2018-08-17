<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Facades\Datatables;
use DB;

use App\Models\Siswa;
use App\Models\Kelas;

class Siswa_controller extends Controller
{
    public function index()
    {
        $title = 'List semua siswa';

        return view('admin.siswa.siswa_index', compact('title'));
    }

    public function yajra(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $siswas = Siswa::join('kelas','siswa.nis','=','kelas.nis')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'siswa.nis as nis',
            'siswa.nama as nama',
            'kelas.kelas as kelas'
        ]);
        $datatables = Datatables::of($siswas);

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

        return $datatables->make(true);
    }
}

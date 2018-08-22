<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Facades\Datatables;
use DB;
use Session;

use App\Models\Siswa;
use App\Models\Kelas;

class Siswa_controller extends Controller
{
    public function index()
    {
        $title = 'List semua siswa';

        return view('admin.siswa.siswa_index', compact('title'));
    }

    public function create()
    {
        $title = 'Tambah Siswa';
        $kelas = \DB::table('m_kelas')->orderBy('nama','asc')->get();

        return view('admin.siswa.siswa_create', compact('title','kelas'));
    }

    public function store(Request $request)
    {
        $nis = $request->nis;
        $nama = $request->nama;
        $tahun = $request->tahun;
        $kelas = $request->kelas;

        DB::table('siswa')->insert([
            'nis'=>$nis,
            'nama'=>$nama
        ]);

        DB::table('kelas')->insert([
            'nis'=>$nis,
            'kelas'=>$kelas,
            'tahun'=>$tahun
        ]);

        Session::flash('pesan','Siswa berhasil ditambah');

        return redirect('siswa');
    }

    public function edit($nis)
    {
        $title = 'Edit Siswa';
        $siswa = Siswa::where('nis',$nis)->first();
        $kelas = \DB::table('m_kelas')->orderBy('nama','asc')->get();
        $kelasnya = \DB::table('kelas')->where('nis',$nis)->value('kelas');
        $tahun = \DB::table('kelas')->where('nis',$nis)->value('tahun');

        return view('admin.siswa.siswa_edit',compact('title','siswa','kelas','kelasnya','tahun'));
    }

    public function update(Request $request, $nis)
    {
        $nis = $request->nis;
        $nama = $request->nama;
        $tahun = $request->tahun;
        $kelas = $request->kelas;

        DB::table('siswa')->where('nis',$nis)->update([
            'nis'=>$nis,
            'nama'=>$nama
        ]);

        DB::table('kelas')->where('nis',$nis)->update([
            'kelas'=>$kelas
        ]);

        Session::flash('pesan','Siswa berhasil diedit');

        return redirect('siswa');
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

        return $datatables->addColumn('action2', function ($siswas) {
            return '<a href="'.url('siswa/edit/'.$siswas->nis).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })->rawColumns(['action2'])->make(true);
    }
}

@extends('layouts.master')

@section('content')

<link href="https://datatables.yajrabox.com/css/datatables.bootstrap.css" rel="stylesheet">
{{-- <h1>sdffdgdfg</h1> --}}

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box">
            <a href="{{url('siswa/add')}}" class="btn btn-block btn-primary">Tambah Siswa</a>
            <table class="table table-bordered" id="table-siswa">
                <thead>
                    <tr>
                        <th></th>
                        <th>nis</th>
                        <th>nama</th>
                        <th>kelas</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
<script src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>

<script>
    $(document).ready(function(){
        var flash = "{{Session::has('pesan')}}";
        if(flash){
            var pesan = "{{Session::get('pesan')}}";
            alert(pesan);
        }

        $('#table-siswa').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('siswa/yajra') }}",
            columns: [
                {data: 'rownum', name: 'rownum'},
                {data: 'nis', name: 'nis'},
                {data: 'nama', name: 'nama'},
                {data: 'kelas', name: 'kelas.kelas'}
            ]
        });
    })
</script>

@endsection
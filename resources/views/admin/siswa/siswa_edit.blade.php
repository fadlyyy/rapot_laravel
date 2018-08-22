@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{url('siswa/edit/'.$siswa->nis)}}" method="POST">
                        {{csrf_field()}}
                        <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIS</label>
                            <input type="number" name="nis" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$siswa->nis}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">NAMA</label>
                            <input type="text" value="{{$siswa->nama}}" name="nama" class="form-control" id="exampleInputPassword1" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Pilih Kelas</label>
                            <select name="kelas" id="" class="form-control">
                                @foreach($kelas as $ks)
                                <option value="{{$ks->nama}}" {{ ($ks->nama == $kelasnya) ? 'selected' : '' }}>{{$ks->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">TAHUN</label>
                            <input type="number" value="{{$tahun}}" name="tahun" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        </div>
                        <!-- /.box-body -->
        
                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function(){
        
    });
</script>

@endsection
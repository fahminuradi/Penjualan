@extends('layouts.star')

@section('title')
Tambah Kategori
@endsection

@section('content')
<div class="col-lx-12 col-lg-12">
    @include('alert.error')
</div>
    
<div class="col-xl-12 col-lg-2 ">
  <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">
            <form class="form-horizontal" method="post" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="box-body">

                <div class="form-group">
                  <label for="Nama Kategori" class="col-sm-2 control-label">Nama Kategori</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="kategori" name="kategori">
                  </div>
                </div>


                <div class="form-group">
                  <label for="Gambar Kategori" class="col-sm-2 control-label">Gambar</label>
                  <div class="col-sm-12">
                    <input type="file" class="form-control" id="gambar" name="gambar_kategori">
                  </div>
                </div>

                </div>
                  <div class="col sm 6">
                    <div class="box-footer">
                       <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
                   </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
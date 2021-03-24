@extends('layouts.star')

@section('title')
Edit Kategori
@endsection

@section('content')
<div class="col-lx-12 col-lg-12">
  @include('alert.error')
</div>
    
<div class="col-xl-12 col-lg-2 ">
  <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">
            <form class="form-horizontal" method="post" action="{{ route('kategori.update',$kategori->kd_kategori) }}"
             enctype="multipart/form-data">
              @csrf
              {{ method_field('PUT') }}
              <div class="box-body">

                <div class="form-group">
                  <label for="Nama Kategori" class="col-sm-2 control-label">Nama Kategori</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $kategori->kategori }}">
                  </div>
                </div>


                <div class="form-group">
                  <label for="gambar_kategori" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <img class="img-thumbnail" src="{{ asset('/storage/images/kategori/'.$kategori->gambar_kategori) }}"
                     width="100px;"/>
                  </div>
                </div>

                <div class="form-group">
                  <label for="gambar_kategori" class="col-sm-2 control-label">Gambar Kategori</label>
                  <div class="col-sm-10">
                    <input type="file" id="gambar_kategori" name="gambar_kategori" class="form-control"/>
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
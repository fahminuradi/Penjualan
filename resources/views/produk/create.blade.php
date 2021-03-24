@extends('layouts.star')

@section('title')
Tambah Produk
@endsection

@section('content')
<div class="col-lx-12 col-lg-12">
    @include('alert.error')
</div>
    
<div class="col-xl-12 col-lg-2 ">
  <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">
            <form class="form-horizontal" method="post" action="{{ route('produk.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="Nama produk" class="col-sm-2 control-label">Nama Produk</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="kategori" name="nama_produk">
                  </div>
                </div>

                <div class="form-group">
                  <label for="Kategori" class="col-sm-2 control-label">Kategori Produk</label>
                  <div class="col-sm-12">
                    <select name="kd_kategori" id="kd_kategori" class="form-control">
                      @foreach($kategori as $row)
                        <option value="{{ $row->kd_kategori }}">{{ $row->kategori }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="Nama produk" class="col-sm-2 control-label">Harga</label>
                  <div class="col-sm-12">
                    <input type="number" class="form-control" id="harga" name="harga">
                  </div>
                </div>


                <div class="form-group">
                  <label for="Gambar" class="col-sm-2 control-label">Gambar</label>
                  <div class="col-sm-12">
                    <input type="file" class="form-control" id="picture" name="picture">
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
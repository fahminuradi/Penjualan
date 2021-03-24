@extends('layouts.star')

@section('title')
Edit Produk
@endsection

@section('content')
<div class="col-lx-12 col-lg-12">
    @include('sweetalert::alert')
</div>
    
<div class="col-xl-12 col-lg-2 ">
  <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">
            <form class="form-horizontal" method="post" action="{{ route('produk.update',$produk->kd_produk) }}" enctype="multipart/form-data">
              @csrf
              {{ method_field('PUT') }}
              <div class="box-body">

                <div class="form-group">
                  <label for="Nama produk" class="col-sm-2 control-label">Nama produk</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="produk" name="nama_produk" value="{{ $produk->nama_produk }}">
                  </div>
                </div>

                <div class="form-group">
                  <label for="kd_kategori" class="col-sm-2 control-label">Kategori Produk</label>
                  <div class="col-sm-10">
                    <select name="kd_kategori" id="kd_kategori" class="form-control">
                      @foreach($kategori as $row)
                        <option value="{{ $row->kd_kategori }}" @if($produk->kd_kategori == $row->kd_kategori) Selected @endif> {{ $row->kategori }} </option>
                      @endforeach
                    </select>
                  </div>
                </div>


                <div class="form-group">
                  <label for="Nama produk" class="col-sm-2 control-label">Harga</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="produk" name="harga" value="{{ $produk->harga }}">
                  </div>
                </div>


                <div class="form-group">
                  <label for="gambar_produk" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <img class="img-thumbnail" src="{{ asset('/storage/images/produk/'.$produk->gambar_produk) }}" width="100px;"/>
                  </div>
                </div>

                <div class="form-group">
                  <label for="gambar_produk" class="col-sm-2 control-label">Gambar produk</label>
                  <div class="col-sm-10">
                    <input type="file" id="gambar_produk" name="gambar_produk" class="form-control"/>
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
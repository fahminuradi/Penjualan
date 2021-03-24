@extends('layouts.star')

@section('title')
Transaksi Masuk
@endsection

@section('content')
<div class="col-lx-12 col-lg-12">
    @include('alert.error')
</div>
    
<div class="col-xl-12 col-lg-2 ">
  <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">
            <form class="form-horizontal" method="post" action="{{ route('transaksi_masuk.store') }}">
              @csrf
              <div class="box-body">

                <div class="form-group">
                  <label for="Kategori" class="col-sm-2 control-label">Produk</label>
                  <div class="col-sm-12">
                    <select name="kd_produk" id="kd_produk" class="form-control">
                      @foreach($produk as $row)
                        <option value="{{ $row->kd_produk }}">{{ $row->nama_produk }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="Kategori" class="col-sm-2 control-label">Supplier</label>
                  <div class="col-sm-12">
                    <select name="kd_supplier" id="kd_supplier" class="form-control">
                      @foreach($supplier as $row)
                        <option value="{{ $row->kd_supplier }}">{{ $row->nama_supplier }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tgl_transaksi" class="col-sm-2 control-label">Tanggal Transaksi</label>
                  <div class="col-sm-12">
                    <input type="date" class="form-control datepicker" name="tgl_transaksi" id="tgl_transaksi" value="{{ old('tgl_transaksi') }}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label for="jumlah" class="col-sm-2 control-label">Jumlah</label>
                  <div class="col-sm-12">
                    <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{ old('jumlah') }}"/>
                  </div>
                </div>

                <div class="form-group">
                  <label for="harga" class="col-sm-2 control-label">Harga</label>
                  <div class="col-sm-12">
                    <input type="number" class="form-control" name="harga" id="harga" value="{{ old('harga') }}"/>
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
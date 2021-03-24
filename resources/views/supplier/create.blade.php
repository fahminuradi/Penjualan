@extends('layouts.star')
@section('title')
Tambah Supplier
@endsection

@section('content')
<div class="col-lx-12 col-lg-12">
    @include('alert.error')
</div>
    
<div class="col-xl-12 col-lg-2 ">
  <div class="card shadow mb-12 border-left-info">
      <div class="card-body">
        <div class="box-body">
          <form class="form-horizontal" method="post" action="{{ route('supplier.store') }}">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="nama_supplier" class="col-sm-2 control-label">Nama Supplier</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="name" name="nama_supplier" value="">
                </div>
              </div>

              <div class="form-group"n>
                <label for="alamat_supplier" class="col-sm-2 control-label">alamat Supplier</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="username" name="alamat_supplier" value="">
                </div>
              </div>

              <div class="col sm 6">
                  <div class="box-footer">
                    <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
                  </div>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection
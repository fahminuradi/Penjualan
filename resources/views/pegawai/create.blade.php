@extends('layouts.star')

@section('title')
Tambah Data Pegawai
@endsection

@section('content')
<div class="col-lx-12 col-lg-12">
    @include('alert.error')
</div>
    
<div class="col-xl-12 col-lg-2 ">
  <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">
            <form class="form-horizontal" method="post" action="{{ route('pegawai.store') }}">
              @csrf
              <div class="box-body">

                <div class="form-group">
                  <label for="username" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                  </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-12">
                      <input type="password" class="form-control" id="password" name="password" value="">
                    </div>
                  </div>

                  <div class="form-group">
                      <label for="nama_pegawai" class="col-sm-2 control-label">Nama Pegawai</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" value=" {{ old('nama_pegawai') }}">
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="jk" class="col-sm-2 control-label">Jenis Kelamin</label>
                        <div class="col-sm-12">
                          <select name="jk" id="jk" class="form-control">
                            <option value="PRIA">Pria</option>
                            <option value="WANITA">Wanita</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat') }}</textarea>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="is_aktif" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-12">
                          <select name="is_aktif" id="is_aktif" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                          </select>
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
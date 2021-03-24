@extends('layouts.star')
@section('title')
Edit User
@endsection

@section('content')
<div class="col-lx-12 col-lg-12">
  @include('sweetalert::alert')
</div>
    
<div class="col-xl-12 col-lg-2">
  <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">
            <form class="form-horizontal" method="post" action="{{ route('user.update', [$user->id]) }}">
              @csrf
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                  </div>
                </div>

                <div class="form-group">
                  <label for="username" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                  </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                  </div>

                  <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" value="">
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="Level" class="col-sm-2 control-label">Level</label>
                        <div class="col-sm-10">
                          <select name="level" id="level" class="form-control">
                            <option value="admin" @if($user->level == "admin") Selected @endif >Administrator</option>
                            <option value="staff" @if($user->level == "Staff") Selected @endif >Staff</option>
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
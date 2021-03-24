@extends('layouts.star')

@section('title')
Detail User
@endsection

@section('content')

<div class="col-xl-12 col-lg-2 ">
    <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">
                <table class="table table-hover">
                <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td width="80%">{{ $user->name }}</td>
                </tr>

                <tr>
                  <td>Email</td>
                  <td>:</td>
                  <td width="80%">{{ $user->email }}</td>
                </tr>

                <tr>
                  <td>Username</td>
                  <td>:</td>
                  <td width="80%">{{ $user->username }}</td>
                </tr>

                <tr>
                  <td>Level</td>
                  <td>:</td>
                  <td width="80%">{{ $user->level }}</td>
                </tr>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
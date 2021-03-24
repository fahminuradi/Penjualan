@extends('layouts.star')
@section('title')
Data User
@endsection

@section('content')

<div class="col-lx-12 col-lg-12">
    <div class="card shadow mb-12">
        <div class="card-header border-left-info">
            @if(Request::get('keyword'))
            <a href="{{ route('user.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i></a>
            @else
            <a href="{{ route('user.create') }}" class="btn btn-info"><i class="fa fa-plus"></i></a>
            @endif

            <form method="get" action="{{route('user.index')}}"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-7 my-md-0 mw-100 navbar-search ">
                <div class="input-group">
                    <input type="text" id="keyword" name="keyword" value="{{Request::get('keyword')}}"
                        class="form-control bg-light border-0 small" placeholder="Search By User" aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="col-xl-12 col-lg-2 ">
    <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">
                @if(Request::get('keyword'))
                <div class="alert alert-success alert-block">
                    Hasil Pencarian <b>{{ Request::get('keyword') }}</b>
                </div>
                @endif

                @include('sweetalert::alert')

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $row)
                            <tr>
                                <td>{{ $loop->iteration + ($user->perpage() * ($user->currentPage() -1)) }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->username }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->level }}</td>
                                <td> 
                                    <form method="post" action="{{ route('user.destroy',[$row->id]) }}" onsubmit="return confirm('Hapus User Ini?')">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-warning" href="{{ route('user.edit',[$row->id]) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-primary" href="{{ route('user.show',[$row->id]) }}"><i class="fa fa-eye"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $user->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</div>


@endsection
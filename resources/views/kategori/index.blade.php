@extends('layouts.star')
@section('title')
Kategori
@endsection

@section('content')

<div class="col-lx-12 col-lg-12">
    <div class="card shadow mb-12">
        <div class="card-header border-left-info">
            @if(Request::get('keyword'))
            <a href="{{ route('kategori.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i></a>
            @else
            <a href="{{ route('kategori.create') }}" class="btn btn-info"><i class="fa fa-plus"></i></a>
            @endif

            <form method="get" action="{{route('kategori.index')}}"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-7 my-md-0 mw-100 navbar-search ">
                <div class="input-group">
                    <input type="text" id="keyword" name="keyword" value="{{Request::get('keyword')}}"
                        class="form-control bg-light border-0 small" placeholder="Search By kategori" aria-label="Search"
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
                            <th>Kategori</th>
                            <th>Gambar Kategori</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>    
                    <tbody>
                        @foreach ($kategori as $row)
                            <tr>
                                <td>{{ $loop->iteration + ($kategori->perpage() * ($kategori->currentPage() -1)) }}</td>
                                <td>{{ $row->kategori }}</td>
                                <td><img class="img-thumbnail" src="{{ asset('/storage/images/kategori/'.$row->gambar_kategori) }}" width="100px" /> </td>
                                <td> 
                                    <form method="post" action="{{ route('kategori.destroy', [$row->kd_kategori]) }}" 
                                    onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-warning" href="{{ route('kategori.edit',[$row->kd_kategori]) }}"><i class="fa fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $kategori->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
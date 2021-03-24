@extends('layouts.star')
@section('title')
Data Produk
@endsection

@section('content')

<div class="col-lx-12 col-lg-12">
    <div class="card shadow mb-12">
        <div class="card-header border-left-info">
            @if(Request::get('keyword'))
            <a href="{{ route('produk.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i></a>
            @elseif(Request::get('nama_kategori'))
            <a href="{{ route('produk.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i></a>
            @else
            <a href="{{ route('produk.create') }}" class="btn btn-info"><i class="fa fa-plus"></i></a>
            @endif

            <form method="get" action="{{route('produk.index')}}"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-7 my-md-0 mw-100 navbar-search ">
                <div class="input-group">
                    <input type="text" id="keyword" name="keyword" value="{{Request::get('keyword')}}"
                        class="form-control bg-light border-1" placeholder="Search By Produk" aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>


            <form method="get" action="{{route('produk.index')}}" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-7 my-md-0 mw-100 navbar-search ">
                <div class="input-group">
                    <select name="kd_kategori" id="kd_kategori"class="form-control" aria-label="Search" aria-describedby="basic-addon2">
                        <option>- Search By Kategori -</option>
                        @foreach($kategori as $row)
                            <option value="{{ $row->kd_kategori }}">{{ $row->kategori }}</option>
                        @endforeach
                    </select>
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

                @if(Request::get('kd_kategori'))
                <div class="alert alert-success alert-block">
                    Hasil Pencarian dengan kategori : <b>{{ $nama_kategori }}</b>
                </div>
                @endif

                @include('sweetalert::alert')

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Produk</th>
                            <th>Nama Kategori</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Stok</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>    
                    <tbody>
                        @foreach ($produk as $row)
                            <tr>
                                <td>{{ $loop->iteration + ($produk->perpage() * ($produk->currentPage() -1)) }}</td>
                                <td>{{ $row->nama_produk }}</td>
                                <td>{{ $row->kategori->kategori }}</td>
                                <td>Rp{{$row->harga}}</td>
                                <td><img class="img-thumbnail" src="{{ asset('/storage/images/produk/'.$row->gambar_produk) }}" width="100px" /> </td>
                                <td>{{ $row->stok }}</td>
                                <td> 
                                    <form method="post" action="{{ route('produk.destroy', [$row->kd_produk]) }}" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-warning" href="{{ route('produk.edit',[$row->kd_produk]) }}"><i class="fa fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $produk->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
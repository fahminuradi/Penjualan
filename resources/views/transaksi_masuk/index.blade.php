@extends('layouts.star')
@section('title')
Transaksi Masuk
@endsection

@section('content')

<div class="col-lx-12 col-lg-12">
    <div class="card shadow mb-12">
        <div class="card-header border-left-info">
            @if( Request::get('start_date') != "" && Request::get('end_date') != "")
            <a href="{{ route('transaksi_masuk.index') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i></a>
            @else
            <a href="{{ route('transaksi_masuk.create') }}" class="btn btn-info"><i class="fa fa-plus"></i></a>
            @endif


            <form method="get" action="{{route('transaksi_masuk.index')}}"
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-7 my-md-0 mw-100 navbar-search ">
                <div class="input-group">
                    <div class="col-lg-6">
                    <input type="date" name="start_date" value="{{Request::get('keyword')}}"
                        class="form-control datepicker" placeholder="Search By transaksi_masuk" aria-label="Search"
                        aria-describedby="basic-addon2"> -
                    </div>
                    <input type="date" name="end_date" value="{{Request::get('keyword')}}"
                        class="form-control datepicker" placeholder="Search By transaksi_masuk" aria-label="Search"
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
            @if( Request::get('start_date') != "" && Request::get('end_date') != "")
              <div class="alert alert-success alert-block">
                Hasil Pencarian Transaksi Masuk Dari Tanggal :  {{ $start_date }} s/d  {{$end_date}} 
              </div>            
            @endif

            @include('sweetalert::alert')

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Produk</th>
                            <th>Supplier</th>
                            <th>Tanggal Transaksi</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi_masuk as $row)
                            <tr>
                                <td>{{ $loop->iteration + ($transaksi_masuk->perpage() * ($transaksi_masuk->currentPage() -1)) }}</td>
                                <td>{{ $row->produk->nama_produk }}</td>
                                <td>{{ $row->supplier->nama_supplier }}</td>
                                <td>{{ $row->tgl_transaksi }}</td>
                                <td>{{ $row->jumlah }}</td>
                                <td>Rp. {{ $row->harga }}</td>
                                <td> 
                                    <form method="post"
                                        action="{{ route('transaksi_masuk.destroy',[$row->kd_transaksi_masuk]) }}"
                                        onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?')">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        <a class="btn btn-warning" href="#"><i class="fa fa-edit"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $transaksi_masuk->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</div>


@endsection
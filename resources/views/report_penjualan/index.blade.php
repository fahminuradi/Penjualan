@extends('layouts.star')
@section('title')
Report Penjualan
@endsection

@section('content')


<div class="col-lx-12 col-lg-12">
    <div class="card shadow mb-12">
        <div class="card-header border-left-info">
            <a target="_blank" href="{{ route('cetak_pdf') }}" class="btn btn-success">PDF</a>  
            <a target="_blank" href="{{ route('cetak_excel') }}" class="btn btn-danger">Excel</a>
        </div>
    </div>
</div>

<div class="col-xl-12 col-lg-2 ">
    <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">
            <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Tanggal</th>
                                <th>Agen</th>
                            </tr>
                            <tbody>
                            @foreach($penjualan as $row)
                                <tr>
                                    <td>{{ $loop->iteration + ($penjualan->perPage() * ($penjualan->currentPage() - 1 )) }}</td>
                                    <td>{{ $row->produk->nama_produk }}</td>
                                    <td>{{ $row->jumlah }}</td>
                                    <td>{{ $row->harga }}</td>
                                    <td>{{ $row->transaksi->tgl_penjualan }}</td>
                                    <td>{{ $row->transaksi->agen->nama_toko }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </thead>
                    </table>
                    {{ $penjualan->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
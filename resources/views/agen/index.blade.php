@extends('layouts.star')
@section('title')
Data Produk
@endsection

@section('content')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
            <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
<div class="col-xl-12 col-lg-2 ">
    <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">

                @include('sweetalert::alert')

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Toko</th>
                            <th>Nama Pemilik</th>
                            <th>Alamat</th>
                            <th>Lat</th>
                            <th>Long</th>
                            <th>Gambar Toko</th>
                        </tr>
                    <tbody>
                        @foreach($agen as $row)
                            <tr>
                                <td>{{ $loop->iteration + ($agen->perPage() * ($agen->currentPage() - 1 )) }}
                                </td>
                                <td>{{ $row->nama_toko }}</td>
                                <td>{{ $row->nama_pemilik }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->latitude }}</td>
                                <td>{{ $row->longitude }}</td>
                                <td><img class="img-thumbnail"
                                        src="{{ asset('/storage/images/toko/'.$row->gambar_toko) }}"
                                        width="100px" /></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </thead>
                </table>
                {{ $agen->links() }}

            </div>
        </div>
    </div>
</div>
<hr>
<div class="col-xl-12 col-lg-2 ">
    <div class="card shadow mb-12 border-left-info">
        <div class="card-body">
            <div class="box-body">
            <div id="map" style="width:100%; height:400px;"></div>
               <script>
                    var locations = <?php echo $hasil_lat_long; ?>;
                    var map = L.map('map').setView([{{ $lokasi->latitude }}, {{ $lokasi->longitude }}], 18);
                    mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
                    L.tileLayer(
                        'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; ' + mapLink + ' Contributors',
                        maxZoom: 18,
                        }).addTo(map);

                    for (var i = 0; i < locations.length; i++) {
                        marker = new L.marker([locations[i][1],locations[i][2]])
                       .bindPopup(locations[i][0])
                       .addTo(map);
                    }
               </script>
            </div>
        </div>
    </div>
</div>
@endsection
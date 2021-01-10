@extends('master.master')

@section('title')
    Hasil Cluster Obat - Admin
@endsection

@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Cluster Data Obat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Informasi Cluster Obat</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <a href="{{route('report', [$bulan, $tahun])}}">
                            <button class="btn btn-success full-right"> <li class="fa fa-download"></li> Export Data</button>
                        </a>
                    </div>
                    <div class="card-body">

                        <h3>Hasil Cluster</h3>

                        <div class="row">
                            @foreach ($hasil['cluster'] as $d)
                            <div class="col-3">
                                <h6>Cluster {{$loop->iteration}}</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($d as $cluster)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{namaObat($cluster['obat'])}}</td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                    
                            </div>
                            @endforeach
                        </div>    

                        <hr>
                        <h3>Detail Perhitungan K-Means</h3>
                        <div class="row">
                            <div class="col-12">
                                <small>
                                    Centroid Awal :
                                        <p>
                                            @foreach ($centroidawal as $k => $item)
                                            C{{$k+1}} => {{$item->stok}}, {{$item->pemakaian}} <br>
                                            @endforeach
                                        </p>
                                </small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>Stok</th>
                                            <th>Pemakaian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{namaObat($item->obat_id)}}</td>
                                            <td>{{$item->stok}}</td>
                                            <td>{{$item->pemakaian}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>



                        <div class="row">
                            @foreach ($dataperhitungan as $key => $item)
                            <div class="col-12">
                                <h5>Iterasi {{$key+1}}</h5>
                                <small>
                                    <p>
                                        Rasio Awal : {{$item['rasioawal']}} <br> Rasio : {{$item['rasio']}} <br> WCV : {{$item['wcv']}} <br> BCV : {{$item['bcv']}}
                                        <hr>
                                        Centroid Baru : <br>
                                        C1 => {{$item['c1']->stok}}, {{$item['c1']->pemakaian}} <br>
                                        C2 => {{$item['c2']->stok}}, {{$item['c2']->pemakaian}} <br>
                                        C3 => {{$item['c3']->stok}}, {{$item['c3']->pemakaian}} <br>
                                        C4 => {{$item['c4']->stok}}, {{$item['c4']->pemakaian}}
                                    </p>
                                </small>
                                <div class="row">
                                    @foreach ($item['cluster'] as $data)
                                    <div class="col-6">
                                        <h6>Cluster {{$loop->iteration}}</h6>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Obat</th>
                                                    <th>Stok</th>
                                                    <th>Pemakaian</th>
                                                    <th>Euclidean</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $cluster)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{namaObat($cluster['obat'])}}</td>
                                                    <td>{{$cluster['stok']}}</td>
                                                    <td>{{$cluster['pemakaian']}}</td>
                                                    <td>
                                                        C1 =>{{$cluster['euclidean'][0]}} <br>
                                                        C2 =>{{$cluster['euclidean'][1]}} <br>
                                                        C3 =>{{$cluster['euclidean'][2]}} <br>
                                                        C4 =>{{$cluster['euclidean'][3]}} <br>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>                                    
                                    </div>
                                    @endforeach
                                </div>
                                <hr>
                            </div>
                            @endforeach

                        </div>

                    </div>
                </div>
           </div>
        </div>
    </div>
</main>
@endsection

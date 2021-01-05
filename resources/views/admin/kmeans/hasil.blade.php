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
                        <button class="btn btn-success full-right"> <li class="fa fa-download"></li> Export Data</button>
                        {{-- <a href="{{route('obat.create')}}">
                            <i class="fas fa-table mr-1"></i>
                            Tambah Obat
                        </a> --}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($hasilKmeans as $key => $item)
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <h5>Cluster {{$key+1}}</h5>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Stok</th>
                                                <th>Pemakaian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item as $k => $data)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>
    
                                                <td>
                                                    {{namaObat($k)}}
                                                </td>
                                                
                                                <td>
                                                    {{$data[0]}}
                                                </td>

                                                <td>
                                                    {{$data[1]}}
                                                </td>

                                            </tr>
                                            @endforeach      
                                        </tbody>
                                    </table>
                                </div>
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

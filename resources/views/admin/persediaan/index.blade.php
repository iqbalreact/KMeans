@extends('master.master')

@section('title')
    Data Persediaan - Admin
@endsection

@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Data Persediaan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Informasi Daftar Persediaan</li>
        </ol>
        <div class="row">
           <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        @if (Auth::user()->role == 'admin' )
                        <a href="{{route('persediaan.create')}}">
                            <i class="fas fa-table mr-1"></i>
                            Tambah Persediaan
                        </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Stok Obat</th>
                                        <th>Pemakaian</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        @if (Auth::user()->role == 'admin')
                                        <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($persediaans as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{namaObat($item->obat_id)}}</td>
                                        <td>{{$item->stok}}</td>
                                        <td>{{$item->pemakaian}}</td>
                                        <td>{{$item->bulan}}</td>
                                        <td>{{$item->tahun}}</td>
                                        @if (Auth::user()->role == 'admin')
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('persediaan.edit', $item->id)}}" style="text-decoration: none">
                                                    <button class="btn btn-primary btn-sm">Edit</button>
                                                </a>
                                                &nbsp;
                                                <form action="{{route('persediaan.destroy', $item->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                                
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</main>
@endsection

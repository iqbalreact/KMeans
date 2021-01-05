@extends('master.master')

@section('title')
    Data Obat - Admin
@endsection

@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Data Obat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Informasi Daftar Obat</li>
        </ol>
        <div class="row">
           <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        {{-- <a href="{{route('obat.create')}}">
                            <i class="fas fa-table mr-1"></i>
                            Tambah Obat
                        </a> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        {{-- <th>Aksi</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($obats as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->nama_obat}}</td>
                                            {{-- <td>
                                                <div class="btn-group">
                                                    <a href="{{route('obat.edit', $item->id)}}" style="text-decoration: none">
                                                        <button class="btn btn-primary btn-sm">Edit</button>
                                                    </a>
                                                    &nbsp;
                                                    <form action="{{route('obat.destroy', $item->id)}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                    
                                                </div>
                                            </td> --}}
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

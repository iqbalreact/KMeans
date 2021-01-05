@extends('master.master')

@section('title')
    Edit Obat - Admin
@endsection

@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Edit Obat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Informasi Daftar Obat</li>
        </ol>
        <div class="row">
           <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Memperbaharui Data Obat
                    </div>
                    <div class="card-body">
                        <form action="{{route('obat.update', $obat->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="formGroupExampleInput">Masukan Nama Obat</label>
                                <input type="text" class="form-control" value="{{$obat->nama_obat}}" name="nama_obat" id="formGroupExampleInput" placeholder="Masukan nama obat" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Perbaharui</button>
                        </form>
                    </div>
                </div>
           </div>
        </div>
    </div>
</main>
@endsection

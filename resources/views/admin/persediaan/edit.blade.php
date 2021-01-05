@extends('master.master')

@section('title')
    Edit Persediaan - Admin
@endsection

@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Edit Persediaan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Informasi Daftar Persediaan</li>
        </ol>
        <div class="row">
           <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Memperbaharui Data Persediaan
                    </div>
                    <div class="card-body">
                        <form action="{{route('persediaan.update', $persediaans->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                              <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Obat</label>
                                <input type="text" readonly class="form-control" value="{{namaObat($persediaans->obat_id)}}" id="exampleFormControlInput1" placeholder="Stok Obat" required>
                              </div>

                              <div class="form-group">
                                <label for="exampleFormControlInput1">Periode</label>
                                <input type="text" readonly class="form-control" value="{{nameMonth($persediaans->bulan)}} - {{$persediaans->tahun}}" required>
                              </div>

                              <div class="form-group">
                                <label for="exampleFormControlInput1">Stok</label>
                                <input type="number" class="form-control" value="{{$persediaans->stok}}" name="stok" id="exampleFormControlInput1" placeholder="Stok Obat" required>
                              </div>

                              <div class="form-group">
                                <label for="exampleFormControlInput1">Pemakaian</label>
                                <input type="number" class="form-control" value="{{$persediaans->pemakaian}}" name="pemakaian" id="exampleFormControlInput1" placeholder="Pemakaian Obat" required>
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

@extends('master.master')

@section('title')
    Tambah Persediaan - Admin
@endsection

@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Tambah Persediaan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Informasi Daftar Persediaan</li>
        </ol>
        <div class="row">
           <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Menambahkan Data Persediaan
                    </div>
                    <div class="card-body">
                        <form action="{{route('persediaan.store')}}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Pilih Obat</label>
                                <select class="form-control" name="obat_id" id="exampleFormControlSelect1" required>
                                    <option value="">Pilih</option>
                                    @foreach ($obats as $item)
                                    <option value="{{$item->id}}">{{$item->nama_obat}}</option>
                                    @endforeach
                                </select>
                              </div>

                              
                              <div class="form-group">
                                <label for="exampleFormControlInput1">Periode</label>
                                <input type="month" class="form-control" name="periode" required>
                              </div>

                              <div class="form-group">
                                <label for="exampleFormControlInput1">Stok</label>
                                <input type="number" class="form-control" name="stok" id="exampleFormControlInput1" placeholder="Stok Obat" required>
                              </div>

                              <div class="form-group">
                                <label for="exampleFormControlInput1">Pemakaian</label>
                                <input type="number" class="form-control" name="pemakaian" id="exampleFormControlInput1" placeholder="Pemakaian Obat" required>
                              </div>

                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
           </div>
        </div>
    </div>
</main>
@endsection

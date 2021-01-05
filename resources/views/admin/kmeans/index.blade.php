@extends('master.master')

@section('title')
    Proses Kmeans - Admin
@endsection

@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Proses Perhitungan Kmeans</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Proses Perhitungan</li>
        </ol>
        <div class="row">
           <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Tentukan Data Perhitungan
                    </div>
                    <div class="card-body">
                        <form action="{{route('kmeans.perhitungan')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="formGroupExampleInput">Periode Data</label>
                                <input type="month" class="form-control" name="periode" id="formGroupExampleInput"  required>
                            </div>
                            {{-- <label for="formGroupExampleInput">Tentukan Centroid Awal</label>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">C1</label>
                                        <input type="number" class="form-control" name="periode" id="formGroupExampleInput"  required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">C2</label>
                                        <input type="number" class="form-control" name="periode" id="formGroupExampleInput"  required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">C3</label>
                                        <input type="number" class="form-control" name="periode" id="formGroupExampleInput"  required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">C4</label>
                                        <input type="number" class="form-control" name="periode" id="formGroupExampleInput"  required>
                                    </div>
                                </div>
                            </div> --}}
                            
                            <button type="submit" class="btn btn-primary">Proses Data</button>
                        </form>
                    </div>
                </div>
           </div>
        </div>
    </div>
</main>
@endsection

<!DOCTYPE html>
<html>
<head>
	<title>Cluster Data Obar RS. Rubini Mempawah</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <body>
    
        <div class="container">
            <center>
                <h4>Cluster Data Obat RS. Rubini Mempawah</h4>
                <h5>Bulan {{$bulan}} {{$tahun}}</h5>
            </center>
            <div class="row">
                @foreach ($hasil['cluster'] as $data)
                <div class="col-12">
                    <h6>Cluster {{$loop->iteration}}</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $cluster)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{namaObat($cluster['obat'])}}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                                    
                    <hr>
                </div>
                @endforeach
            </div>    
            <br/>
        </div>
    
    </body>
</html>
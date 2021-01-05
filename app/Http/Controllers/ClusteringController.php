<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;
use App\Models\Persediaan;


class ClusteringController extends Controller
{
    //
    public function machine()
    {
        

        $persediaans = Persediaan::all();

        $data = [];
        foreach ($persediaans as $key => $value) {
            $data[$value->obat_id] = [$value->stok, $value->pemakaian];
        }
        // return $data;
        $samples = [ 'Label1' => [1, 1], 'Label2' => [8, 7], 'Label3' => [1, 2]];
       
        $kmeans = new KMeans(4);
        $hasilKmeans = $kmeans->cluster($data);
        

    }
}

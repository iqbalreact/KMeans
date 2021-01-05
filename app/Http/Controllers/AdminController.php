<?php

namespace App\Http\Controllers;
use App\Models\Persediaan;
use App\Models\Obat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Helpers;
use Phpml\Clustering\KMeans;

class AdminController extends Controller
{
    //
    public function index() {
        # code...
        $obat = count(Obat::all());
        $persediaan = count(Persediaan::all());
        return view ('admin.dashboard.index', compact('obat', 'persediaan'));
    }

    public function prosesPage() {
        $persediaans = Persediaan::all();
        // return $persediaans;
        return view ('admin.kmeans.index', compact('persediaans'));
        // return "Hello World";
    }

    // public function Perhitungan(request $request) {
    //     # code...
    //     // $persediaans = Persediaan::all();

    //     // 4 centroid random
    //     $centroid = Persediaan::inRandomOrder()->limit(4)->get();
    //     return $centroid;


    //      //menarik data per-periode
    //     $periode = [
    //         'month' => Carbon::parse($request->periode)->translatedFormat('F'),
    //         'year'  => Carbon::parse($request->periode)->format('Y')
    //     ];

    //     $bulan = customMonth($periode['month']);
    //     $tahun = $periode['year'];
        
    //     $persediaans  = Persediaan::where('bulan', $bulan)
    //                 ->where('tahun', $tahun)
    //                 ->select('obat_id', 'stok', 'pemakaian')
    //                 ->get();

    //     $data = [];
    //     foreach ($persediaans as $key => $value) {
    //         $data[$value->obat_id] = [$value->stok, $value->pemakaian];
    //     }
    //     // return $data;
    //     $samples = [ 'Label1' => [1, 1], 'Label2' => [8, 7], 'Label3' => [1, 2]];
       
    //     $kmeans = new KMeans(4);
    //     $hasilKmeans = $kmeans->cluster($data);

    //     return view ('admin.kmeans.hasil',compact('hasilKmeans'));
        
    // }

    public function Perhitungan(request $request) {

        //menentukan jumlah cluster
        $jumlahCluster = 4;

        //menarik data per-periode
        $periode = [
            'month' => Carbon::parse($request->periode)->translatedFormat('F'),
            'year'  => Carbon::parse($request->periode)->format('Y')
        ];

        $bulan = customMonth($periode['month']);
        $tahun = $periode['year'];
        
        $data  = Persediaan::where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->select('obat_id', 'stok', 'pemakaian')
                    ->get();
        
        // centroid random 
        $c1 = $data[6];
        $c2 = $data[7];
        $c3 = $data[11];
        $c4 = $data[12];

        $centroidRandom = [$c1, $c2, $c3, $c4];

        // menghitung jarak terdekat ke pusat cluster (Euclidean)
        $edMinJarak = collect ();
        
        $ed = [];
        foreach ($data as $key => $value) {
            
            foreach ($centroidRandom as $k => $d) {
                $ed[$k][] = ($this->euclidean($d, $value->stok, $value->pemakaian));
                // return
            }
        }

        return $ed;

        // foreach ($data as $key => $value) {
        //     # code...
        //     $obat       = $value->obat_id;
        //     $stok       = $value->stok;
        //     $pemakaian  = $value->pemakaian;

        //     $edC1 = $this->euclidean($c1, $stok, $pemakaian);
        //     $edC2 = $this->euclidean($c2, $stok, $pemakaian);
        //     $edC3 = $this->euclidean($c3, $stok, $pemakaian);
        //     $edC4 = $this->euclidean($c4, $stok, $pemakaian);
            
        //     $ed = [$edC1, $edC2, $edC3, $edC4];
            
        //     $min = $this->minEd($ed);
        //     $cluster = $this->clusteringEd($min,$edC1, $edC2, $edC3, $edC4);

        //     if ($cluster == 'C1') {
        //         $clusterC1->push($ed);
        //     }

        //     if ($cluster == 'C2') {
        //         $clusterC2->push($ed);
        //     }

        //     if ($cluster == 'C3') {
        //         $clusterC3->push($ed);
        //     }

        //     if ($cluster == 'C4') {
        //         $clusterC4->push($ed);
        //     }

        //     $edMinJarak->push($min);
        // }

        // // return $clusterC1;
        // foreach ($edMinJarak as $kuadran) {
        //     $kuadranJarak = pow($kuadran, 2);
        //     $edKuadranJarak->push($kuadranJarak);
        // }
        // // wcv 
        // $edKuadranJarak = collect ();
        // $wcv = $edKuadranJarak->sum();
        // return $c1Ed;

    }

    function euclidean ($data, $stok, $pemakaian) {
        $ed = sqrt(pow($stok - $data->stok, 2) + pow($pemakaian - $data->pemakaian, 2));
        return $ed;
    }

    function minEd ($data) {
        $min = min($data);
        return $min;
    }

    function clusteringEd ($min, $edC1, $edC2, $edC3, $edC4) {
        // return $min;
        if ($min == $edC1) {
            $cluster = 'C1';
        }

        if ($min == $edC2) {
            $cluster = 'C2';
        }

        if ($min == $edC3) {
            $cluster = 'C3';
        }

        if ($min == $edC4) {
            $cluster = 'C4';
        }

        return $cluster;
    }


}

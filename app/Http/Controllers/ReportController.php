<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persediaan;
use App\Models\Obat;
use PDF;

class ReportController extends Controller
{
    //

    public function report($bulan, $tahun)
    {
        $data  = Persediaan::where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->select('obat_id', 'stok', 'pemakaian')
        // ->limit(20)
        ->get();

        $counter = 0;
        $rasioawal = 0;

        $c1 = $data[6];
        $c2 = $data[7];
        $c3 = $data[11];
        $c4 = $data[12];
        // return $c1;

        $centroidRandom = [$c1, $c2, $c3, $c4];
        $centroidawal = $centroidRandom;


        $dataperhitungan = collect();
        $clusterC1 = collect();
        $clusterC2 = collect();
        $clusterC3 = collect();
        $clusterC4 = collect();

        $ed = [];
        $edMinJarak = collect ();
        $edKuadranJarak = collect ();

        foreach ($data as $key => $value) {
            $obat       = $value->obat_id;
            $stok       = $value->stok;
            $pemakaian  = $value->pemakaian;

            // hitung jarak ke centoird awal   
            $edC1 = $this->euclidean($c1, $stok, $pemakaian);
            $edC2 = $this->euclidean($c2, $stok, $pemakaian);
            $edC3 = $this->euclidean($c3, $stok, $pemakaian);
            $edC4 = $this->euclidean($c4, $stok, $pemakaian);

            // jarak terdekat 
            $ed = [$edC1, $edC2, $edC3, $edC4];
            $min = $this->minEd($ed);

            // menentukan cluster 
            $cluster = $this->clusteringEd($min,$edC1, $edC2, $edC3, $edC4);
            if ($cluster == 'C1') {
                $clusterC1->push([
                    'obat' => $obat,
                    'stok' => $stok,
                    'pemakaian' => $pemakaian,
                    'euclidean' => $ed
                ]);
            }

            if ($cluster == 'C2') {
                $clusterC2->push([
                    'obat' => $obat,
                    'stok' => $stok,
                    'pemakaian' => $pemakaian,
                    'euclidean' => $ed
                ]);
            }

            if ($cluster == 'C3') {
                $clusterC3->push([
                    'obat' => $obat,
                    'stok' => $stok,
                    'pemakaian' => $pemakaian,
                    'euclidean' => $ed
                ]);
            }

            if ($cluster == 'C4') {
                $clusterC4->push([
                    'obat' => $obat,
                    'stok' => $stok,
                    'pemakaian' => $pemakaian,
                    'euclidean' => $ed
                ]);
            }

            $edMinJarak->push($min);

        }

        // menghitung kuadran jarak 
        foreach ($edMinJarak as $kuadran) {
            $kuadranJarak = pow($kuadran, 2);
            $edKuadranJarak->push($kuadranJarak);
        }

        $dc1c2 = $this->bcv($c1, $c2);
        $dc1c3 = $this->bcv($c1, $c3);
        $dc1c4 = $this->bcv($c1, $c4);
        $dc2c3 = $this->bcv($c2, $c3);
        $dc2c4 = $this->bcv($c2, $c4);
        $dc3c4 = $this->bcv($c3, $c4);

        $bcv = $dc1c2+$dc1c3+$dc1c4+$dc2c3+$dc2c4+$dc3c4;

        $anggotaC1 = $clusterC1;
        $anggotaC2 = $clusterC2;
        $anggotaC3 = $clusterC3;
        $anggotaC4 = $clusterC4;
        // return $anggotaC1;

        // centroid baru 
        $avgC1 = ['stok' => $clusterC1->avg('stok'), 'pemakaian' =>  $clusterC1->avg('pemakaian')];
        $avgC2 = ['stok' => $clusterC2->avg('stok'), 'pemakaian' =>  $clusterC2->avg('pemakaian')];
        $avgC3 = ['stok' => $clusterC3->avg('stok'), 'pemakaian' =>  $clusterC3->avg('pemakaian')];
        $avgC4 = ['stok' => $clusterC4->avg('stok'), 'pemakaian' =>  $clusterC4->avg('pemakaian')];
        $c1 = (object) $avgC1;
        $c2 = (object) $avgC2;
        $c3 = (object) $avgC3;
        $c4 = (object) $avgC4;

        $wcv = $edKuadranJarak->sum();

        // return $centroidRandom;
        $rasio = $bcv/$wcv;
        // $counter++;

        $dataperhitungan->push([
            'rasioawal' => $rasioawal,
            'rasio' => $rasio,
            'wcv' => $wcv,
            'bcv' => $bcv,
            'loop' => $counter,
            'c1' => $c1,
            'c2' => $c2,
            'c3' => $c3,
            'c4' => $c4,
            'cluster' => ['c1' => $anggotaC1, 'c2' => $anggotaC2,  'c3' => $anggotaC3, 'c4' => $anggotaC4]
        ]);

        // $dataperhitungan = collect();
        while ($rasio > $rasioawal) {
            // update nilai centroid
            $centroidRandom = [$c1, $c2, $c3, $c4];
            // return $centroidRandom;
            $clusterC1 = collect();
            $clusterC2 = collect();
            $clusterC3 = collect();
            $clusterC4 = collect();

            $ed = [];
            $edMinJarak = collect ();
            $edKuadranJarak = collect ();

            foreach ($data as $key => $value) {
                $obat       = $value->obat_id;
                $stok       = $value->stok;
                $pemakaian  = $value->pemakaian;

                // hitung jarak ke centoird awal   
                $edC1 = $this->euclidean($c1, $stok, $pemakaian);
                $edC2 = $this->euclidean($c2, $stok, $pemakaian);
                $edC3 = $this->euclidean($c3, $stok, $pemakaian);
                $edC4 = $this->euclidean($c4, $stok, $pemakaian);

                // jarak terdekat 
                $ed = [$edC1, $edC2, $edC3, $edC4];
                $min = $this->minEd($ed);

                // menentukan cluster 
                $cluster = $this->clusteringEd($min,$edC1, $edC2, $edC3, $edC4);
                if ($cluster == 'C1') {
                    $clusterC1->push([
                        'obat' => $obat,
                        'stok' => $stok,
                        'pemakaian' => $pemakaian,
                        'euclidean' => $ed
                    ]);
                }

                if ($cluster == 'C2') {
                    $clusterC2->push([
                        'obat' => $obat,
                        'stok' => $stok,
                        'pemakaian' => $pemakaian,
                        'euclidean' => $ed
                    ]);
                }

                if ($cluster == 'C3') {
                    $clusterC3->push([
                        'obat' => $obat,
                        'stok' => $stok,
                        'pemakaian' => $pemakaian,
                        'euclidean' => $ed
                    ]);
                }

                if ($cluster == 'C4') {
                    $clusterC4->push([
                        'obat' => $obat,
                        'stok' => $stok,
                        'pemakaian' => $pemakaian,
                        'euclidean' => $ed
                    ]);
                }

                $edMinJarak->push($min);
            }

            // menghitung kuadran jarak 
            foreach ($edMinJarak as $kuadran) {
                $kuadranJarak = pow($kuadran, 2);
                $edKuadranJarak->push($kuadranJarak);
            }

            $dc1c2 = $this->bcv($c1, $c2);
            $dc1c3 = $this->bcv($c1, $c3);
            $dc1c4 = $this->bcv($c1, $c4);
            $dc2c3 = $this->bcv($c2, $c3);
            $dc2c4 = $this->bcv($c2, $c4);
            $dc3c4 = $this->bcv($c3, $c4);

            $bcv = $dc1c2+$dc1c3+$dc1c4+$dc2c3+$dc2c4+$dc3c4;

            $anggotaC1 = $clusterC1;
            $anggotaC2 = $clusterC2;
            $anggotaC3 = $clusterC3;
            $anggotaC4 = $clusterC4;
            // return $anggotaC1;

            // centroid baru 
            $avgC1 = ['stok' => $clusterC1->avg('stok'), 'pemakaian' =>  $clusterC1->avg('pemakaian')];
            $avgC2 = ['stok' => $clusterC2->avg('stok'), 'pemakaian' =>  $clusterC2->avg('pemakaian')];
            $avgC3 = ['stok' => $clusterC3->avg('stok'), 'pemakaian' =>  $clusterC3->avg('pemakaian')];
            $avgC4 = ['stok' => $clusterC4->avg('stok'), 'pemakaian' =>  $clusterC4->avg('pemakaian')];
            $c1 = (object) $avgC1;
            $c2 = (object) $avgC2;
            $c3 = (object) $avgC3;
            $c4 = (object) $avgC4;

            $wcv = $edKuadranJarak->sum();
            $rasioawal = $rasio;
            $rasio = $bcv/$wcv;
            $counter++;

            $dataperhitungan->push([
                'cluster' => ['c1' => $anggotaC1, 'c2' => $anggotaC2,  'c3' => $anggotaC3, 'c4' => $anggotaC4]
                ]);  

        }

        $hasil = $dataperhitungan->last();

        $pdf = PDF::loadview('admin.report.index',compact('hasil', 'bulan', 'tahun'));
        return $pdf->download('obat.pdf');

        // return view ('admin.report.index', compact('hasil', 'bulan', 'tahun'));

    }

    function euclidean ($data, $stok, $pemakaian) {
        $ed = sqrt(pow($stok - $data->stok, 2) + pow($pemakaian - $data->pemakaian, 2));
        return $ed;
    }

    function bcv ($m1, $m2) {
        $c1Stok = $m1->stok;
        $c1Pemakaian = $m1->pemakaian;
        $c2Stok = $m2->stok;
        $c2Pemakaian = $m2->pemakaian;
        // return $m2->stok;
        $d = sqrt(pow($c1Stok - $c2Stok, 2) + pow($c1Pemakaian - $c2Pemakaian, 2));
        return $d;
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

<?php

use App\Models\Obat;

function namaObat($id) {
    $obat = Obat::where('id', $id)->first();
    return $obat->nama_obat;
}

function customMonth($month) {
    # code...
    $bulan = '';
    // return $month;
    switch ($month) {
        case 'January':
            # code...
            $bulan = 1;
            break;

        case 'February':
            # code...
            $bulan = 2;
            break;
        case 'March':
            # code...
            $bulan = 3;
            break;
        case 'April':
            # code...
            $bulan = 4;
            break;
        case 'May':
            # code...
            $bulan = 5;
            break;
        case 'June':
            # code...
            $bulan = 6;
            break;
        case 'July':
            # code...
            $bulan = 7;
            break;
        case 'August':
            # code...
            $bulan = 8;
            break;
        case 'September':
            # code...
            $bulan = 9;
            break;
        case 'October':
            # code...
            $bulan = 10;
            break;
        case 'November':
            # code...
            $bulan = 11;
            break;
        case 'December':
            # code...
            $bulan = 12;
            break;
        default:
            # code...
            break;
    }
    // return "Hello World";
    return $bulan;
    
}

function nameMonth($month) {
    # code...
    $bulan = '';
    switch ($month) {
        case '1':
            # code...
            $bulan = 'Januari';
            break;

        case '2':
            # code...
            $bulan = 'Februari';
            break;
        case '3':
            # code...
            $bulan = 'Maret';
            break;
        case '4':
            # code...
            $bulan = 'April';
            break;
        case '5':
            # code...
            $bulan = 'Mei';
            break;
        case '6':
            # code...
            $bulan = 'Juni';
            break;
        case '7':
            # code...
            $bulan = 'Juli';
            break;
        case '8':
            # code...
            $bulan = 'Agustus';
            break;
        case '9':
            # code...
            $bulan = 'September';
            break;
        case '10':
            # code...
            $bulan = 'Oktober';
            break;
        case '11':
            # code...
            $bulan = 'November';
            break;
        case '12':
            # code...
            $bulan = 'Desember';
            break;
        
        default:
            # code...
            break;
    }

    return $bulan;
    
}
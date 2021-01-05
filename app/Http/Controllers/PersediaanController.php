<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Persediaan;
use App\Models\Obat;
use Helpers;
use Carbon\Carbon;
// use App\Helpers;

class PersediaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $persediaans = Persediaan::all();
        return view ('admin.persediaan.index', compact('persediaans'));
        // return response($persediaans, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $obats = Obat::all();
        return view ('admin.persediaan.create', compact('obats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $periode = [
            'month' => Carbon::parse($request->periode)->translatedFormat('F'),
            'year'  => Carbon::parse($request->periode)->format('Y')
        ];
        
        

        $bulan = customMonth($periode['month']);

        $persediaans = new Persediaan;
        $persediaans->obat_id = $request->obat_id;
        $persediaans->stok = $request->stok;
        $persediaans->pemakaian = $request->pemakaian;
        $persediaans->bulan = $bulan;
        $persediaans->tahun = $periode['year'];
        $persediaans->save();

        return redirect()->route('persediaan.index');

        // return response()->json([
        //     "message" => "obat record created"
        // ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if (Persediaan::where('id', $id)->exists())
        {
            $persediaan = Persediaan::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($persediaan, 200);
        } else {
            return response()->json([
              "message" => "Persediaan not found"
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $persediaans = Persediaan::where('id', $id)->first();
        $obats = Obat::all();
        return view ('admin.persediaan.edit', compact('persediaans','obats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // return $id;
        if (Persediaan::where('id', $id)->exists()) {
            $persediaans = Persediaan::find($id);
            $persediaans->stok = is_null($request->stok) ? $persediaans->stok : $request->stok;
            $persediaans->pemakaian = is_null($request->pemakaian) ? $persediaans->pemakaian : $request->pemakaian;
            $persediaans->save();
            return redirect()->route('persediaan.index');

            // return response()->json([
            //   "message" => "records updated successfully"
            // ], 200);
        } else {
            return response()->json([
                "message" => "Persediaans not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(Persediaan::where('id', $id)->exists()) {
            $persediaans = Persediaan::find($id);
            $persediaans->delete();
            return redirect()->route('persediaan.index');
            // return response()->json([
            //   "message" => "records deleted"
            // ], 202);

        } else {

            return response()->json([
                "message" => "Obat not found"
            ], 404);

        }
    }
}

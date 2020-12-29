<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persediaan;

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
        $persediaans = Persediaan::get()->toJson(JSON_PRETTY_PRINT);
        return response($persediaans, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $persediaans = new Persediaan;
        $persediaans->obat_id = $request->obat_id;
        $persediaans->stok = $request->stok;
        $persediaans->pemakaian = $request->pemakaian;
        $persediaans->bulan = $request->bulan;
        $persediaans->tahun = $request->tahun;
        $persediaans->save();

        return response()->json([
            "message" => "obat record created"
        ], 201);
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
        if (Obat::where('id', $id)->exists()) {
            $persediaans = Obat::find($id);

            $persediaans->obat_id = is_null($request->obat_id) ? $persediaans->obat_id : $request->obat_id;
            $persediaans->stok = is_null($request->stok) ? $persediaans->stok : $request->stok;
            $persediaans->pemakaian = is_null($request->pemakaian) ? $persediaans->pemakaian : $request->pemakaian;
            $persediaans->bulan = is_null($request->bulan) ? $persediaans->bulan : $request->bulan;
            $persediaans->tahun = is_null($request->tahun) ? $persediaans->tahun : $request->tahun;
            $persediaans->save();

            return response()->json([
              "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Student not found"
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

            return response()->json([
              "message" => "records deleted"
            ], 202);

        } else {

            return response()->json([
                "message" => "Obat not found"
            ], 404);

        }
    }
}

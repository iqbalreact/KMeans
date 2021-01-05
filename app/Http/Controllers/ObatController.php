<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;


class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $obats = Obat::all();
        return view ('admin.obat.index', compact('obats'));
        // return response($obats, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view ('admin.obat.create');
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
        // return $request;
        $obat = new Obat;
        $obat->nama_obat = $request->nama_obat;
        $obat->save();

        return redirect()->route('obat.index');

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
        if (Obat::where('id', $id)->exists())
        {
            $obat = Obat::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($obat, 200);
        } else {
            return response()->json([
              "message" => "Obat not found"
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

        $obat = Obat::where('id', $id)->first();
        // return $obat;
        return view ('admin.obat.edit', compact('obat'));
        
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
        if (Obat::where('id', $id)->exists()) {
            $obat = Obat::find($id);
            $obat->nama_obat = is_null($request->nama_obat) ? $obat->nama_obat : $request->nama_obat;
            $obat->save();
            return redirect()->route('obat.index');
            // return response()->json([
            //   "message" => "records updated successfully"
            // ], 200);
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
        if(Obat::where('id', $id)->exists()) {
            $obat = Obat::find($id);
            $obat->delete();

            return redirect()->route('obat.index');
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

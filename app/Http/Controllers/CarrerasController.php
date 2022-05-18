<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carreras;

class CarrerasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = ['status' => 200,'data' => Carreras::all()];
        return response()->json(Carreras::orderBy('id', 'asc')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //valida
        $request->validate([
            'nombre' => 'required|string|unique:carreras'
        ]);

        $carrera = new Carreras();
        $carrera->nombre = $request->nombre;
        $carrera->detalle = $request->detalle;
        $carrera->save();

        // Carreras::create([
        //     'nombre' => $request->nombre
        //     , 'detalle' => $request->detalle
        // ]);

        //Carreras::created($request->all());

        return response()->json([
            'mensaje' => 'Carrera creada con exito'
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
        $carrera = Carreras::FindOrFail($id);
        $carrera->materias;
        return response()->json($carrera, 200);
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
        //valida
        $request->validate([
            'nombre' => 'required|string'
        ]);

        //Modificar
        $carrera = Carreras::FindOrFail($id);
        $carrera->nombre = $request->nombre;
        $carrera->detalle = $request->detalle;
        $carrera->save();
        //$carrera->update($id, $carrera);

        return response()->json([
            'mensaje' => 'Carrera modificada con exito'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carrera = Carreras::FindOrFail($id);
        $carrera->delete();
     
        return response()->json([
            'mensaje' => 'Carrera eliminada con exito'
        ], 200);
    }
}

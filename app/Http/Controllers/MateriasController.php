<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materias;

class MateriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materia = Materias::paginate(10);
        return response()->json($materia, 200);
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
            'nombre' => 'required|string|unique:materias'
            , 'sigla' => 'unique:materias'
            , 'carreras_id' => 'required'
        ]);

        $materia = new Materias();
        $materia->nombre = $request->nombre;
        $materia->sigla = $request->sigla;
        $materia->carreras_id = $request->carreras_id;
        $materia->save();

        return response()->json([
            'mensaje' => 'Materia creada con exito'
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
        $materia = Materias::FindOrFail($id);
        return response()->json($materia, 200);
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
            'nombre' => 'required|string|unique:materias'
            , 'sigla' => 'unique:materias,sigla,'.$id
            , 'carreras_id' => 'required'
        ]);

        $materia = Materias::FindOrFail($id);
        $materia->nombre = $request->nombre;
        $materia->sigla = $request->sigla;
        $materia->carreras_id = $request->carreras_id;
        $materia->save();

        return response()->json([
            'mensaje' => 'Materia modificada con exito'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materia = Materias::FindOrFail($id);
        $materia->delete();

        return response()->json([
            'mensaje' => 'Materia eliminada con exito'
        ], 200);
    }
}

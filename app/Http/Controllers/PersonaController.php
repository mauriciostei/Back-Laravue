<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $limite = $request->limit ? $request->limit : 10;
        //$orden = ;

        $personas = Personas::orWhere('nombres', 'like', '%'.$request->q.'%')
            ->orWhere('apellidos', 'like', '%'.$request->q.'%')
            ->orWhere('ci', 'like', '%'.$request->q.'%')
            ->orderBy($request->orderBy, 'desc')
            ->paginate($limite);

        return response()->json($personas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar
        $request->validate([
            'nombres' => 'required|string|max:30',
            'apellidos' => 'required|string|max:30',
            'ci' => 'unique:personas|max:15',

        ]);

        //Guardar
        $personas = new Personas();
        $personas->nombres = $request->nombres;
        $personas->apellidos = $request->apellidos;
        $personas->ci = $request->ci;
        $personas->direccion = $request->direccion;
        $personas->telefono = $request->telefono;
        //$personas->user_id = $request->user;
        $personas->save();


        //Responder
        return response()->json([
            'mensaje' => 'Personas Guardada',
            'error' => null,
            'status' => true
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
    }
}

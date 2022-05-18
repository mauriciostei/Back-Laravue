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
        $orden = $request->orderBy ? $request->orderBy : 'nombres';
        //$orden = ;

        $personas = Personas::orWhere('nombres', 'like', '%'.$request->q.'%')
            ->orWhere('apellidos', 'like', '%'.$request->q.'%')
            ->orWhere('ci', 'like', '%'.$request->q.'%')
            ->orderBy($orden, 'desc')
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
        $persona = Personas::find($id);
        return response()->json($persona, 200);
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
        //Validar
        $request->validate([
            'nombres' => 'required|string|max:30',
            'apellidos' => 'required|string|max:30',
            'ci' => 'max:15|unique:personas,ci,'.$id,

        ]);

        //Modificar
        $persona = Personas::FindOrFail($id);
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->ci = $request->ci;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        //$personas->user_id = $request->user;
        $persona->save();


        //Responder
        return response()->json([
            'mensaje' => 'Personas Guardada',
            'error' => null,
            'status' => true
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
        $persona = Personas::FindOrFail($id);
        $persona->delete();

        //Responder
        return response()->json([
            'mensaje' => 'Personas Eliminada',
            'error' => null,
            'status' => true
        ], 200);
    }
}

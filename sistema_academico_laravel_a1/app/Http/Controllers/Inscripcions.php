<?php

namespace App\Http\Controllers;

use App\inscripcion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Inscripcions extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inscripcion::get();//select * from alumnos
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
        $id = inscripcion::create($request->all())->id;//insert into alumno...
        return response()->json(['id'=>$id], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function show(inscripcion $inscripcion)
    {
        return $inscripcion;//select * from alumno where id = $id
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function edit(inscripcion $inscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inscripcion $inscripcion)
    {
        $inscripcion->update($request->all());//update alumno set... where id = $id
        return response()->json(['id'=>$request->id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\inscripcion  $inscripcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(inscripcion $inscripcion)
    {
        $inscripcion->delete();//delete from alumno where id = $id
        return response()->json(['id'=>$inscripcion->id], 200);
    }
}

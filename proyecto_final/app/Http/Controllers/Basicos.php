<?php

namespace App\Http\Controllers;

use App\Models\Basico;
use Illuminate\Http\Request;

class Basicos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Basico::get();//select * from alumno
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
        $id = Basico::create($request->all())->id;//insert into producto...
        return response()->json(['id'=>$id], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Basico  $basico
     * @return \Illuminate\Http\Response
     */
    public function show(Basico $basico)
    {
        return $basico;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Basico  $basico
     * @return \Illuminate\Http\Response
     */
    public function edit(Basico $basico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Basico  $basico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basico $basico)
    {
        $basico->update($request->all());//update producto set... where id = $id
        return response()->json(['id'=>$request->id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Basico  $basico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Basico $basico)
    {
        $basico->delete();//delete from comercio where id = $id
        return response()->json(['id'=>$basico->id], 200);
    }
}

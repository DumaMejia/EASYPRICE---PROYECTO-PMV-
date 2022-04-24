<?php

namespace App\Http\Controllers;

use App\Condiciones;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use CondicionesSeeder;
use Illuminate\Http\Request;

class CondicionesController extends Controller
{
    protected $redirectTo = RouteServiceProvider::GPS;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view("layouts/condiciones");
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Condiciones  $condiciones
     * @return \Illuminate\Http\Response
     */
    public function show(Condiciones $condiciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Condiciones  $condiciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Condiciones $condiciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Condiciones  $condiciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Condiciones $condiciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Condiciones  $condiciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Condiciones $condiciones)
    {
        //
    }
}

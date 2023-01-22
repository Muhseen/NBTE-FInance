<?php

namespace App\Http\Controllers;

use App\Models\NCOA;
use App\Http\Requests\StoreNCOARequest;
use App\Http\Requests\UpdateNCOARequest;

class NCOAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreNCOARequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNCOARequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NCOA  $nCOA
     * @return \Illuminate\Http\Response
     */
    public function show(NCOA $nCOA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NCOA  $nCOA
     * @return \Illuminate\Http\Response
     */
    public function edit(NCOA $nCOA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNCOARequest  $request
     * @param  \App\Models\NCOA  $nCOA
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNCOARequest $request, NCOA $nCOA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NCOA  $nCOA
     * @return \Illuminate\Http\Response
     */
    public function destroy(NCOA $nCOA)
    {
        //
    }
}
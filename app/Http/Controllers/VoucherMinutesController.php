<?php

namespace App\Http\Controllers;

use App\Models\VoucherMinutes;
use App\Http\Requests\StoreVoucherMinutesRequest;
use App\Http\Requests\UpdateVoucherMinutesRequest;

class VoucherMinutesController extends Controller
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
     * @param  \App\Http\Requests\StoreVoucherMinutesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoucherMinutesRequest $request)
    {
        $unit = auth()->user()->unit == "Expenditure Control" ? 1 : 2;
        $attributes = $request->validated() + ['user_id' => auth()->user()->id, 'unit' => $unit];
        VoucherMinutes::create($attributes);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoucherMinutes  $voucherMinutes
     * @return \Illuminate\Http\Response
     */
    public function show(VoucherMinutes $voucherMinutes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoucherMinutes  $voucherMinutes
     * @return \Illuminate\Http\Response
     */
    public function edit(VoucherMinutes $voucherMinutes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoucherMinutesRequest  $request
     * @param  \App\Models\VoucherMinutes  $voucherMinutes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherMinutesRequest $request, VoucherMinutes $voucherMinutes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoucherMinutes  $voucherMinutes
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoucherMinutes $voucherMinutes)
    {
        //
    }
}
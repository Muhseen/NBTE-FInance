<?php

namespace App\Http\Controllers;

use App\Models\FundingAccounts;
use App\Http\Requests\StoreFundingAccountsRequest;
use App\Http\Requests\UpdateFundingAccountsRequest;

class FundingAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('fundingAccounts.index')->withFa(FundingAccounts::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fundingAccounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFundingAccountsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFundingAccountsRequest $request)
    {
        FundingAccounts::create($request->validated());
        session()->flash('message', 'Successfully Added Account');
        return back();;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FundingAccounts  $fundingAccounts
     * @return \Illuminate\Http\Response
     */
    public function show(FundingAccounts $fundingAccounts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FundingAccounts  $fundingAccounts
     * @return \Illuminate\Http\Response
     */
    public function edit(FundingAccounts $fundingAccounts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFundingAccountsRequest  $request
     * @param  \App\Models\FundingAccounts  $fundingAccounts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFundingAccountsRequest $request, FundingAccounts $fundingAccounts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FundingAccounts  $fundingAccounts
     * @return \Illuminate\Http\Response
     */
    public function destroy(FundingAccounts $fundingAccounts)
    {
        //
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\VocuherCheck;
use App\Http\Requests\StoreVocuherCheckRequest;
use App\Http\Requests\UpdateVocuherCheckRequest;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherCheckController extends Controller

{
    public function reprepare($id)
    {
        $voucher = Voucher::find($id);
        $voucher->prepared_by = null;
        $voucher->prepared_date = null;
        $voucher->checked_by = null;
        $voucher->checked_date = null;
        $voucher->approved_by = null;
        $voucher->approved_date = null;
        $voucher->save();
        DB::delete('delete from voucher_checks where voucher_id = ?', [$voucher->id]);
        VocuherCheck::where('voucher_id', $voucher->id)->delete();
        session()->flash('message', 'Succesfully returned Voucher for Reprepartion');
        return redirect('/checkVoucher');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('EC.Vouchers.checkList')->withVouchers(auth()->user()->vouchers_to_check);
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
     * @param  \App\Http\Requests\StoreVocuherCheckRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['voucher_id' => 'required']);
        $voucher = Voucher::find($request->voucher_id);
        $voucher->checked_by = auth()->user()->id;
        $voucher->checked_date = today();
        $voucher->save();
        return redirect('/checkVoucher');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VocuherCheck  $vocuherCheck
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voucher = Voucher::with(['payment_approval'])->find($id);
        return view('EC.Vouchers.check')->withVoucher($voucher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VocuherCheck  $vocuherCheck
     * @return \Illuminate\Http\Response
     */
    public function edit(VocuherCheck $vocuherCheck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVocuherCheckRequest  $request
     * @param  \App\Models\VocuherCheck  $vocuherCheck
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVocuherCheckRequest $request, VocuherCheck $vocuherCheck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VocuherCheck  $vocuherCheck
     * @return \Illuminate\Http\Response
     */
    public function destroy(VocuherCheck $vocuherCheck)
    {
        //
    }
}
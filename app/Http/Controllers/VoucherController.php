<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Models\ApprovedPayment;
use App\Models\Bank;
use App\Models\NCOA;
use App\Models\User;
use App\Models\VoucherCheckLog;
use App\Models\VoucherEditLog;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('EC.Vouchers.list')->withVouchers(Voucher::latest()->paginate(10));
    }

    public function create(Request $request)
    {
        $coa = NCOA::all();
        $users = User::all();
        if ($request->filled('amount') && $request->filled('description')) {
            return view('EC.Vouchers.create')
                ->withCoa($coa)->withUsers($users)
                ->withAmount($request->amount)
                ->withDescription(
                    $request->description
                )->withPayee($request->beneficiary)
                ->withPaymentId($request->payment_id);
        }
        return view('EC.Vouchers.create')->withCoa($coa)->withUsers($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoucherRequest $request)
    {

        $code = NCOA::where('EconSegCode', $request->account_code)->first();
        $attributes = $request->validated() + ['prepared_by' => auth()->user()->id, 'description' => $code->LineItem];
        $payment_id = $request->payment_id;

        $attributes['prepared_date'] = today();
        unset($attributes["check_by"]);
        unset($attributes["payment_id"]);
        $voucher = Voucher::create($attributes);
        auth()->user()->vouchers_to_check()->attach($voucher->id);
        if ($payment_id) {
            $payment = ApprovedPayment::find($payment_id);
            $payment->status = 1;
            $payment->voucher_id = $voucher->id;
            $payment->save();
        }
        session()->flash('message', "Voucher Successfully Prepared");
        //VoucherCheckLog::create(['user_id' => $request->check_by, 'voucher_id' => $voucher->id, 'status' => 'Not Checked']);
        return redirect(route('voucher.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        return view('EC.Vouchers.show')->withVoucher($voucher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        $coa = NCOA::all();
        $users = User::all();

        return view('EC.Vouchers.edit')
            ->withVoucher($voucher)
            ->withCoa($coa)
            ->withUsers($users)
            ->withBanks(Bank::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoucherRequest  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        if ($voucher->pv_no != $request->pv_no) {
            $exists = Voucher::where('pv_no', $request->pv_no)->where('id', '<>', $voucher->id)->first();
            if ($exists) {
                return back()->withErrors('Voucher Number already taken by another voucher');
            }
        }
        $voucher->update($request->validated());
        session()->flash('message', "Voucher Succesfully updated");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
}
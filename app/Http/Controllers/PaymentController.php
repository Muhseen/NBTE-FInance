<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Carbon\Carbon;

class PaymentController extends Controller
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
    public function create(Request $request)
    {
        if ($request->has('voucher_id'))
            return view('cashOffice.makePayment')->withVoucher(Voucher::find($request->voucher_id));
        return view('cashOffice.makePayment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $voucher = Voucher::find($request->voucher_id);
        $date = Carbon::parse($request->txn_date);
        $transaction = new Transaction();
        $transaction->txn_date = $request->txn_date;
        $transaction->account_code_db = $request->account_code;
        $transaction->amount_db = $voucher->amount;
        $transaction->voucher_no = $voucher->pv_no;
        $transaction->voucher_id = $voucher->id;
        $transaction->amount_cr = $voucher->amount;
        $transaction->account_code_cr = $request->funding_account;
        $transaction->description = $voucher->detailed_description;
        $transaction->payee = $voucher->payee;
        $transaction->narration = $voucher->narration;
        $transaction->prepared_by = $voucher->prepared_by;
        $transaction->confirmed_by = $voucher->checked_by;
        $transaction->approved_by = $voucher->approved_by;
        $transaction->month = $date->month;
        $transaction->year = $date->year;
        $transaction->save();
        $voucher->status = "paid";
        $voucher->location = 'closed';
        $voucher->save();


        Payment::create($request->validated() + ['payee' => $voucher->payee ?? "Sample User"]);

        return redirect('/pendingPVLiabilities');
        dd("here", $request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentRequest  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
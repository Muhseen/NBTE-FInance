<?php

namespace App\Http\Controllers;

use App\Models\ApprovedPayment;
use App\Http\Requests\StoreApprovedPaymentRequest;
use App\Http\Requests\UpdateApprovedPaymentRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ApprovedPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'approvedPayments.index',
            [
                'payments' => ApprovedPayment::whereStatus(-1)->get(),
                'users' => User::where('unit', 'Expenditure Control')->get()
            ]
        );
    }

    public function assign(Request $request)
    {
        $request->validate(['user_id' => 'required', 'payment_id' => 'required'], ['user_id.required' => 'Please select Staff to assign voucher to for preparation']);
        $payment = ApprovedPayment::find($request->payment_id);
        $payment->assign_to = $request->user_id;
        $payment->save();
        $user = User::find($request->user_id);
        session()->flash('message', @"Payment Assigned To {$user->name}");
        return back();
    }
    public function assigned(Request $request)
    {
        return view('approvedPayments.assigned')
            ->withPayments(ApprovedPayment::where('assign_to', auth()->user()->id)->doesntHave('voucher')->get());
    }
    public function show(ApprovedPayment $approvedPayment)
    {
        //
    }

    public function edit(ApprovedPayment $approvedPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApprovedPaymentRequest  $request
     * @param  \App\Models\ApprovedPayment  $approvedPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApprovedPaymentRequest $request, ApprovedPayment $approvedPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApprovedPayment  $approvedPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApprovedPayment $approvedPayment)
    {
        //
    }
}
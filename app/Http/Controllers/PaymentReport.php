<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\NCOA;

class PaymentReport extends Controller
{
    public function generate(Request $request)
    {
        $payments = [];
        $header = "";
        if ($request->type == "name") {
            $request->validate(['payee' => 'required']);
            $payments = Payment::where('payee', 'like', '%' . $request->payee . '%')->get();
            $header = "Payments made in the name of " . $request->payee;
        } else if ($request->type == "date_range") {
            $request->validate(['start_date' => 'required', 'end_date' => 'required']);
            $endDate = Carbon::parse($request->end_date);
            $payments = Payment::whereBetween('txn_date', [$request->start_date, $endDate->endOfDay()]);
            $header =   "Payments made between " . $request->start_date . " and " . $request->end_date;
        } else if ($request->type == "reason") {
            $request->validate(['account_code' => 'required']);
            $payments = Payment::where('account_code', $request->account_code)->get();
            $code = NCOA::where('econsegcode', $request->account_code)->first();
            $header = "Payments Made in respect of " . $request->account_code . " : " . $code->LineItem;
        }
        return view('cashOffice.reports.payments')->withReport($payments)->withHeader($header);
    }
}
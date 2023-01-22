<?php

namespace App\Http\Controllers;

use App\Models\NCOA;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Payment;
use App\Models\Report;
use App\Models\HMO;
use Carbon\Carbon;

class IncomeExpenditureController extends Controller
{
    public function report(Request $request)
    {
        $request->validate(['type' => 'required']);
        $income = null;
        $payments = null;
        $headers = "";
        if ($request->type == "date_range") {
            $request->validate(['start_date' => 'required|date', 'end_date' => 'required|date']);
            $income = Income::whereBetween('txn_date', [$request->start_date, $request->end_date])->get();
            $headers = "Income Received between " . $request->start_date . " and " . $request->end_date;
        } else if ($request->type == "account_code") {
            $request->validate(['type' => 'required', 'account_code' => 'required']);
            $code = NCOA::where('econsegcode', $request->account_code)->first();
            $income = Income::where('account_code', $request->account_code)->get();
            $headers = "Income Received in respect of " . $code->EconSegCode . " : " . $code->LineItem;
        } else if ($request->type == "name") {
            $request->validate(['type' => 'required', 'name' => 'required']);
            $income = Income::where('payer', 'like', '%' . $request->name . '%')->get();
            $headers = "Income Received in the name of  " . $request->name;
        }

        return view('income.reports')->withIncome($income)->withHeaders($headers);
    }

    public function incomeExpenditureReport(Request $request)
    {
        $request->validate(['start_date' => 'required', 'end_date' => 'required']);
        $income = Income::whereBetween('txn_date', [$request->start_date, $request->end_date])->get();
        $expenditure = Payment::whereBetween('txn_date', [$request->start_date, $request->end_date])->get();

        return view('cashOffice.reports.incomeAndExpenditure')
            ->withIncome($income->groupBy('account_code'))
            ->withExp($expenditure->groupBy('reason'))
            ->withStartDate(Carbon::parse($request->start_date)->toDayDateTimeString())
            ->withEndDate(Carbon::parse($request->end_date)->endOfDay()->toDayDateTimeString());
    }
}
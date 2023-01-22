<?php

namespace App\Http\Controllers;

use App\Models\NCOA;
use App\Models\FundingAccounts;
use App\Models\HMO;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Transaction;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Payments;
use Carbon\Carbon;

class IncomeController extends Controller
{
    public function index()
    {
        return view('income.index')->withCoa(NCOA::all())->withFundingAccounts(FundingAccounts::all());
    }
    public function process(Request $request)
    {
        $attr = $request->validate(['narration' => 'nullable', 'paid_into' => 'required', 'amount' => 'required', 'txn_date' => 'required', 'account_code' => 'required', 'payer' => 'required']);
        //dd($attr);
        Income::create($request->only(['narration', 'paid_into', 'amount', 'txn_date', 'account_code', 'payer']));
        $id = uniqid();
        $date = Carbon::parse($request->txn_date);
        $t = new Transaction();
        $t->month = $date->month;
        $t->year = $date->year;
        $t->txn_date = $request->txn_date;
        $t->account_code_db = $request->paid_into;
        $t->amount_db = $request->amount;
        $t->amount_cr = $request->amount;
        $t->voucher_id = -2;

        $t->account_code_cr = $request->account_code;
        $t->description = $request->description;
        $t->narration = $request->narration;
        $t->payer = $request->payer;
        $t->voucher_no = uniqid();
        $t->transaction_id = uniqid();
        $t->save();
        session()->flash('mesage', "Transaction Successfully Captured");
        /*$acc = FundingAccounts::where('account_code', $request->paid_into)->first();
        $acc->balance += $request->amount;
        $acc->save();*/
        session()->flash('message', "Income Successfully captured");
        return back();
    }
    public function IncomeReport(Request $request)
    {
    }
}
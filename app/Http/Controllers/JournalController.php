<?php

namespace App\Http\Controllers;

use App\Models\NCOA;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaction;

class JournalController extends Controller
{
    public function index()
    {
        return view('journal.index')->withCoas(NCOA::all());
    }
    public function process(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'sjvNo' => 'required',
            'narration' => 'required'
        ]);
        $creditItems = $request->creditItems;
        $debitItems = $request->debitItems;
        $date = Carbon::parse($request->date);
        foreach ($creditItems as $item) {
            $deets = explode("*", $item);
            $t = new Transaction();
            $t->month = $date->month;
            $t->year = $date->year;
            $t->voucher_id = -3;
            $t->txn_date = $request->date;
            $t->voucher_no = $request->sjvNo;
            $t->account_code_cr = $deets[0];
            $t->amount_cr = $deets[1];
            $t->narration = $request->narration;
            $t->save();
        }
        foreach ($debitItems as $item) {
            $deets = explode("*", $item);
            $t = new Transaction();
            $t->month = $date->month;
            $t->year = $date->year;
            $t->voucher_id = -3;

            $t->txn_date = $request->date;
            $t->voucher_no = $request->sjvNo;
            $t->account_code_db = $deets[0];
            $t->amount_db = $deets[1];
            $t->narration = $request->narration;
            $t->save();
        }
        session()->flash('message', 'Successfully captured Transaction');

        return back();
    }
}
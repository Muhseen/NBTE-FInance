<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SJVController extends Controller
{


    public function process(Request $request)
    {

        $code = $request->account_code;
        $col = substr($code, 0, 1) == "1" || substr($code, 0, 1) == "3" ? "account_code_cr" : "account_code_db";

        $transactions = Transaction::with(['cr_code', 'db_code'])
            ->whereBetween('txn_date', [$request->start_date, $request->end_date])
            ->where($col, $request->account_code)->get();

        //dd($transactions);
        $debits = $transactions->groupBy('account_code_db');
        $credits = $transactions->groupBy('account_code_cr');
        //dd($debits, $credits);
        $report = collect();
        $counter = 1;
        foreach ($debits as $d) {
            $row = new Report();
            $row->description = $d->first()->db_code->LineItem ?? $d->first()->narration;
            $row->code = $d->first()->account_code_db;
            $row->amount_db = $d->sum('amount_db');
            $row->amount_cr = 0;
            $report->put($counter, $row);
            $counter++;
        }
        foreach ($credits as $c) {
            $row = new Report();
            $row->description = $c->first()->cr_code->LineItem ?? $c->first()->narration;
            $row->code = $c->first()->account_code_cr;
            $row->amount_cr = $c->sum('amount_cr');
            $row->amount_db = 0;
            $report->put($counter, $row);
            $counter++;
        }

        return view('cashoffice.reports.sjv')->withReports($report)->withMonth("November")->withYear("2022")->withCode("12345678")->withDesc("Sample Decsription");
    }
}
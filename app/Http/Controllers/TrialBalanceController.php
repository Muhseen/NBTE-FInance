<?php

namespace App\Http\Controllers;

use App\Models\NCOA;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TrialBalanceController extends Controller
{
    public function process(Request $request)
    {
        //$request->validate(['start_date' => 'required', 'end_date' => 'required']);
        $start_date = Carbon::now()->startOfYear()->toDateTimeString();
        $end_date = Carbon::now()->endOfYear()->toDateTimeString();
        //$request->validate(['start_date' => 'required', 'end_date' => 'required']);
        $query = Transaction::all(); //whereBetween('txn_date', [$start_date, $end_date])->get();
        $income = $query->where('account_code_cr', 'like', '1%');
        $exp = $query->where('account_code_db', 'like', '2%');
        $assets = $query->where('account_code_cr', 'like', '3%');
        $Liab = $query->where('account_code_db', 'like', '4%');
        //dd($assets, $exp, $Liab, $exp);
        //dd($query->sum('amount_cr'), $query->sum('amount_db'));
        $codes =        array_merge($query->pluck('account_code_cr')->toArray(), $query->pluck('account_code_db')->toArray());
        $codes = array_unique($codes);
        sort($codes);
        $tr = "";
        $totDr = 0;
        $totCr = 0;
        foreach ($codes as $code) {
            $sumCr = 0;
            $sumDr = 0;
            $sumCr = $query->where('account_code_cr', $code)->sum('amount_cr');
            $sumDr = $query->where('account_code_db', $code)->sum('amount_db');
            $row = NCOA::where('EconSegCode', $code)->first(); //$query->where('account_code_db', $code)->first();



            //dd($row);
            Log::info($code);
            if ($sumCr > $sumDr) {
                $tr .= "<tr><td>" . $code . " : " . ($row?->LineItem) . "</td><td>--------</td><td>" . Str::currency($sumCr - $sumDr) . "</td></tr>";
                $totCr += ($sumCr - $sumDr);
            } else if ($sumDr > $sumCr) {
                $tr .= "<tr><td>" . $code . " : " . ($row?->LineItem) . "</td><td>" . Str::currency($sumDr - $sumCr) . "</td><td>--------</td></tr>";
                $totDr += ($sumDr - $sumCr);
            }
        }
        return view('cashoffice.reports.trialbalance')->withTr($tr)->withTots([$totCr, $totDr]);
    }
}
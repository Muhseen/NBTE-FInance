<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrialBalanceController extends Controller
{
    public function process(Request $request)
    {
        //$request->validate(['start_date' => 'required', 'end_date' => 'required']);
        $start_date = Carbon::now()->startOfYear()->toDateTimeString();
        $end_date = Carbon::now()->endOfYear()->toDateTimeString();
        $query = Transaction::whereBetween('txn_date', [$start_date, $end_date]);
        $income = $query->where('account_code_cr', 'like', '1%')->get();
        $exp = $query->where('account_code_db', 'like', '2%')->get();
        $assets = $query->where('account_code_cr', 'like', '3%')->get();
        $Liab = $query->where('account_code_db', 'like', '4%')->get();
        dd($assets, $exp, $Liab, $exp);

        $table = "<table class='table table-striped table-bordered table'> ";
        foreach ($income->groupBy('account_code_cr') as $i) {
            $table .= "<tr> <td>" . $i->first()->account_code_cr . "</td><td>" . $i->first()->cr_code?->description ?? "N/A" . "</td><td>--------</td><td>" . Str::currency($i->sum('amount_cr')) . "</td></tr>";
        }
        foreach ($exp->groupBy('account_code_db') as $i) {
            $table .= "<tr> <td>" . $i->first()->account_code_db . "</td><td>" . $i->first()->cr_code->description . "</td><td>--------</td><td>" . Str::currency($i->sum('amount_db')) . "</td></tr>";
        }
        foreach ($assets->groupBy('account_code_cr') as $i) {
            $table .= "<tr> <td>" . $i->first()->account_code_cr . "</td><td>" . $i->first()->cr_code->description . "</td><td>--------</td><td>" . Str::currency($i->sum('amount_cr')) . "</td></tr>";
        }
        foreach ($Liab->groupBy('account_code_db') as $i) {
            $table .= "<tr> <td>" . $i->first()->account_code_db . "</td><td>" . $i->first()->cr_code->description . "</td><td>--------</td><td>" . Str::currency($i->sum('amount_db')) . "</td></tr>";
        }
        $table .= "</table>";
        return view('cashoffice.reports.trialbalance')->withTable($table);
    }
}
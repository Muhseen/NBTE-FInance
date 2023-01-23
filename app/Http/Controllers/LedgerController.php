<?php

namespace App\Http\Controllers;

use App\Models\NCOA;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Transaction;

class LedgerController extends Controller
{
    public function ledger(Request $request)
    {
        $request->validate(['account_code' => 'required']);
        $debits = Transaction::where('account_code_db', $request->account_code)->get();
        $credits = Transaction::where('account_code_cr', $request->account_code)->get();
        $report = collect();
        $counter = 1;
        foreach ($debits as $charge) {
            $rRow = new Report();
            $rRow->id = $charge->id;
            $rRow->txn_date = $charge->txn_date;
            $rRow->reg_no = $charge->reg_no;
            $rRow->name = $charge->payee;
            $rRow->description = $charge->description;
            $rRow->amount_db = $charge->amount_db;
            $rRow->amount_cr = 0;
            $rRow->narration = $charge->narration;
            $report->put($counter, $rRow);

            $counter++;
        }
        foreach ($credits as $payment) {
            $rRow = new Report();
            $rRow->narration = $payment->narration;
            $rRow->id = $payment->id;
            $rRow->txn_date = $payment->txn_date;
            $rRow->name = $payment->payee;
            $rRow->description = $payment->description;
            $rRow->amount_cr = $payment->amount_cr;
            $rRow->amount_db = 0;
            $report->put($counter, $rRow);
            $counter++;
        }
        $report = $report->sortBy('txn_date');
        // dd($report);
        $code = NCOA::where('EconSegCode', $request->account_code)->first();
        return view('cashOffice.reports.ledger')->withCode($code)->withReport($report);
    }
    public function generalLedger(Request $request)
    {


        $html = "";
        //$request->validate(['start_date' => 'required', 'end_date' => 'required']);
        $vouchers = Transaction::orderBy('year', 'ASC')->get(); //whereBetween('txn_date', [$request->start_date, $request->end_date])->get();
        //  dd($vouchers);
        $vouchersByAccountCode = $vouchers->groupBy('account_code_db');
        //dd($vouchersByAccountCode);
        $headerColspan = 7;
        $monthsArray = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $query = Transaction::all(); //whereBetween('txn_date', [$start_date, $end_date])->get();
        $codes =        array_merge($query->pluck('account_code_cr')->toArray(), $query->pluck('account_code_db')->toArray());
        $codes = array_unique($codes);
        sort($codes);
        ///dd($codes);
        foreach ($codes as $code) {

            $nCode = NCOA::where('EconSegCode', $code)->first();
            $html .= "<div class='card p-3'>";
            $html .= "<table class='table table-bordered table-striped text-center my-5'>";
            $html .= '<div class="row"><div class="col-1">';
            $html .= '<img src="/images/logo.png" alt="NBTE LOGO" width="60px" height="60px"></div>';
            $html .= '<div class="col-10 text-center"><h2>National Board for Technical Education</h2> <h5>Ledger for <br> ' . $nCode?->EconSegCode . " : " . $nCode?->LineItem . '</h5> </div>';
            $html .= '<div class="col-1"><img src="/images/logo.png" alt="NBTE LOGO" width="60px" height="60px"></div></div>';
            //$html .= "<tr colspan='" . $headerColspan . "'><th colspan='" . $headerColspan . "'>LEDGER ACCOUNT FOR " . $codes->first()->year . "</th></tr>";
            //$html .= "<tr colspan='" . $headerColspan . "'><th colspan='" . $headerColspan . "'>ACCOUNT CODE :  " . $codes->first()->code . "    TITLE : " . $codes->first()->description . "</th></tr>";
            $html .= "<tr><th>Month</th><th></th><th>Ref No/TPV No</th><th>Details</th><th>Debit</th><th>Credit</th></tr>";
            $bal = 0;

            $trans = Transaction::where('account_code_cr', $code)->orWhere('account_code_db', $code)->get();
            $monthlyTrans = $trans->groupBy('month');
            foreach ($monthlyTrans as $m) {
                $sumCr = $m->where('account_code_cr', $code)->sum('amount_cr');
                $sumDr = $m->where('account_code_db', $code)->sum('amount_db');
                //dd($sumCr, $sumDr);
                $bal += ($sumCr - $sumDr);
                $html .= @"<tr><th>{$monthsArray[$m->first()->month - 1]}</th><th>{$m->first()->year}</th><th></th><th>{$nCode->LineItem} - {$m->first()->fundingAccount}</th><th>{$this->formatNumber($sumDr)}</th><th>{$this->formatNumber($sumCr)}</th></tr>";
            }
            $html .= "</table></div>";
        }

        return view('cashOffice.reports.generalLedger')->withTable($html);
        foreach ($vouchersByAccountCode as $codes) {
            /// dd($codes);

            $html .= "<table class='table table-bordered table-striped text-center my-5'>";
            $html .= '<div class="row"><div class="col-1">';
            $html .= '<img src="/images/logo.png" alt="NBTE LOGO" width="60px" height="60px"></div>';
            $html .= '<div class="col-10 text-center"><h2>National Board for Technical Education</h2> <h5>Ledger for </h5> </div>';
            $html .= '<div class="col-1"><img src="/images/logo.png" alt="NBTE LOGO" width="60px" height="60px"></div></div>';
            //$html .= "<tr colspan='" . $headerColspan . "'><th colspan='" . $headerColspan . "'>LEDGER ACCOUNT FOR " . $codes->first()->year . "</th></tr>";
            //$html .= "<tr colspan='" . $headerColspan . "'><th colspan='" . $headerColspan . "'>ACCOUNT CODE :  " . $codes->first()->code . "    TITLE : " . $codes->first()->description . "</th></tr>";
            $html .= "<tr><th>Month</th><th></th><th>Ref No/TPV No</th><th>Details</th><th>Debits</th><th>Credits</th></tr>";
            $bal = 0;
            $months = $codes->groupBy('month');
            foreach ($months as $month) {
                $fundingAccounts = $month->groupBy('fundingAccount');
                foreach ($fundingAccounts as $e) {
                    $amount = $e->sum('amount_db');
                    $bal += $amount;
                    $html .= @"<tr><th>{$monthsArray[$e->first()->month - 1]}</th><th>{$e->first()->year}</th><th></th><th>{$e->first()->description} - {$e->first()->fundingAccount}</th><th>{$this->formatNumber($amount)}</th><th>-------------</th></tr>";
                }
            }


            $html .= "</table>";
        }
        $fundingAccounts = [
            "Capital" => '31020101',
            "Overhead" => "31020103",
        ];
        $voucherByFundingaccount = $vouchers->groupBy('fundingAccount');
        foreach ($voucherByFundingaccount as $v) {
            $html .= "<table class='table table-bordered table-striped text-center'>";
            $html .= '<div class="row"><div class="col-1">';
            $html .= '<img src="/images/logo.png" alt="NBTE LOGO" width="60px" height="60px"></div>';
            $html .= '<div class="col-10 text-center"><h2>National Board for Technical Education</h2> <h4>Ledger</h4><h3>Account Code : ' . $v->first()->cr_code->EconSegCode . ' Description ' . $v->first()->cr_code->LineItem . '</h3></div>';
            $html .= '<div class="col-1"><img src="/images/logo.png" alt="NBTE LOGO" width="60px" height="60px"></div></div>';
            $html .= "<tr><th>Month</th><th>Year</th><th>Ref No/TPV No</th><th>Details</th><th>Debits</th><th>Credits</th><th>Balance</th></tr>";
            $bal = 0;
            $months = $v->groupBy('month');
            foreach ($months as $e) {
                $amount = $e->sum('amount_cr');
                $bal += $amount;
                $html .= @"<tr><th>{$monthsArray[$e->first()->month - 1]}</th><th>{$e->first()->year}</th><th></th><th>{$e->first()->description}</th><th>-----------</th><th>{$this->formatNumber($amount)}</th><th>{$this->formatNumber($bal)}</th></tr>";
            }
            $html .= "</table>";
        }
        return view('cashOffice.reports.generalLedger')->withTable($html);
    }
    public function formatNumber($number)
    {
        return number_format($number, 2, ".", ",");
    }
    public function sjv()
    {
    }
}
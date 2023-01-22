<?php

namespace App\Http\Controllers;

use App\Models\NCOA;
use Illuminate\Http\Request;
use App\Models\Voucher;

class CashOfficeController extends Controller
{
    public function pendingPVLiabilities()
    {
        $vouchers = Voucher::whereNotNull('checked_by')
            ->whereNotNull('prepared_by')
            ->whereNotNull('checked_date')
            ->whereNotNull('approved_by')
            ->whereNotNull('audited_by')
            ->whereLocation('co')
            ->get();
        return view('cashOffice.pendingPVLiabilities')->withVouchers($vouchers);
    }
    public function selectReports()
    {
        $coa = NCOA::all();
        return view('cashOffice.SelectReport')->withCoa($coa);
    }
}
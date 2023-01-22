<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class AuditVoucherController extends Controller
{
    public function index()
    {
        $npas = [];
        $vouchers = Voucher::whereNotNull('checked_by')
            ->whereNotNull('prepared_by')
            ->whereNotNull('checked_date')
            ->whereNotNull('approved_by')
            ->whereNull('audited_by')
            ->whereLocation('audit')
            ->get();
        return view('audit.list')->withVouchers($vouchers)->withNpas($npas);
    }
    public function preview($id)
    {
        $voucher = Voucher::find($id);
        return view('audit.preview')->withVoucher($voucher);
    }
    public function return(Request $request)
    {
        $voucher = Voucher::find($request->voucher_id);
        $voucher->approved_by = null;
        $voucher->approved_date = null;
        $voucher->location = 'ec';
        $voucher->save();
        session('message', 'Voucher Successfully Returned To Expenditure Control');
        return back();
    }
    public function forward(Request $request)
    {
        $voucher = Voucher::find($request->voucher_id);
        $voucher->audited_by = auth()->user()->id;
        $voucher->audited_date = now();
        $voucher->location = 'co';
        $voucher->save();
        session('message', 'Voucher Successfully Forwarded to Cash Office');
        return redirect('/approveVouchers');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherApprovalController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::whereNotNull('checked_by')
            ->whereNotNull('prepared_by')
            ->whereNotNull('checked_date')
            ->whereNull('approved_by')
            ->whereLocation('Ec')
            ->get();
        return view('EC.Vouchers.approve')->withVouchers($vouchers);
    }
    public function preview($id)
    {
        $voucher = Voucher::with(['payment_approval'])->find($id);
        return view('EC.Vouchers.approvePreview')->withVoucher($voucher);
    }
    public function approve(Request $request)
    {
        $request->validate(['voucher_id' => 'required']);
        $voucher = Voucher::find($request->voucher_id);
        $voucher->location = 'audit';
        $voucher->approved_by = auth()->user()->id;
        $voucher->approved_date = today();
        $voucher->location = 'audit';
        $voucher->save();
        session()->flash('message', 'Succesfully approved Voucher');
        return redirect('/approveVouchers');
    }
    public function recheck($id)
    {
        $voucher = Voucher::find($id);
        $voucher->checked_by = null;
        $voucher->checked_date = null;
        $voucher->approved_by = null;
        $voucher->approved_date = null;
        $voucher->save();
        session()->flash('message', 'Succesfully returned Voucher for Recheck');
        return redirect('/approveVouchers');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Payment;
use App\Models\Voucher;
use Illuminate\Http\Request;
use DB;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $perf = Budget::select(DB::raw('sum(actual) as actual, sum(approved) as approved'))->first();
        $perf = number_format((($perf->actual / $perf->approved) * 100), 2, ".", ",");
        $commitment = Budget::select(DB::raw('sum(committed) as committed, sum(approved) as approved'))->first();
        $commitment = number_format((($commitment->committed / $commitment->approved) * 100), 2, ".", ",");
        $commitment = Budget::sum('committed');

        return view('home')
            ->withPending(Voucher::all())
            ->withPerformance($perf)
            ->withCommittment($commitment)
            ->withStaffCount(User::count())
            ->withPaymentCount(Payment::whereBetween('txn_date', [now()->startOfMonth(), now()->endOfMonth()])->count());
    }
}
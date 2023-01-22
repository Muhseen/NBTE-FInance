<?php

namespace App\Http\Controllers;

use App\Models\NPA;
use App\Http\Requests\StoreNPARequest;
use App\Http\Requests\UpdateNPARequest;
use App\Models\NCOA;
use App\Models\StaffDebtor;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\NPARetirement;

class NPAController extends Controller
{
    public function issueView()
    {
        $staff = StaffDebtor::all();
        return view('npa.issue')->withStaff($staff);
    }
    public function issue(Request $request)
    {
        $attributes = $request->validate(['staff_id' => 'required', 'narration' => 'nullable', 'amount' => 'required|min:0', 'txn_date' => 'required|date', 'funding_account' => 'required']);
        NPA::create($attributes);
        $staff = StaffDebtor::find($request->staff_id);
        $staff->outstanding += $request->amount;
        $staff->save();
        $t = new Transaction();
        $t->voucher_no = uniqid();
        $t->account_code_db = "31060301";
        $t->description = "Non Personal Advance";
        $t->amount_db = $request->amount;
        $t->narration = $request->narration;
        $t->txn_date = $request->txn_date;
        $t->account_code_cr = $request->funding_account;
        $t->amount_cr = $request->amount;
        $t->voucher_id = $request->staff_id;
        $t->month = Carbon::parse($request->txn_date)->month;
        $t->year = Carbon::parse($request->txn_date)->year;
        //$t->file_no = $request->staff_id;
        $t->save();

        session()->flash('message', "Successfully Recorded Non Personal Advance");
        return back();

        //TO DO Add to transactions Table;
    }




    public function retireView()
    {
        $coas = NCOA::all();
        //$npas = NPALogs::all();
        return view('npa.retire')
            ->withStaff(StaffDebtor::all())
            ->withCoas($coas);
    }
    public function retire(Request $request)
    {
        $request->validate(['staff_id' => 'required', 'items' => 'required|array', 'npa_id' => 'required']);
        $staff = StaffDebtor::find($request->staff_id);
        foreach ($request->items as $entries) {
            $deets = explode("*", $entries);
            $staff->outstanding -= $deets[1];
            $code = NCOA::where('econsegcode', $deets[0])->first();
            NPARetirement::create(
                ['account_code' => $deets[0], 'description' => $code->description, 'narration' => $request->narration, 'rt_date' => $deets[2], 'amount' => $deets[1], 'npa_id' => $request->npa_id]
            );
            $t = new Transaction();
            $t->voucher_no = uniqid();
            $t->account_code_cr = "31060301";
            $t->description = "Non Personal Advance Retirement";
            $t->account_code_cr = $request->staff_id;
            $t->amount_db = $deets[1];
            $t->narration = $request->narration;
            $t->txn_date = $deets[2];
            $t->account_code_cr = $deets[0];
            $t->amount_cr = $deets[1];
            $t->voucher_id = $request->staff_id;
            $t->month = Carbon::parse($request->txn_date)->month;
            $t->year = Carbon::parse($request->txn_date)->year;

            $t->save();
        }
        $staff->save();
        session()->flash('message', 'Retirements successfully recorded');
        return back();
    }
    public function index()
    {
        //
    }
    public function userNPA(Request $request)
    {
        return NPA::where('staff_id', $request->staff_id)->with(['retirements'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNPARequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNPARequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NPA  $nPA
     * @return \Illuminate\Http\Response
     */
    public function show(NPA $nPA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NPA  $nPA
     * @return \Illuminate\Http\Response
     */
    public function edit(NPA $nPA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNPARequest  $request
     * @param  \App\Models\NPA  $nPA
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNPARequest $request, NPA $nPA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NPA  $nPA
     * @return \Illuminate\Http\Response
     */
    public function destroy(NPA $nPA)
    {
        //
    }
}
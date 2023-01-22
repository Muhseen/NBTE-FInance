<?php

namespace App\Http\Controllers;

use App\Models\StaffDebtor;
use App\Http\Requests\StoreStaffDebtorRequest;
use App\Http\Requests\UpdateStaffDebtorRequest;
use Illuminate\Http\Request;
use App\Models\StaffDebtorLedger;

class StaffDebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffDebtor = StaffDebtor::all();
        return view('staffDebtor.list')->withStaffDebtors($staffDebtor);
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
     * @param  \App\Http\Requests\StoreStaffDebtorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['fullname' => 'required', 'file_no' => 'required|unique:staff_debtors,file_no']);
        StaffDebtor::create($request->all());
        session()->flash('message', 'Staff Successfully Added');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaffDebtor  $staffDebtor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = collect();
        $counter = 1;


        $staffDebtor = StaffDebtor::with(['npas', 'npas.retirements'])->find($id);
        foreach ($staffDebtor->npas as $npa) {
            $rRow = new StaffDebtorLedger();
            $rRow->id = $counter;
            $rRow->txn_date = $npa->txn_date;
            $rRow->code = "31060301";
            $rRow->description = "Non Personal Advance";
            $rRow->narration = $npa->narration;
            $rRow->amount_cr = $npa->amount;
            $rRow->amount_db = 0;
            $report->put($counter, $rRow);
            $counter++;
            foreach ($npa->retirements as $r) {
                $rRow = new StaffDebtorLedger();
                $rRow->id = $counter;
                $rRow->txn_date = $r->rt_date;
                $rRow->code = $r->account_code;
                $rRow->description = $r->description;
                $rRow->narration = $r->narration;
                $rRow->amount_cr = 0;
                $rRow->amount_db = $r->amount;
                $report->put($counter, $rRow);
                $counter++;
            }
        }
        $report = $report->sortBy('txn_date');
        return view('staffDebtor.ledger')->withReports($report)->withStaff($staffDebtor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StaffDebtor  $staffDebtor
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffDebtor $staffDebtor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStaffDebtorRequest  $request
     * @param  \App\Models\StaffDebtor  $staffDebtor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStaffDebtorRequest $request, StaffDebtor $staffDebtor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffDebtor  $staffDebtor
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffDebtor $staffDebtor)
    {
        //
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::paginate(10);

        return view('bills.index', compact('bills'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bills.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'Supplier_name' => 'required',
            'Bill_number' => 'required',
            'Amount' => 'required',
            'Bill_date' => 'required',
            'Deposit_date' => 'required',
            'Service_name' => 'required',
        ]);


        //create new bill
        $bill=new Bill();
        $bill->Supplier_name=$request->Supplier_name;
        $bill->Bill_number=$request->Bill_number;
        $bill->Amount=$request->Amount;
        $bill->Bill_date=$request->Bill_date;
        $bill->Deposit_date=$request->Deposit_date;
        $bill->Due_date= date('Y-m-d', strtotime($request->Bill_date. ' + 90 days'));
        $bill->Service_name=$request->Service_name;
        $bill->save();


        //redirect the user and send friendly msg
        return redirect()->route('bills.index')->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        return view('bills.edit',compact('bill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'Supplier_name' => 'required',
            'Bill_number' => 'required',
            'Amount' => 'required',
            'Bill_date' => 'required',
            'Deposit_date' => 'required',
            'Due_date' => 'required',
            'Service_name' => 'required',
        ]);

        $bill->update($request->all());

        return redirect()->route('bills.index')
                        ->with('success','bill updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();

        return redirect()->route('bills.index')
                        ->with('success','Product deleted successfully');
    }

    public function deletechecked(Request $request)
    {
        $ids = $request->ids;
        Bill::whereIn('id',$ids)->delete();
        return redirect()->route('bills.index')
                        ->with('success','Product deleted successfully');
    }
}

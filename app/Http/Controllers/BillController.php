<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Supplier;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Exports\BillsExport;
use Maatwebsite\Excel\Facades\Excel;


class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search == '')
            $bills = Bill::paginate(20);
        else
        {
            $bills = Bill::where('Supplier_name', 'like', '%' . $search . '%')
                ->orWhere('Bill_number', 'like', '%' . $search . '%')
                ->orWhere('Amount', 'like', '%' . $search . '%')
                ->orWhere('Bill_date', 'like', '%' . $search . '%')
                ->orWhere('Deposit_date', 'like', '%' . $search . '%')
                ->orWhere('Due_date', 'like', '%' . $search . '%')
                ->orWhere('Service_name', 'like', '%' . $search . '%')
                ->paginate(20);
        }
        $suppliers =  Supplier::all();
        $services =  Service::all();
        return view('bills.index', compact('bills','suppliers','services'))->with(request()->input('page'));
    }

    public function export_bill()
    {
        return Excel::download(new BillsExport, 'factures.csv');
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
<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'Supplier_name' => 'required',
        ]);


        //create new bill
        $supplier=new Supplier();
        $supplier->Supplier_name=$request->Supplier_name;
        $supplier->save();


        //redirect the user and send friendly msg
        return redirect()->route('bills.index')->with('success','Product created successfully');
    }
}

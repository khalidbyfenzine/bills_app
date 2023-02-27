<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'Service_name' => 'required',
        ]);


        //create new bill
        $service=new Service();
        $service->Service_name=$request->Service_name;
        $service->save();


        //redirect the user and send friendly msg
        return redirect()->route('bills.index')->with('success','Product created successfully');
    }
}

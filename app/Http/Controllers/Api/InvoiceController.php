<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
class InvoiceController extends Controller
{
      public function invoice()
    {
        $invoices=Invoice::with('rendezvous')->get();
        return response()->json($invoices);
    }
     public function store(Request $request)
    {
    	$data  = $request->all();
      $data['appointment_id']=$request->appointment_id;
      $data['date']=$request->date;
      $data['amount'] = $request->amount;
    
    	Invoice::create($data);
   
}
  public function getfacture(Request $request)
    {
      
         $invoice = Invoice::with('rendezvous')->where('appointment_id',request()->app_id)->get();
       
        return response()->json($invoice);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescriptions;

class PrescriptionController extends Controller
{
     public function index()
    {
        $prescreptions = Prescriptions::with('rendezvous')->get();
        return response()->json( $prescreptions);
    }
    public function store(Request $request)
    {
    	$data  = $request->all();
      $data['appointment_id']=$request->appointment_id;
      $data['feedback']=$request->feedback;
      $data['medicine'] = implode(PHP_EOL,$request->medicine);
      $data['procedure_to_use_medicine'] = implode(PHP_EOL,$request->procedure_to_use_medicine);
    	Prescriptions::create($data);
   
}
 public function getprescreption($id)
    {
        $prescreption = Prescriptions::with('rendezvous')->find($id);
        return response()->json($prescreption);
    }

   
}
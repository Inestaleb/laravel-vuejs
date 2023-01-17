<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Time;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AppointementController extends Controller
{
 
    public function store(Request $request)
    {
          $assigne=Auth::id();
 
        $appointment = new Appointment([
            'date' => $request->date,
            'time_id' => $request->time_id,
            'type' => $request->type,
            'doctor_id' => $request->doctor_id,
            'patient_id' =>$assigne
            
          ]);
        $Time= Time::where('id',request()->time_id)->first();
         $Time->status=1;
         $Time->update();
        
          if($appointment->save()){
            return response()->json(['status'=>true,'message'=> 'Appointement added successfully', 'id'=> $appointment->id]);
     
           
        }else{
            return response()->json(['status'=>false,'message'=> 'Appointement added failed please try again']);
        }
     
      }
    

       public function getAppointement($id)
    {
        $appointment = Appointment::with('doctor')->find($id);
        return response()->json( $appointment);
    }


    
       public function appointement()
       {
         
         $app = Appointment::with('temps')->with('doctor')->where('patient_id','=',Auth::id())->get();
         return response()->json($app);
           
        }
        

     public function destroy($id) {
        $Appointment = Appointment::find($id);
       
        
         $Time= time::where('id',$Appointment->time_id)->first();
         $Time->status=0;
         $Time->update();
         $Appointment->delete();
        return response()->json('Appointment deleted!');
    }
        public function AppointementUpdate(Request $request,$id){
                    $Appointment= Appointment::where('id',$id)->first();
                    $Appointment->date=$request->date;
                    $Appointment->time_id=$request->time_id;
            
           
                    $Appointment->update();
                    return response()->json($Appointment);
           
    
          }
                public function AccepterAppointement(Request $request,$id){
            $app= Appointment::where('id',$id)->first();

           
            $app->status=1;
           
            $app->update();
            return response()->json(['status'=>true,'message'=> 'accepter successfully']);
    
          }
              public function RefuserAppointement(Request $request,$id){
            $app= Appointment::where('id',$id)->first();
            $Time= time::where('id',$app->time_id)->first();
         $Time->status=0;
         $Time->update();
            $app->delete();

           
            $app->status=2;
           
            $app->update();
            return response()->json(['status'=>false,'message'=> 'refuser successfully']);
    
          }


}

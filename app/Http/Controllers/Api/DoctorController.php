<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Models\Time;
use App\Models\Invoice;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function register(Request $request)
    {
        
       
       $this->validate($request,[
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'phone_number'=> 'required|max:8',
            'password' => 'required|confirmed',
            'specilaity_id'=>'required',
            'address'=>'required|max:55',
        

        ]);

     
        $user = new User;
      $password = Hash::make($request->password);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->specilaity_id  = $request->specilaity_id ;
            $user->address  = $request->address ;
            $user->password = $password;
            $user->role_id= 1;
          if ($request->hasFile('apptitude')) {
            $img = $request->file('apptitude');
            $user->apptitude= $img->getClientOriginalName();
            $img->move(public_path('images/apptitude'), $img->getClientOriginalName());
        }
            $user->save();

        return response([ 'status' => true, 'message' => 'User successfully register.' ], 200);
    }

       public function getAllAppointement()
       {
         
         $app = Appointment::with('temps','patient','doctor')->where('doctor_id','=',Auth::id())->get();
         return response()->json($app);
           
        }
       public function getAppointement()
       {
         
         $app = Appointment::with('temps','patient','doctor')->where('doctor_id','=',Auth::id())->get()->unique('patient_id');
         return response()->json($app);
           
        }
          public function AppointementID($id)
       {
         
         $appointement= Appointment::with('temps','patient','doctor')->find($id);
         return response()->json($appointement);
           
        }
        public function getAppointementID(Request $reques)
       {
         
         $appointement= Appointment::with('temps','patient','doctor')->where('id',request()->app_id)->get();
         return response()->json($appointement);
           
        }
        
}

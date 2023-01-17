<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Time;

use Illuminate\Support\Facades\Auth;
class TimeController extends Controller
{
   
  public function index()
    {
      $currentDate = date('Y-m-d');
        $temps = Time::where('doctor_id','=',Auth::id())->where('date','>=',$currentDate)->get();
        return response()->json($temps);
    }
       public function time($id)
    {
        $time= Time::find($id);
        return response()->json( $time);
    }


  public function destroy($id) {
        $time = Time::find($id);
        $time->delete();
        return response()->json('time deleted!');
    }

  function getTime(Request $request){
         
          $result =Time::where(function ($query){
          $query->where('date', 'LIKE', '%' . request()->date . '%')
          ->where('doctor_id', 'LIKE', '%' . request()->doctor_id . '%');
          
      })
        ->get();
      if(count( $result)){
        return Response()->json( $result);
       }
 
       else
       {
       return response()->json(['Result' => 'No Data not found'], 404);
     }
      }
  public function setTime(Request $request)
    {
         $this->validate($request,[
           
           'time'=>'required',
            'date'=>'required',
    
            
        ]);
          foreach($request->time as $time){
            Time::create([
                'doctor_id'=> Auth::id(),
                'time'=> $time,
                'date' => $request->date
                //'stauts'=>0
            ]);
        }  
  
       
           
      
    }

          


}

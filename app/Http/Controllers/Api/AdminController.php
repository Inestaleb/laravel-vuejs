<?php

namespace App\Http\Controllers\Api;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AdminController extends Controller
{
    public function index()
    {
        $specialites = Speciality::all();
        return response()->json($specialites);
    }
    public function getSpecialites($id)
    {
        $specialite = Speciality::find($id);
        return response()->json($specialite);
    }
    public function save_Specialites(Request $request){
        $Specialites=new Speciality;
        $Specialites->name        =$request->name;
        if ($request->hasFile('image')) {

            $img = $request->file('image');
            $Specialites->image = $img->getClientOriginalName();
            $img->move(public_path('images/specialite'), $img->getClientOriginalName());
        }
    
    
        if($Specialites->save()){
            return response()->json(['status'=>true,'message'=> 'Specialites added successfully']);
           
        }else{
            return response()->json(['status'=>false,'message'=> 'Specialites added failed please try again']);
        }
        }
        public function editSpecialite(Request $request,$id){
            $specialite= speciality::findOrFail($id);
            return response()->with('specialite',$specialite);
          }
    
          public function specialiteUpdate(Request $request,$id){
            $specialite= speciality::where('id',$id)->first();
            $specialite->name=$request->name;
            if ($request->hasFile('image')) {

                $img = $request->file('image');
                $specialite->image = $img->getClientOriginalName();
                $img->move(public_path('images/specialite'), $img->getClientOriginalName());
            }
            $specialite->update();
          return response()->json(['status'=>true,'message'=> 'Specialites added successfully']);
           
    
          }

          public function DoctorUpdate(Request $request,$id){
            $doctor= User::where('id',$id)->first();

           if($doctor->status==0){
            $doctor->status=1;
           }else{
            $doctor->delete();
           }
            $doctor->update();
            return response()->json(['status'=>true,'message'=> 'Specialites added successfully']);
    
          }


            public function getPatient()
            {
                $patient = User::where('role_id','=',3)->get();
                return response()->json($patient);
            }
            public function getDoctor()
            {
                $doctor = User::with('specialite')->where('role_id','=',1)->get();
                return response()->json($doctor);
            }
             public function getapptitude($id)
                {
                    $apptitude = User::find($id);
                    return response()->json($apptitude);
                }

}

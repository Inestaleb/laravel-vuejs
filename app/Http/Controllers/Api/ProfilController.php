<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{

      

       public function profilUpdate(Request $request,$id){
                $user= User::where('id',$id)->first();
                $user->name=$request->name;
                $user->date_birth=$request->date_birth;
                $user->email=$request->email;
                $user->phone_number=$request->phone_number;
                 $user->antecedant=$request->antecedant;
                $user->address=$request->address;
            if ($request->hasFile('image')) {

                $img = $request->file('image');
                $user->image = $img->getClientOriginalName();
                $img->move(public_path('images/Patients'), $img->getClientOriginalName());
            }
            $user->update();
            return response()->json($user);
           
    
          }


      public function profilUpdateDoctor(Request $request,$id){
                    $user= User::where('id',$id)->first();
                    $user->name=$request->name;
                    $user->date_birth=$request->date_birth;
                    $user->email=$request->email;
                    $user->phone_number=$request->phone_number;
                    $user->address=$request->address;
                    $user->education=$request->education;
                    $user->price=$request->price;
                    $user->description=$request->description;
                if ($request->hasFile('image')) {
                    $img = $request->file('image');
                    $user->image = $img->getClientOriginalName();
                    $img->move(public_path('images/doctor'), $img->getClientOriginalName());
                }
                    $user->update();
                    return response()->json($user);
           
    
          }
}

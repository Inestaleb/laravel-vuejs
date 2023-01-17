<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function searchBasedOnName(Request $request )
    {
      $name = $request->name;
      $address = $request->address;
      $specialite = $request->specialite;
      if (empty($name) && empty($address) && empty($specialite) ){
        return response()->json(['Result' => "You didn't select any search any search."], 403);
       }
      $result = User::with('specialite')->where('role_id','=',1)
      ->when(request()->name, function($query) {
          $query->where('name', 'LIKE', '%' . request()->name . '%');
      })
      ->when(request()->address, function($query) {
          $query->where('address', 'LIKE', '%' . request()->address . '%');
      }) 
      ->when(request()->specialite, function($query) {
        $query
        ->whereHas('specialite', function ( $query ) {
          $query->where('name', 'like', '%' .request()->specialite .'%');
        });
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

    public function Doctor($id)
    {
        $doctor = User::with('specialite')->where('role_id','=',1)->find($id);
        return response()->json($doctor);
    }


    function search(Request $request )
    {

      $gender = $request->gender;
    
     
      $resultat = User::with('specialite')->where('role_id','=',1)
      ->when(request()->name, function($query) {
          $query->where('name', 'LIKE', '%' . request()->name . '%');
      })->get();
      if(count( $resultat )){
        return Response()->json( $resultat );
       }
 
       else
       {
       return response()->json(['resultat ' => 'No Data not found'], 404);
     }
    }
  


}
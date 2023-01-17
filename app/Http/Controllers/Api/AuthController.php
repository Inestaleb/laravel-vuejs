<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'name' => 'required|max:55',
            'phone_number'=> 'required|max:8',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $requestData['password'] = Hash::make($requestData['password']);
        
        $user = User::create($requestData);

        return response([ 'status' => true, 'message' => 'User successfully register.' ], 200);
    }

    public function login(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if(! auth('web')->attempt($requestData)){
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }

        $accessToken = auth('web')->user()->createToken('authToken')->accessToken;

        return response(['user' => auth('web')->user(), 'access_token' => $accessToken], 200);
    }

    public function me(Request $request)
    {
        $user = $request->user()->with('specialite');
           dd($user->id);
        return response()->json(['user' => $user], 200);
    }

    public function logout (Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

 public function change_password(Request $request)
{
    $input = $request->all();
   $rules = array(
        'old_password' => 'required',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
    );
    $validator = Validator::make($input, $rules);
    if ($validator->fails()) {
       return response()->json([
                'errors' => $validator->errors()
            ], 422);
    } else {
      
            if (!(Hash::check(request('old_password'), Auth::user()->password))) {
                 return response()->json(['Result' => "Check your old password."], 403);
             
            } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                  return response()->json(['Result' => "Please enter a password which is not similar then current password."], 400);
               
            } else {
                User::where('id', Auth::id())->update(['password' => Hash::make($input['new_password'])]);
                  return response([ 'status' => true, 'message' => "Password updated successfully." ], 200);
                
            }
    
    }

}
}
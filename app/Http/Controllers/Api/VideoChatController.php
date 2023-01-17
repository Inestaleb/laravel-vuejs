<?php
namespace App\Http\Controllers\API;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Http\Controllers\Controller;
use App\Models\Appointment;

class VideoChatController extends Controller
{
  
  
      public function GetOthers(Request $request) {
  
        $others = Appointment::where('type','LIKE','%'.'En vidéo'.'%')->with('patient','temps','doctor')->where('doctor_id', '=', Auth::id()) 
      ->get();
        return response()->json($others);
    }
 public function Others(Request $request) {
  
        $others = Appointment::where('type','LIKE','%'.'En vidéo'.'%')->with('patient','temps','doctor')->where('patient_id', '=', Auth::id())
      ->get();
        return response()->json($others);
    }
   
    public function auth(Request $request) {
        $user = $request->user();
        $socket_id = $request->socket_id;
        $channel_name = $request->channel_name;
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'encrypted' => true
            ]
        );
        $auth= $pusher->presence_auth($channel_name, $socket_id, $user->id);
        return $auth;
    }
}
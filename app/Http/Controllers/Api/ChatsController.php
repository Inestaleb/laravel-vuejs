<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatsController extends Controller
{
    public function getContactList($id)
    {
        $contacts = User::where('id', '!=', $id)->get();

       $unreadIds = Message::select(DB::raw(' `from` as sender_id, count(`from`) as messages_count'))
       ->where('to', $id)
       ->where('read', false)
       ->groupBy('from')
       ->get();
       $contacts = $contacts->map(function($contact) use ($unreadIds) {
        $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
        $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
        return $contact;
       });

       return response()->json($contacts);
    }
    public function getMessages($id)
    {
        Message::where('from',$id)->where('to', Auth::id())->update(['read'=>true]);

        $messages = Message::where('from',$id)->where('to', Auth::id())->orwhere('to',$id)->where('from', Auth::id())->get();

        return response()->json($messages);
    }
    public function sendNewMessage(Request $request)
    {
       
       $message = Message::create([
            'from'=> $request->sender_id,
            'to'  => $request->receiver_id,
            'text'=> $request->text,
           
        ]);
      
        broadcast(new NewMessage($message));
        return response()->json($message);
    }
}

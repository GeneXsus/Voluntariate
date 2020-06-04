<?php

namespace App\Http\Controllers;


use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
class ChatsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Fetch all messages
     * @param  Request $request
     * @return Message
     */
    public function fetchMessages(Request $request)
    {

        return Message::where('chat_id',$request['chat_id'])->orderBy('updated_at','Desc')->with('user')->get();
    }


    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        if($user){
            $message = Message::create([
                'message' => $request->input('message'),
                'chat_id' => $request['chat_id'],
                'user_id' => $user->id,
                'offer_id'=> $request['offer_id'],
            ]);

            event(new MessageSent($user, $message,$request['chat_id']));

            return ['status' => 'Message Sent!'];
        }else{
            return ['status' => 'Error'];
        }

    }
}

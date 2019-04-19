<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* models */
use App\Notification;
use App\Post;

class NotificationsController extends Controller
{

    public function index($type)
    {
        $message = array();
        if($type === "count"){
            $notifications = Notification::where('user_id', auth()->user()->id)->where('status', 0)->count();
            if($notifications){
                $message['notifications'] = $notifications;
            }
        }
        if($type === "get"){
            $notifications            = Notification::get_notifications(auth()->user()->id);
            $message['notifications'] = $notifications;
        }
        return response()->json($message); 
    }

    public function show($type)
    {
        $likes    = [];
        $comments = [];
        if($type === "likes"){
            $likes = Notification::with('post')
                        ->with('user')
                        ->where('user_id', auth()->user()->id)
                        ->where('type', 'like')
                        ->where('status', 0)
                        ->get();
            Notification::where('user_id', auth()->user()->id)->where('type', 'like')->update([ 'status' => 1 ]);
        }
        if($type === "comments"){
            
            $comments = Notification::where('user_id', auth()->user()->id)->where('type', 'comment')->where('status', 0)
                        ->with('user')
                        ->with('post')
                        ->with('comment')
                        ->get();
            Notification::where('user_id', auth()->user()->id)->where('type', 'comment')->update([ 'status' => 1 ]);
        }
        $data = [
            'likes'    => $likes,
            'comments' => $comments
        ];
        return view("notifications.index")->with($data);
    }

}

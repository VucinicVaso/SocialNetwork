<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* models */
use App\Notification;
use App\Post;
use App\Comment;

class NotificationsController extends Controller
{

    public function index($type)
    {
        $message = array();
        if($type === "count"){
            $message['notifications'] = Notification::where('user_id', auth()->user()->id)->where('status', 0)->count();
        }
        if($type === "get"){
            $message = [
                'likes'    => Notification::get_likes(auth()->user()->id),
                'comments' => Notification::get_comments(auth()->user()->id),         
            ];
            Notification::where('user_id', auth()->user()->id)->where('type', 'like')->update([ 'status' => 1 ]);
        }
        return response()->json($message); 
    }

    public function show($target)
    {
        $notification = Notification::find($target);
        $comment      = Comment::get_comment($notification->notification_from, $notification->target, $notification->created_at);
        Notification::where('id', $notification->id)->where('user_id', auth()->user()->id)->update([ 'status' => 1 ]);
        $data = [
            'comment' => $comment
        ];
        return view("notifications.index")->with($data);
    }

}

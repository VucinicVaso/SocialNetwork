<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* models */
use App\Like;
use App\Post;
use App\Notification;

class LikesController extends Controller
{

    /* create like */
    public function store(Request $request)
    {
        $message = array();

        $this->validate($request, [
            'post_id' => 'required' 
        ]);        

        $like = Like::create([                                 /* like */
            'post_id' => $request->input('post_id'),
            'user_id' => auth()->user()->id
        ]);

        $post = Post::find($like->post_id);                    /* post */
        Notification::create([                                 /* notification */
            'notification_from' => auth()->user()->id,
            'user_id'           => $post->user_id,
            'target'            => $post->id,
            'type'              => 'like',
            'status'            => 0
        ]);

        if($like){
            $message['success'] = "Like created successfully!";
        }else {
            $message['error'] = "Error. Please try again!";
        }

        return response()->json($message);
    }

    /* delete like */
    public function destroy(Request $request)
    {
        $like = Like::where('post_id', $request->input('post_id'))->where('user_id', auth()->user()->id)->firstOrFail();
        if($like){
            $delete = $like->delete();
            $message['success'] = TRUE;
            return response()->json($message);
        }else{
            $message['error'] = FALSE;
            return response()->json($message);
        } 
    }

}

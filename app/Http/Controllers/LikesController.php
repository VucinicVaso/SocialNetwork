<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* models */
use App\Like;
use App\Post;

/* event */
use App\Events\NotificationCreated;

class LikesController extends Controller
{

    /* create like */
    public function store(Request $request)
    {
        $message = array();

        $this->validate($request, [
            'post_id' => 'required' 
        ]);        

        $like = Like::create([                           /* like */
            'post_id' => $request->input('post_id'),
            'user_id' => auth()->user()->id
        ]);

        $post = Post::find($like->post_id);              /* post */

        event(new NotificationCreated($post, 'like'));   /* notification event */

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

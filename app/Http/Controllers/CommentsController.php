<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* models */
use App\Comment;
use App\Post;

/* event */
use App\Events\NotificationCreated;

class CommentsController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|min:3|max:196',
            'post_id' => 'required|integer' 
        ]);        

        $comment = Comment::create([                        /* comment */
            'comment' => $request->input('comment'),
            'post_id' => $request->input('post_id'),
            'user_id' => auth()->user()->id
        ]);

        $post = Post::find($comment->post_id);              /* post */

        event(new NotificationCreated($post, 'comment'));   /* notification event */

        if($comment){
            return back()->with(['success' => 'Comment created successfully!']);
        }else {
            return back()->with(['error' => 'Error. Please try again!']);
        }        
    }

}

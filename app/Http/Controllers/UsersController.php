<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* models */
use App\User;
use App\Post;
use App\Friend;

class UsersController extends Controller
{
 
    /* user's profile */
    public function show($name, $id)
    {
        if(auth()->user()->id == $id) {
            return redirect('profile'); 
        }else {           
            $data = [
                'user'     => User::findOrFail($id),
                'posts'    => Post::select('id', 'images', 'user_id', 'created_at')
			                    ->with('user')
			                    ->withCount('comments')
			                    ->withCount('likes')
			                    ->withCount('isLiked')
			                    ->where('user_id', $id)
			                    ->orderBy('id', 'DESC')
			                    ->get(),
                'friends'  => Friend::friendsList($id),
                'isFriend' => User::isFriend($id, auth()->user()->id)
            ];

            return view('users.show')->with($data);     
        }   
    }

}

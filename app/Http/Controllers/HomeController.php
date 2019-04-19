<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* models */
use App\User;
use App\Post;
use App\Friend;

class HomeController extends Controller
{

    public function __construct()
    {
    	$this->middleware('auth');
    }

    /* loggedin users profile */
    public function index()
    {
        $posts   = Post::with('user')->with('comments')->with('likes')->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        $friends = Friend::friendsList(auth()->user()->id);

    	$data = [
            'posts'   => $posts,
            'friends' => $friends
    	];

        return view('users.index')->with($data);
    }

    /* friends profile */
    public function show($name, $id)
    {
        if(auth()->user()->id == $id) {
            return redirect('profile'); 
        }else {
            $user     = User::findOrFail($id);
            $posts    = Post::with('user')->with('comments')->with('likes')->where('user_id', $user->id)->orderBy('id', 'DESC')->get();
            $friends  = Friend::friendsList($user->id);
            $isFriend = Friend::where('friend_id', auth()->user()->id)->where('user_id', $user->id)
                        ->orWhere('friend_id', $user->id)->where('user_id', auth()->user()->id)->first();
               
            $data = [
                'user'     => $user,
                'posts'    => $posts,
                'friends'  => $friends,
                'isFriend' => $isFriend
            ];

            return view('users.show')->with($data);     
        }   
    }

    /* about user page */
    public function about()
    {
        return view('users.about');
    }

}

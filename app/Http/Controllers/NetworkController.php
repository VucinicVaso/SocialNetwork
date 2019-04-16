<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*  models */  
use App\User;
use App\Post;
use App\Friend;

class NetworkController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users        = User::where('id', "!=", auth()->user()->id)                 
                        ->take(10)
                        ->orderBy('id', 'DESC')
                        ->get();
        $friendsPosts = Post::whereIn('user_id', auth()->user()->friends->pluck('friend_id'))
                        ->orWhere('user_id', auth()->user()->id)
                        ->orderBy('id', 'DESC')
                        ->with('user')
                        ->with('comments')
                        ->with('likes')
                        ->paginate(10);
        $data = [
            'users'        => $users,
            'friendsPosts' => $friendsPosts
        ];
        return view('facebook.index')->with($data);
    }

}

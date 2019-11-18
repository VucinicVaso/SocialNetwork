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
        $data = [
            'users'        => User::usersList(auth()->user()->id),
            'friendsPosts' => Post::select('id', 'images', 'user_id', 'created_at')
                        ->whereIn('user_id', auth()->user()->friends->pluck('friend_id'))
                        ->orWhere('user_id', auth()->user()->id)
                        ->orderBy('id', 'DESC')
                        ->with('user')
                        ->withCount('comments')
                        ->withCount('likes')
                        ->withCount('isLiked')
                        ->paginate(10)
        ];
        return view('network.index')->with($data);
    }

}

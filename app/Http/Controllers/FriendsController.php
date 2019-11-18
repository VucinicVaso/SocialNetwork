<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* models */
use App\User;
use App\Friend;
use App\Post;

class FriendsController extends Controller
{

    /* search for user || list of all users || friend requests */
    public function index(Request $request, $type)
    {
        $findUser = "";
        $requests = "";
        $users    = "";

        if($type === "search" && !empty($request->input('search'))){
            $findUser = User::findUser(explode(" ", $request->input('search')), auth()->user()->id);
        }
        if($type === "requests"){
            $requests = Friend::friendsRequests();
        }
        if($type === "list") {
            $users = User::usersList(auth()->user()->id);
        }
        $data = [
            'findUser' => $findUser,
            'requests' => $requests,
            'users'    => $users
        ];

        return view('friends.index')->with($data);
    }

    /* list of users friends */
    public function show()
    {
        $data = [ 'friends' => Friend::friendsList(auth()->user()->id) ];
        return view('friends.show')->with($data);
    }    

    /* friends requests for loggedin user */
    public function get()
    {
        return response()->json([
            'requests' => Friend::where('friend_id', auth()->user()->id)->where('approved', '=', 0)->get()
        ]);       
    }

    /* add friend */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $friend = Friend::create([
            'friend_id' => $request->input('user_id'),
            'user_id'   => auth()->user()->id
        ]);

        return $friend 
            ? back()->with(['friend-success' => 'Friend added successfully!']) 
            : back()->with(['friend-error' => 'Error. Please try again!']);
    }

    /* delete friend */
    public function destroy(Request $request)
    {
        $user   = Friend::where('friend_id', $request->input('user_id'))->where('user_id', auth()->user()->id)->first();
        $friend = Friend::where('friend_id', auth()->user()->id)->where('user_id', $request->input('user_id'))->first();
        
        if(!empty($user) && !empty($friend)){
            $delete_user = $user->delete();
            $delete_user = $friend->delete();
            return back();
        }
    }

    /* accept friend request */
    public function update(Request $request)
    {
        $update = Friend::where('friend_id', auth()->user()->id)
                    ->where('user_id', $request->input('user_id'))
                    ->update([
                        'approved'  => 1
                    ]);

        $friend = Friend::create([
            'friend_id' => $request->input('user_id'),
            'user_id'   => auth()->user()->id,
            'approved'  => 1
        ]);

        return $update === 1 
            ? back()->with(['friend-success' => 'Friend added successfully!'])
            : back()->with(['friend-error' => 'Error. Please try again!']);
    }

}

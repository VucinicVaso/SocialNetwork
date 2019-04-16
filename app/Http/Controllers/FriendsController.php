<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* models */
use App\User;
use App\Friend;
use App\Post;

class FriendsController extends Controller
{

    /* search for user || list of all users || friend requests  */
    public function index(Request $request, $type)
    {
        $findUser = "";
        $requests = "";
        $users    = "";
        if($type === "search" && !empty($request->input('search'))){
            $search   = explode(" ", $request->input('search'));
            $findUser = User::where('firstname', 'LIKE', '%'.$search[0].'%')
                        ->orWhere('lastname', 'LIKE', '%'.$search[1].'%')
                        ->with('profile')
                        ->get();     
        }
        if($type === "requests"){
            $requests = Friend::friendsRequests();
        }
        if($type === "list") {
            $users = User::where('id', '!=', auth()->user()->id)
                    ->with('profile')
                    ->orderBy('id', 'DESC')
                    ->paginate(10);
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
        $user    = User::find(auth()->user()->id);
        $friends = Friend::friendsList(auth()->user()->id);

        $data = [
            'user'    => $user,
            'friends' => $friends
        ];
        return view('friends.show')->with($data);
    }    

    /* friends requests for loggedin user */
    public function get()
    {
        $message  = array();
        $requests = Friend::where('friend_id', auth()->user()->id)->where('approved', '=', 0)->get();

        if($requests){
            $message['requests'] = $requests;
        }

        return response()->json($message);       
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

        if($friend){
            return back()->with(['friend-success' => 'Friend added successfully!']);
        }else{
            return back()->with(['friend-error' => 'Error. Please try again!']);
        }
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

        if($update){
            return back()->with(['friend-success' => 'Friend added successfully!']);
        }else{
            return back()->with(['friend-error' => 'Error. Please try again!']);
        }
    }

}

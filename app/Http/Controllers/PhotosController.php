<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* models */
use App\Photo;
use App\User;

class PhotosController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'gallery_id' => 'required',
            'photo'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        /* Handle File Upload */
        if($request->hasFile('photo')) {
            /* Get filename with the extension */
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            /* Get just filename */
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            /* Get just extension */
            $extension = $request->file('photo')->getClientOriginalExtension();
            /* Filename to store */
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            /* Upload Image */
            $path = $request->file('photo')->storeAs('public/images', $fileNameToStore);
        }

        $photo = Photo::create([
            'user_id'    => auth()->user()->id,
            'gallery_id' => $request->input('gallery_id'),
            'photo'      => $fileNameToStore
        ]);

        if($photo){
            return back()->with(['photo_success' => 'New photo created successully!']);
        }else {
            return back()->with(['photo_error' => 'Error!']);
        }
    }

    public function show($id)
    {
        $message = array();
        $photo   = Photo::with('user')->findOrFail($id);
        if($photo){
            $message['photo'] = $photo;
        }else {
            $message['error'] = "Error. Please try again!";
        }

        return response()->json($message);        
    }

    public function update(Request $request, $type)
    {
        $photo = Photo::find($request->input('photo_id'));
        if($type === "profileImage"){
            $user = User::find(auth()->user()->id)
                    ->update([
                        'profile_image' => $photo->photo
                    ]);
            if($user){
                $success = true;
                return response()->json($success);
            }
        }
        if($type === "coverImage"){
            $user = User::find(auth()->user()->id)
                    ->update([
                        'cover_image' => $photo->photo
                    ]);
            if($user){
                $success = true;
                return response()->json($success);
            }
        } 
    }

    public function destroy($id)
    {
        $delete = Photo::where('id', '=', $id)->where('user_id', '=', auth()->user()->id)->delete();
        if($delete){
            $success = true;
            return response()->json($success);
        }
    }

}

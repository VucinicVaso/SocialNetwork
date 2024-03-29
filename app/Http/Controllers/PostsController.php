<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/* models */
use App\Post;

class PostsController extends Controller
{

    /* create post */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body'       => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'filename'   => 'max:3' 
        ]);

        /* Handle File Upload (multiple images) */
        $data = [];
        if($request->hasFile('filename')) {
            foreach($request->file('filename') as $image) {
                $filenameWithExt = $image->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);                      /* Get just filename */
                $extension       = $image->getClientOriginalExtension();                               /* Get just extension */
                $fileNameToStore = 'post_image_'.$filename.'_user_'.auth()->user()->id.'.'.$extension; /* Filename to store */
                $path            = $image->storeAs('public/images', $fileNameToStore);                 /* Upload Image */
                $data[]          = $fileNameToStore; 
            }
        } 

        $post = Post::create([
            'body'    => $request->input('body'),
            'images'  => json_encode($data),
            'user_id' => auth()->user()->id, 
        ]);

        return $post ? back()->with(['success' => 'Post added successfully!']) : back()->with(['error' => 'Error. Please try again!']);
    }

    /* show post */
    public function show($id)
    {
        $message  = array();
        $post     = Post::with('user')->with('commentsWithUserData')->withCount('likes')->findOrFail($id);
        
        if($post){
            $message['post'] = $post;
        }else {
            $message['error'] = "Error. Please try again!";
        }
        return response()->json($message);
    }

    /* delete post */
    public function destroy(Post $post)
    {
        abort_if($post->user_id !== auth()->id(), 403);

        return $post->delete() ? back()->with(['post-success' => 'Post delete successfully!']) : back()->with(['post-error' => 'Error. Please try again!']);
    }

}

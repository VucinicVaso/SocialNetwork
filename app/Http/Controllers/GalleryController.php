<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* models */
use App\Gallery;

class GalleryController extends Controller
{

    public function index()
    {
        $galleries = Gallery::with('photos')->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        $data = [
            'galleries' => $galleries
        ];
        return view('gallery.index')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'gallery_title'  => 'required'
        ]);

        $album = Gallery::create([
            'title'   => $request->input('gallery_title'),
            'user_id' => auth()->user()->id
        ]);

        if($album){
            return back()->with(['album_success' => 'Album created successully!']);
        }else {
            return back()->with(['album_error' => 'Error!']);
        }
    }

    public function show($id)
    {
        $gallery = Gallery::with('photos')->where('id', $id)->where('user_id', auth()->user()->id)->firstOrFail();
        $data = [
            'gallery' => $gallery
        ];
        return view('gallery.show')->with($data);
    }

    public function destroy($id)
    {
        //
    }

}

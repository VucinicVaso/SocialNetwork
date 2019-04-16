<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index(Request $request)
    {       
        if(Auth::check()){
            return redirect('home');
        }
        return view('pages.index'); 
    }

}
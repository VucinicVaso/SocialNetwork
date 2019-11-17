<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index(Request $request)
    {
        return Auth::check() ? redirect('home') : view('pages.index');
    }

}
<?php

namespace App\Http\Controllers\Auth;

use App\User;
Use App\Profile;
use App\Gallery;
use App\Photo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DateTime;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'gender'    => ['required', 'string', 'max:255'],
            'day'       => ['required', 'integer'],
            'month'     => ['required', 'integer'],
            'year'      => ['required', 'integer'],
            'reg_email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'reg_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);    
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $formatDate = $data['year']."-".$data['month']."-".$data['day']; 
        $date       = new DateTime($formatDate); 
        $newdate    = $date->format("Y-m-d");

        /* create user */
        $user =  User::create([
            'firstname'     => $data['firstname'],
            'lastname'      => $data['lastname'],
            'age'           => $newdate,
            'gender'        => $data['gender'],
            'profile_image' => 'profile.png',
            'cover_image'   => 'cover.jpg',
            'city'          => '',
            'country'       => '',
            'status'        => 'single',
            'bio'           => '',
            'email'         => $data['reg_email'],
            'password'      => Hash::make($data['reg_password']),
        ]);

        /* create default gallery */
        $gallery = Gallery::create([
            'title'   => 'Timeline',
            'user_id' => $user->id,
        ]);

        /* add default profile and cover images to gallery */
        $profileImg = Photo::create([
            'user_id'    => $user->id,
            'gallery_id' => $gallery->id,
            'photo'      => $user->profile_image,
        ]);
        
        $coverImg = Photo::create([
            'user_id'    => $user->id,
            'gallery_id' => $gallery->id,
            'photo'      => $user->cover_image,
        ]);

        return $user;
    }
}

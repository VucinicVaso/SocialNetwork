<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DateTime;

/* models */
use App\User;

class ProfileController extends Controller
{

    public function edit()
    {
        return view('users.edit');
    }

    public function update(Request $request, $type)
    {
        $user = User::find(auth()->user()->id);

        if($type === "user"){
            $this->validate($request, [
                'firstname' => 'required|string|min:3|max:30',
                'lastname'  => 'required|string|min:3|max:30',
                'email'     => 'required|email',
                'day'       => '',
                'month'     => '',
                'year'      => '',
                'gender'    => 'required|min:4|max:10',
                'city'    => 'required|min:3|max:255',
                'country' => 'required|min:3|max:255',
                'status'  => 'required|min:3|max:255',
                'bio'     => 'required|min:5|max:255',                
            ]);    

            $newdate = "";
            if(!empty($request->input('day')) && !empty($request->input('month')) && !empty($request->input('year'))){
                $formatDate = $data['year']."-".$data['month']."-".$data['day']; 
                $date       = new DateTime($formatDate); 
                $newdate    = $date->format("Y-m-d");
            }else {
                $newdate = auth()->user()->age;
            }

            $user = $user->update([
                'firstname' => $request->input('firstname'),
                'lastname'  => $request->input('lastname'),
                'age'       => $newdate,
                'gender'    => $request->input('gender'),
                'city'      => $request->input('city'),
                'country'   => $request->input('country'),
                'status'    => $request->input('status'),
                'bio'       => $request->input('bio'),                
                'email'     => $request->input('email'),     
            ]);         
            
            if($user){
                return back()->with('success', 'Profile updated successfully!');
            }else{
                return back()->with('error', 'Error. Please try again!');
            }
        }

        if($type === "password"){
            $this->validate($request, [
                'password'        => ['required', 'min:7', 'max:14', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('The current password is incorrect.'));
                    }
                }],
                'newpassword'     => ['required', 'min:7', 'max:14', function ($attribute, $value, $fail) use ($user) {
                    if (Hash::check($value, $user->password)) {
                        return $fail(__('Password is already taken.'));
                    }
                }],
                'confirmpassword' => 'required|min:7|max:14|same:newpassword',
            ]);  
            
            $password = $user->update([
                'password' => Hash::make($request->input('newpassword'))
            ]);

            if($password){
                return back()->with('success', 'Password updated successfully!');
            }else{
                return back()->with('error', 'Error. Please try again!');
            }                      
        }

    }

}
@extends('layouts.app')

@section('content')
<div class="container">

    <!-- navbar -->
    @include('users.includes.navbar')

    <div class="row justify-content-center mt-2">
        
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column">
                    <h2 class="p-2"><i class="fas fa-user-edit"></i> Settings</h2>
                </div>
                <div class="card-body row justify-content-start">
                    <div class="col-xl-4 col-lg-4 col-md-4 l-sm-12 col-12 overview">
                        <h4 class="text-center">User</h4>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 l-sm-12 col-12">
                    
                    @if(session('success'))
                        <p class="text-center alert alert-info mt-2">{{ session('success') }}</p>
                    @elseif(session('error'))
                        <p class="text-center alert alert-danger mt-2">{{ session('error') }}</p>    
                    @else
                    @endif  

                        <!-- User -->
                        <button class="btn btn-link w-100" data-toggle="collapse" data-target="#user">User</button>
                        <div id="user" class="collapse">
                        <form action="{{ url('profile/update/user') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="firstname" class="col-md-4">Firstname:</label>
                                <input type="text" name="firstname" class="form-control col-md-8 {{ $errors->has('firstname') ? ' is-invalid' : '' }}" value="{{ auth()->user()->firstname }}">
                                 @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif 
                            </div>
                            <div class="form-group row">
                                <label for="lastname" class="col-md-4">Lastname:</label>
                                <input type="text" name="lastname" class="form-control col-md-8 {{ $errors->has('lastname') ? ' is-invalid' : '' }}" value="{{ auth()->user()->lastname }}">
                                 @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif 
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4">Email:</label>
                                <input type="text" name="email" class="form-control col-md-8 {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ auth()->user()->email }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('day') }}</strong>
                                    </span>
                                @endif 
                            </div>
                            <div class="form-group row">
                                <label for="date" class="col-md-3 col-form-label">Birthday</label>
                                <div class="form-group col-md-3 col-sm-12">
                                    <select class="form-control{{ $errors->has('day') ? ' is-invalid' : '' }}" id="day" name="day">
                                        <option value="">DAY</option>
                                    @for($i = 31; $i >= 1; $i--)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                    </select>
                                @if ($errors->has('day'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('day') }}</strong>
                                    </span>
                                @endif  
                                </div>                             
                                <div class="form-group col-md-3 col-sm-12">
                                    <select class="form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" id="month" name="month">
                                        <option value="">MONTH</option>
                                    @for($i = 12; $i >= 1; $i--)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                    </select>
                                @if ($errors->has('month'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                                @endif  
                                </div> 
                                <div class="form-group col-md-3 col-sm-12">
                                    <select class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" id="year" name="year">
                                        <option value="">YEAR</option>
                                    @for($i = 2019; $i >= 1920; $i--)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                    </select>
                                @if ($errors->has('year'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif                                      
                                </div>                                                                        
                            </div>
                            <div class="form-group row justify-content-left"> 
                                <label for="gender" class="col-md-4 col-form-label">Gender</label>
                            @if(auth()->user()->gender === "female")
                               <div class="form-check col-md-4">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" value="female" checked>Female
                                    </label>
                                </div>                         
                            @else
                                <div class="form-check col-md-4">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" value="female">Female
                                    </label>
                                </div>                                 
                            @endif         
                            @if(auth()->user()->gender === "male")
                               <div class="form-check col-md-4">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" value="male" checked>Male
                                    </label>
                                </div>                         
                            @else
                                <div class="form-check col-md-4">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" value="male">Male
                                    </label>
                                </div>                                 
                            @endif
                            @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-md-4">City:</label>
                                <input type="text" name="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }} col-md-8" value="{{ auth()->user()->city }}">
                            @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif 
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-md-4">Country:</label>
                                <input type="text" name="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }} col-md-8" value="{{ auth()->user()->country }}">
                           @if ($errors->has('country'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-4">Status:</label>
                                <input type="text" name="status" class="form-control col-md-8" value="{{ auth()->user()->status }}">
                            </div>
                            <div class="form-group row">
                                <label for="bio" class="col-md-4">Biography:</label>
                                <textarea class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }} col-md-8" name="bio">{{ auth()->user()->bio }}</textarea>
                           @if ($errors->has('bio'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bio') }}</strong>
                                </span>
                            @endif
                            </div>                            
                            @method('PUT')
                            <button class="btn btn-primary w-100">UPDATE</button>
                        </form>                       
                        </div> 

                        <!-- Password -->
                        <button class="btn btn-link w-100" data-toggle="collapse" data-target="#password">Password</button>
                        <div id="password" class="collapse">
                        <form action="{{ url('profile/update/password') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="password" class="col-md-4">Old Password:</label>
                                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} col-md-8">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif 
                            </div>
                            <div class="form-group row">
                                <label for="newpassword" class="col-md-4">New Password:</label>
                                <input type="password" name="newpassword" class="form-control{{ $errors->has('newpassword') ? ' is-invalid' : '' }} col-md-8">
                            @if ($errors->has('newpassword'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('newpassword') }}</strong>
                                </span>
                            @endif 
                            </div>
                            <div class="form-group row">
                                <label for="confirmpassword" class="col-md-4">Confirm Password:</label>
                                <input type="password" name="confirmpassword" class="form-control{{ $errors->has('confirmpassword') ? ' is-invalid' : '' }} col-md-8">
                            @if ($errors->has('confirmpassword'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('confirmpassword') }}</strong>
                                </span>
                            @endif 
                            </div>
                            @method('PUT')
                            <button class="btn btn-primary w-100">UPDATE</button>
                        </form>                       
                        </div>

                    </div>
                </div>                
            </div>


        </div>

    </div>

</div>
@endsection

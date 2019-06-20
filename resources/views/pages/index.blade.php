@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        	<h2 class="text-center">SocialNetwork helps you connect and share with the people in your life.</h2>
            <img src="{{ url('storage/images/network.png') }}" class="w-100 network-img">
        </div> 

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
        	<h2 class="pb-3">Create a New Account</h2>
        	<form method="POST" action="{{ route('register') }}">
        		@csrf
				<div class="form-group row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
					    <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" placeholder="First name" required autofocus>

					    @if ($errors->has('firstname'))
					        <span class="invalid-feedback" role="alert">
					            <strong>{{ $errors->first('firstname') }}</strong>
					        </span>
					    @endif
					</div>

					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">         
					    <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" placeholder="Last name" required autofocus>

					    @if ($errors->has('lastname'))
					        <span class="invalid-feedback" role="alert">
					            <strong>{{ $errors->first('lastname') }}</strong>
					        </span>
					    @endif
					</div> 
				</div>

				<div class="form-group row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					    <input id="reg_email" type="email" class="form-control{{ $errors->has('reg_email') ? ' is-invalid' : '' }}" name="reg_email" value="{{ old('reg_email') }}" placeholder="Email" required>
					    @if ($errors->has('reg_email'))
					        <span class="invalid-feedback" role="alert">
					            <strong>{{ $errors->first('reg_email') }}</strong>
					        </span>
					    @endif
					</div>
				</div>

                <div class="form-group row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <input id="reg_password" type="password" class="form-control{{ $errors->has('reg_password') ? ' is-invalid' : '' }}" name="reg_password" placeholder="Password" required>

                        @if ($errors->has('reg_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('reg_password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <input id="reg_password-confirm" type="password" class="form-control" name="reg_password_confirmation" placeholder="Confirm password" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date" class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 col-form-label text-md-center">Birthday</label>
                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                        <select class="form-control" id="day" name="day">
                        	<option disabled>DAY</option>
                        @for($i = 31; $i >= 1; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                        </select>
                    </div>  
                    @if ($errors->has('day'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('day') }}</strong>
                        </span>
                    @endif                             
                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                        <select class="form-control" id="month" name="month">
                        	<option disabled>MONTH</option>
                        @for($i = 12; $i >= 1; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                        </select>
                    </div>  
                    @if ($errors->has('month'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('month') }}</strong>
                        </span>
                    @endif  
                    <div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                        <select class="form-control" id="year" name="year">
                        	<option disabled>YEAR</option>
                        @for($i = 2019; $i >= 1920; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                        </select>
                    </div>                    
                    @if ($errors->has('year'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('year') }}</strong>
                        </span>
                    @endif                                                      
                </div>

	            <div class="form-group row justify-content-left">    
	                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
	                   <div class="form-check text-center">
	                        <label class="form-check-label">
	                            <input type="radio" class="form-check-input" name="gender" value="female">
	                            <b>Female</b>
	                        </label>
	                    </div>                                 
	                </div>
	                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">         
	                   <div class="form-check text-center">
	                        <label class="form-check-label">
	                            <input type="radio" class="form-check-input" name="gender" value="male">
	                            <b>Male</b>
	                        </label>
	                    </div>                               
	                </div>
	                @if ($errors->has('gender'))
	                    <span class="invalid-feedback" role="alert">
	                        <strong>{{ $errors->first('gender') }}</strong>
	                    </span>
	                @endif
	            </div>                

                <div class="form-group row justify-content-left">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <button type="submit" class="btn btn-success w-100">
                            Sign Up
                        </button>
                    </div>
                </div>                

        	</form>
        </div>

    </div>
</div>

@endsection

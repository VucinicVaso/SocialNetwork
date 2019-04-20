@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center mt-2">
        
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

            <div class="row mb-2">
                <!-- create new post -->
                @include('network.includes.create-post')
            </div>

            <div class="row justify-content-center">
                <!-- posts -->
                @include('network.includes.posts')              
            </div>

        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- users -->
                @include('network.includes.users')   
        </div>

    </div>

</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center mt-2">
        
        <div class="col-md-6">

            <div class="row mb-2">
                <!-- create new post -->
                @include('network.includes.create-post')
            </div>

            <div class="row justify-content-center">
                <!-- posts -->
                @include('network.includes.posts')              
            </div>

        </div>

        <div class="col-md-4">
                <!-- users -->
                @include('network.includes.users')   
        </div>

    </div>

</div>
@endsection

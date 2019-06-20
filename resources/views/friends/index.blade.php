@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-left mt-2">
        <div class="col-md-8 card">
    
            @if(session('friend-success'))
                <p class="text-center alert alert-info mt-2">{{ session('friend-success') }}</p>
            @elseif(session('friend-error'))
                <p class="text-center alert alert-danger mt-2">{{ session('friend-error') }}</p>    
            @else
            @endif  

            <!-- search for user -->
            @include('friends.includes.search-users')

            <!-- friend request -->
            @include('friends.includes.requests')
             
            <!-- list of users -->
            @include('friends.includes.list')

        </div>
    </div>
</div>

@endsection

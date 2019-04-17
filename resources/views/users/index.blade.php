@extends('layouts.app')

@section('content')
<div class="container">

    <!-- navbar -->
    @include('users.includes.navbar')

    <div class="row justify-content-center mt-2">
        
        <div class="col-md-4">
            <!-- sidebar -->
            @include('users.includes.sidebar')
        </div>

        <div class="col-md-6">

            <!-- create new post -->
            @include('users.includes.create-post')

            <!-- posts -->
            @include('users.includes.posts')

        </div>

    </div>

</div>
@endsection

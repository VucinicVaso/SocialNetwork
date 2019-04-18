@extends('layouts.app')

@section('content')
<div class="container">

    <!-- navbar -->
    @include('users.includes.navbar')

    <div class="row justify-content-center mt-2">
        
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            <!-- sidebar -->
            @include('users.includes.sidebar')
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
            <!-- create new post -->
            @include('users.includes.create-post')

            <!-- posts -->
            @include('users.includes.posts')
        </div>

    </div>

</div>
@endsection

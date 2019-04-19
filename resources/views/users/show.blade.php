@extends('layouts.app')

@section('content')
<div class="container">

    <!-- navbar -->
    @include('users.show-includes.navbar')

    <div class="row justify-content-center mt-2">
        
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            <!-- sidebar -->
            @include('users.show-includes.sidebar')
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

            <!-- posts -->
            @include('users.show-includes.posts')

        </div>

    </div>

</div>
@endsection

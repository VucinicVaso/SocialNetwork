@extends('layouts.app')

@section('content')
<div class="container">

    <!-- navbar -->
    @include('users.show-includes.navbar')

    <div class="row justify-content-center mt-2">
        
        <div class="col-md-4">
            <!-- sidebar -->
            @include('users.show-includes.sidebar')
        </div>

        <div class="col-md-6">

            <!-- posts -->
            @include('users.show-includes.posts')

        </div>

    </div>

</div>
@endsection

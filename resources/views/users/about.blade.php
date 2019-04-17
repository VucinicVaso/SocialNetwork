@extends('layouts.app')

@section('content')
<div class="container">

    <!-- navbar -->
    @include('users.includes.navbar')

    <div class="row justify-content-center mt-2">
        
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-user"></i> About</h2>
                </div>
                <div class="card-body row justify-content-left">
                    <div class="col-md-4 overview">
                        <h4 class="text-center">Overview</h4>
                    </div>
                    <div class="col-md-4">
                        <p>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
                        <p><i class="fas fa-envelope-square"></i> {{ auth()->user()->email }}</p>
                        <p><i class="fas fa-birthday-cake"></i> {{ auth()->user()->age }}</p>
                        <p><i class="fas fa-user"></i> {{ auth()->user()->gender }}</p>
                        <p><i class="fas fa-globe-europe"></i> {{ auth()->user()->city }}</p>
                        <p><i class="fas fa-globe-europe"></i> {{ auth()->user()->country }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

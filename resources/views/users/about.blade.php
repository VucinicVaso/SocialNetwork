@extends('layouts.app')

@section('content')
<div class="container">

    <!-- navbar -->
    @include('users.includes.navbar')

    <div class="row justify-content-center mt-2">
        
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex flex-column">
                    <h2 class="p-2"><i class="fas fa-user"></i> About</h2>
                </div>
                <div class="card-body row justify-content-start">
                    <div class="col-md-4 overview">
                        <h4 class="text-center">Overview</h4>
                    </div>
                    <div class="col-md-4 d-flex flex-column">
                        <p class="p-2">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
                        <p class="p-2"><i class="fas fa-envelope-square"></i> {{ auth()->user()->email }}</p>
                        <p class="p-2"><i class="fas fa-birthday-cake"></i> {{ auth()->user()->age }}</p>
                        <p class="p-2"><i class="fas fa-user"></i> {{ auth()->user()->gender }}</p>
                        <p class="p-2"><i class="fas fa-globe-europe"></i> {{ auth()->user()->city }}</p>
                        <p class="p-2"><i class="fas fa-globe-europe"></i> {{ auth()->user()->country }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

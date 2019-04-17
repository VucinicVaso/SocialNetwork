@extends('layouts.app')

@section('content')
<div class="container">

    <!-- navbar -->
    @include('users.includes.navbar')

    <div class="row justify-content-center mt-2">
        <div class="col-md-10">
            <div class="card">

            @if($errors->any())
                @foreach($errors->all() as $error)
                <p class='text-center alert alert-danger'>{{ $error }}</p>
                @endforeach
            @else
            @endif

            @if(session('photo_success'))
                <p class="text-center alert alert-info mt-2">{{ session('photo_success') }}</p>
            @elseif(session('photo_error'))
                <p class="text-center alert alert-danger mt-2">{{ session('photo_error') }}</p>    
            @else
            @endif  

                <div class="card-header d-flex pt-2 justify-content-between">
                    <h2 class="pt-1"><i class="far fa-images"></i> Photos ({{ $gallery->title }})</h2>
                    <p class="pt-1">
                        <button class="btn btn-link" data-toggle="modal" data-target="#createPhoto"><i class="fas fa-plus"></i> Add Photo</button>
                    </p>
                </div>
                
                <div class="card-body row">
            @if(!empty($gallery))
                @foreach($gallery->photos as $photo)
                    <div class="col-md-4">
                        <img src="{{ url('storage/images') }}/{{ $photo->photo }}" class="w-100" style="height: 200px" data-toggle="modal" data-target="#photo" data-photo="{{ $photo->id }}">
                    </div>
                @endforeach
            @else
            @endif                    
                </div>

            </div>
        </div>
    </div>

</div>

<!-- The Gallery Modal -->
@include('gallery.modals.new-photo')

<!-- The Photo Modal -->
@include('gallery.modals.photo')

@endsection
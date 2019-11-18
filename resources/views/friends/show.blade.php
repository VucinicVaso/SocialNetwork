@extends('layouts.app')

@section('content')

<div class="container">
    <!-- navbar -->
    @include('users.includes.navbar')
    <div class="row justify-content-center mt-2">
        
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        @if($friends)
        <div class="row">
        
        @foreach($friends as $friend)
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-2">
                <div class="d-flex flex-row justify-content-between bg-light">
                    <a href="{{ url($friend->firstname.".".$friend->lastname."/".$friend->friend_id) }}" class="p-2">
                        <img src="{{ url('storage/images') }}/{{ $friend->profile_image }}" class="img-fluid w-100" style="height: 50px;">
                        <p class="text-center">{{ $friend->firstname }} {{ $friend->lastname }}</p>
                    </a>
                    <div class="p-2">
                        <form action="{{ route('friends/destroy') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $friend->friend_id }}" />
                            @method("DELETE")
                            <button type="submit" class="btn btn-info w-100 mt-3"><i class="fas fa-user-minus"></i> Unfriend</button>
                        </form>                         
                    </div>
                </div>
            </div>        
        @endforeach

        </div>
        @else
        @endif
        </div>

    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">

    <!-- navbar -->
    @include('users.includes.navbar')
    <div class="row justify-content-center mt-2">
        
        <div class="col-md-10">
    @if($friends)
        <div class="row">
        
        @foreach($friends as $friend)
            <div class="col-md-4 mb-2 mr-2">
                <div class="row bg-light pt-2" style="height: 90px;">
                
                    <div class="col-md-6">
                        <a href="{{ url($friend->firstname.".".$friend->lastname."/".$friend->friend_id) }}">
                            <img src="{{ url('storage/images') }}/{{ $friend->profile_image }}" class="w-100 mt-1" style="height: 50px;">
                            <p class="text-center">{{ $friend->firstname }} {{ $friend->lastname }}</p>
                        </a>  
                    </div>
                    <div class="col-md-6">
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


<!-- profile data -->
<div class="card">
    <div class="card-header d-flex flex-column justify-content-start" style="background-color: white;">
        <p class="p-2"><i class="fas fa-globe"></i> Intro</p>
        <br>
        <p class="p-2 text-center">{{ $user->bio }}</p>        
    </div>
    <div class="card-body d-flex flex-column">
        <p class="p-2"><i class="fas fa-home"></i> {{ $user->city }}</p>
        <p class="p-2"><i class="fas fa-map-marker-alt"></i> {{ $user->country }}</p>
        <p class="p-2"><i class="fas fa-heart"></i> {{ $user->status }}</p>
    </div>
</div>

<!-- friends -->
<div class="card mt-2">
    <div class="card-header d-flex flex-row p-2 justify-content-between">
        <p class="p-2"><i class="fas fa-user-friends" style="color: white; border-radius: 20%; background: #FF1493;"></i> Friends ({{ count($friends) }})</p>
        <p class="p-2"><a href="{{ url('friends/index/list') }}">Find Friends</a></p>
    </div>
    <div class="card-body row">
        @if($friends)
            @foreach($friends as $friend)
                <a href="{{ url($friend->firstname.".".$friend->lastname."/".$friend->friend_id) }}" class="col-xl-12 col-lg-12 col-md-4 col-sm-12 col-12">
                    <img src="{{ url('storage/images') }}/{{ $friend->profile_image }}" class="w-100" style="height: 50px;">
                </a>
            @endforeach
        @else
        @endif
    </div>
    <div class="card-footer"></div>
</div>
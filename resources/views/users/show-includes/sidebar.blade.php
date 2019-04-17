<!-- profile data -->
<div class="card">
    <div class="card-header" style="background-color: white;">
        <p class="float-left"><i class="fas fa-globe"></i> Intro</p>
        <br>
        <p>{{ $user->profile->bio }}</p>        
    </div>
    <div class="card-body">
        <p><i class="fas fa-home"></i> {{ $user->profile->city }}</p>
        <p><i class="fas fa-map-marker-alt"></i> {{ $user->profile->country }}</p>
        <p><i class="fas fa-heart"></i> {{ $user->profile->status }}</p>
    </div>
</div>

<!-- friends -->
<div class="card mt-2">
    <div class="card-header">
        <p class="float-left"><i class="fas fa-user-friends" style="color: white; border-radius: 20%; background: #FF1493;"></i> Friends ({{ count($friends) }})</p>
        <p class="float-right"><a href="{{ url('friends/index/list') }}">Find Friends</a></p>
    </div>
    <div class="card-body row">
        @if($friends)
            @foreach($friends as $friend)
                <a href="{{ url($friend->firstname.".".$friend->lastname."/".$friend->friend_id) }}" class="col-md-4">
                    <img src="{{ url('storage/images') }}/{{ $friend->profile_image }}" class="w-100" style="height: 50px;">
                </a>
            @endforeach
        @else
        @endif
    </div>
    <div class="card-footer"></div>
</div>
<!-- profile data -->
<div class="card">
    <div class="card-header" style="background-color: white;">
        <p class="float-left"><i class="fas fa-globe"></i> Intro</p>
        <br>
        @if(empty(auth()->user()->bio))
            <p class="text-center">Add a short bio to tell people more about yourself.</p>
            <p class="text-center"><a href="{{ url('profile/edit') }}">Add Bio</a></p>
        @else
            <p>{{ auth()->user()->bio }}</p>
        @endif
        
    </div>
    <div class="card-body">
        <p><i class="fas fa-home"></i> {{ auth()->user()->city }}</p>
        <p><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->country }}</p>
        <p><i class="fas fa-heart"></i> {{ auth()->user()->status }}</p>
    </div>
</div>

<div class="card mt-2">
    <div class="card-body d-flex p-2 justify-content-between">
        <p class="p-1"><i class="fas fa-image"></i> Photo</p>
        <a href="{{ url('gallery') }}" class="p-2">Add Photo</a>
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
            @foreach($friends->take(6) as $friend)
                <a href="{{ url($friend->firstname.".".$friend->lastname."/".$friend->friend_id) }}" class="col-md-4">
                    <img src="{{ url('storage/images') }}/{{ $friend->profile_image }}" class="w-100" style="height: 50px;">
                </a>
            @endforeach
        @else
        @endif
    </div>
    <div class="card-footer" style="height: 60px;">
        <p class="float-right pb-2"><a href="{{ url('friends/show') }}" class="btn btn-link">View</a></p>
    </div>
</div>
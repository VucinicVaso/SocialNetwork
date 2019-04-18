<!-- profile data -->
<div class="card">
    <div class="card-header d-flex flex-column justify-content-start" style="background-color: white;">
        <p class="p-2"><i class="fas fa-globe"></i> Intro</p>
        <br>
        @if(empty(auth()->user()->bio))
            <p class="p-2 text-center">Add a short bio to tell people more about yourself.</p>
            <p class="p-2 text-center"><a href="{{ url('profile/edit') }}">Add Bio</a></p>
        @else
            <p class="p-2 text-center">{{ auth()->user()->bio }}</p>
        @endif
        
    </div>
    <div class="card-body d-flex flex-column">
        <p class="p-2"><i class="fas fa-home"></i> {{ auth()->user()->city }}</p>
        <p class="p-2"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->country }}</p>
        <p class="p-2"><i class="fas fa-heart"></i> {{ auth()->user()->status }}</p>
    </div>
</div>

<!-- photo -->
<div class="card mt-2">
    <div class="card-body d-flex flex-row p-2 justify-content-between">
        <p class="p-2"><i class="fas fa-image"></i> Photo</p>
        <a href="{{ url('gallery') }}" class="p-2">Add Photo</a>
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
            @foreach($friends->take(6) as $friend)
                <a href="{{ url($friend->firstname.".".$friend->lastname."/".$friend->friend_id) }}" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <img src="{{ url('storage/images') }}/{{ $friend->profile_image }}" class="img-fluid w-100" style="height: 50px;">
                </a>
            @endforeach
        @else
        @endif
    </div>
    <div class="card-footer d-flex flex-row justify-content-end" style="height: 60px;">
        <p class="pb-2"><a href="{{ url('friends/show') }}" class="btn btn-link">View</a></p>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header" style="padding: 0px;">
                <img src="{{ url('storage/images') }}/{{ $user->cover_image }}" class="w-100 profile-cover-image">

                <div class="row justify-content-left">
                    <img src="{{ url('storage/images') }}/{{ $user->profile_image }}" class="col-md-3 w-100 profile-image">
                    <p class="col-md-4 pl-0 profile-name"><b>{{ $user->firstname }} {{ $user->lastname }}</b></p>                        
                </div>

                <!-- unfriend -->
                <div class="row float-right mb-1" style="margin-top: -30px;">
                @if(!empty($isFriend) && $isFriend->approved === 1)
                    <p class="col-md-4">
                        <form action="{{ route('friends/destroy') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}" />
                            @method("DELETE")
                            <button type="submit" class="btn btn-info w-100"><i class="fas fa-user-minus"></i> Unfriend</button>
                        </form>                        
                    </p>
                <!-- accept friend request -->
                @elseif(!empty($isFriend) && $isFriend->friend_id === auth()->user()->id && $isFriend->approved === 0)
                    <p class="col-md-4">
                        <form action="{{ route('friends/update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ $user->id }}" />
                            <button type="submit" class="btn btn-info w-100"><i class="fas fa-user-plus"></i> Accept Request</button>
                        </form>
                    </p>
                <!-- request pending -->
                @elseif(App\Friend::where('friend_id', $user->id)->where('user_id', auth()->user()->id)->where('approved', 0)->first())
                    <a href="{{ url('friends/index/list') }}" class="col-md-12 btn btn-info mt-1" style="margin-left: -20px;"><i class="fas fa-user-plus"></i>Request pending</a>             
                <!-- add friend -->               
                @else
                    <p class="col-md-4">
                        <form action="{{ route('friends/store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}" />
                            <button type="submit" class="btn btn-info w-100"><i class="fas fa-user-plus"></i> Add friend</button>
                        </form>
                    </p>
                @endif                
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">

            <div class="card-header" style="padding: 0px;">
                <img src="{{ url('storage/images') }}/{{ $user->cover_image }}" class="w-100 profile-cover-image">

                <div class="row justify-content-left">
                    <img src="{{ url('storage/images') }}/{{ $user->profile_image }}" class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-4 w-100 profile-image rounded-circle">
                    <p class="col-xl-4 col-lg-4 col-md-4 col-sm-8 col-8 pl-0 profile-name"><b>{{ $user->firstname }} {{ $user->lastname }}</b></p>                        
                </div>

                <div class="d-flex flex-row p-2 justify-content-end">
                    <!-- unfriend -->
                    @if(!empty($isFriend) && $isFriend->approved === 1)
                        <p class="p-2">
                            <form action="{{ route('friends/destroy') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}" />
                                @method("DELETE")
                                <button type="submit" class="btn btn-info w-100"><i class="fas fa-user-minus"></i> Unfriend</button>
                            </form>                        
                        </p>
                    <!-- accept friend request -->
                    @elseif(!empty($isFriend) && $isFriend->friend_id === auth()->user()->id && $isFriend->approved === 0)
                        <p class="p-2">
                            <form action="{{ route('friends/update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ $user->id }}" />
                                <button type="submit" class="btn btn-info w-100"><i class="fas fa-user-plus"></i> Accept Request</button>
                            </form>
                        </p>
                    <!-- request pending -->
                    @elseif(App\Friend::where('friend_id', $user->id)->where('user_id', auth()->user()->id)->where('approved', 0)->first())
                        <p class="p-2" style="margin-top: -15px; margin-bottom: -10px;">
                            <a href="{{ url('friends/index/list') }}" class="btn btn-info w-100"><i class="fas fa-user-plus"></i>Request pending</a>
                        </p>
                     <!-- add friend --> 
                    @else
                        <p class="p-2">
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

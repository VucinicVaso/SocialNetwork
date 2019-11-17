<div class="row card">

	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 card">
    	<h3 class="pb-2">People You May Know</h3>
    	<hr>

	@if($users)
	    @foreach($users as $user)
	        <div class="card-body row justify-content-between">
            	<a href="{{ url($user->firstname.".".$user->lastname."/".$user->id) }}" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 d-flex flex-column">
            		<img src="{{ url('storage/images') }}/{{ $user->profile_image }}" class="img-fluid w-100" style="heigth: 60px !important;">
                    <p class="text-center">{{ $user->firstname }} {{ $user->lastname }}</p>
            	</a>
            <!-- check if user is friend to loggedin user and remove friend -->
            @if(auth()->user()->friends->where('friend_id', $user->id)->where('user_id', auth()->user()->id)->where('approved', 1)->first())
               <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                <form action="{{ route('friends/destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    @method("DELETE")
                    <button type="submit" class="btn btn-info w-100 mt-1"><i class="fas fa-user-minus"></i> Unfriend</button>
                </form>  
                </div>
            <!-- check if loggedin user send request to user and is waiting for response -->    
            @elseif(App\Friend::where('friend_id', $user->id)->where('user_id', auth()->user()->id)->where('approved', 0)->first())
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                    <a href="{{ url('friends/index/list') }}" class="btn btn-info w-100 mt-1"><i class="fas fa-user-plus"></i>Request pending</a>
                </div>
            <!-- check if user has send you a request and accept the request -->
            @elseif(App\Friend::where('friend_id', auth()->user()->id)->where('user_id', $user->id)->where('approved', 0)->first())    
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                    <form action="{{ route('friends/update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ $user->id }}" />
                        <button type="submit" class="btn btn-info w-100 mt-1"><i class="fas fa-user-plus"></i> Accept Request</button>
                    </form>
                </div>
            <!-- if user is not your friend add friend -->
            @else
               <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                    <form action="{{ route('friends/store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}" />
                        <button type="submit" class="btn btn-info w-100 mt-1"><i class="fas fa-user-plus"></i> Add friend</button>
                    </form>
                </div>
                @if ($errors->has('user_id'))
                    <p class='text-center alert alert-danger'>{{ $errors->first('user_id') }}</p>
                @else
                @endif
            @endif
	    @endforeach
	@else
	    <p class="text-center alert alert-warning">0 users.</p>
	@endif		

	</div>

</div>
@if($users)
    <h3 class="pb-2">People You May Know</h3>
    <hr>

    @foreach($users as $user)
    <div class="card mb-1">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <img src="{{ url('storage/images') }}/{{ $user->profile_image }}" class="img-fluid w-100" style="heigth: 50px;">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="d-flex flex-column">
                        <a href="{{ url($user->firstname.".".$user->lastname."/".$user->id) }}" class="p-2">{{ $user->firstname }} {{ $user->lastname }}</a>
                        <small class="p-2">Lives in <i class="fas fa-map-marker-alt"></i> {{ $user->city }}, {{ $user->country }}</small>
                        <small class="p-2"><i class="fas fa-heart"></i> {{ $user->status }}</small>                                
                    </div>
                </div>

            <!-- check if user is friend to loggedin user and remove friend -->
            @if($user->isFollowed === 1)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <form action="{{ route('friends/destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    @method("DELETE")
                    <button type="submit" class="btn btn-info w-100 mt-5"><i class="fas fa-user-minus"></i> Unfriend</button>
                </form>  
                </div>

            <!-- check if loggedin user send request to user and is waiting for response -->   
            @elseif($user->isLoggedinUserRequestPending === 1)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <a href="{{ url('friends/index/list') }}" class="btn btn-info w-100 mt-5"><i class="fas fa-user-plus"></i>Request pending</a>
                </div>

            <!-- check if user sended you request and accept the request -->
            @elseif($user->isUserRequestPending === 1)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <form action="{{ route('friends/update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    <button type="submit" class="btn btn-info w-100 mt-5"><i class="fas fa-user-plus"></i> Accept Request</button>
                </form>
                </div>

            <!-- if user is not friend add friend -->
            @else
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <form action="{{ route('friends/store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    <button type="submit" class="btn btn-info w-100 mt-5"><i class="fas fa-user-plus"></i> Add friend</button>
                </form>
                    @if ($errors->has('user_id'))
                        <p class='text-center alert alert-danger'>{{ $errors->first('user_id') }}</p>
                    @else
                    @endif 
                </div>
            @endif
            </div>
        </div>
    </div>
    @endforeach
@else
@endif

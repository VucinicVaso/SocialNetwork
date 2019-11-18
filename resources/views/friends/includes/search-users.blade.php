@if(!empty($findUser))
        <h3 class="pb-2">You have searched for</h3>
        <hr>
    @foreach($findUser as $findU)
    <div class="card mb-1">
        <div class="card-body">
            <div class="row p-2 justify-content-between">                    
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <img src="{{ url('storage/images') }}/{{ $findU->profile_image }}" class="p-2 img-fluid w-100" style="heigth: 50px;">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 d-flex flex-column p-2">
                    <a href="{{ url($findU->firstname.".".$findU->lastname."/".$findU->id) }}" class="p-2">{{ $findU->firstname }} {{ $findU->lastname }}</a>
                    <small class="p-2">Lives in <i class="fas fa-map-marker-alt"></i> {{ $findU->city }}, {{ $findU->country }}</small>
                    <small class="p-2"><i class="fas fa-heart"></i> {{ $findU->status }}</small>
                </div>
            <!-- check if user is friend to loggedin user and remove friend -->        
            @if($findU->isFollowed === 1)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <form action="{{ route('friends/destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $findU->id }}" />
                    @method("DELETE")
                    <button type="submit" class="btn btn-info w-100 mt-5"><i class="fas fa-user-minus"></i> Unfriend</button>
                </form>  
                </div>
            <!-- check if loggedin user send request to user and if is waiting for response -->   
            @elseif($findU->isLoggedinUserRequestPending === 1)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                    <a href="{{ url('friends/index/list') }}" class="btn btn-info w-100 mt-5"><i class="fas fa-user-plus"></i>Request pending</a>
                </div>
            <!-- check if user sended you request and accept the request -->
            @elseif($findU->isUserRequestPending === 1)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <form action="{{ route('friends/update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $findU->id }}" />
                    <button type="submit" class="btn btn-info w-100  mt-5"><i class="fas fa-user-plus"></i> Accept Request</button>
                </form>
                </div>
            <!-- if user is not friend add friend -->
            @else
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <form action="{{ route('friends/store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $findU->id }}" />
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
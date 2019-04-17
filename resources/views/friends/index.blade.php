@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-left mt-2">
        <div class="col-md-8 card">
    
    @if(session('friend-success'))
        <p class="text-center alert alert-info mt-2">{{ session('friend-success') }}</p>
    @elseif(session('friend-error'))
        <p class="text-center alert alert-danger mt-2">{{ session('friend-error') }}</p>    
    @else
    @endif  





    @if(!empty($findUser))
            <h3 class="pb-2">You have searched for</h3>
            <hr>
        @foreach($findUser as $findU)
        <div class="card mb-1">
            <div class="card-body row justify-content-between">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ url('storage/images') }}/{{ $findU->profile_image }}" class="w-100" style="heigth: 50px;">
                        </div>
                        <div class="col-md-8">
                            <p><a href="{{ url($findU->firstname.".".$findU->lastname."/".$findU->id) }}">{{ $findU->firstname }} {{ $findU->lastname }}</a></p>
                            <small>Lives in <i class="fas fa-map-marker-alt"></i> {{ $findU->city }}, {{ $findU->country }}</small>
                            <br>
                            <small><i class="fas fa-heart"></i> {{ $findU->status }}</small>
                        </div>
                    </div>
                </div>
            <!-- check if user is friend to loggedin user and remove friend -->
            @if(auth()->user()->friends->where('friend_id', $findU->id)->where('user_id', auth()->user()->id)->where('approved', 1)->first())
                <div class="col-md-4">
                <form action="{{ route('friends/destroy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $findU->id }}" />
                    @method("DELETE")
                    <button type="submit" class="btn btn-info w-100 mt-1"><i class="fas fa-user-minus"></i> Unfriend</button>
                </form>  
                </div>
            <!-- check if loggedin user send request to user and if is waiting for response -->    
            @elseif(App\Friend::where('friend_id', $findU->id)->where('user_id', auth()->user()->id)->where('approved', 0)->first())
                <div class="col-md-4">
                    <a href="{{ url('friends/index/list') }}" class="btn btn-info w-100 mt-1"><i class="fas fa-user-plus"></i>Request pending</a>
                </div>
            <!-- check if user sended you request and accept the request -->
            @elseif(App\Friend::where('friend_id', auth()->user()->id)->where('user_id', $findU->id)->where('approved', 0)->first())    
                <div class="col-md-4">
                <form action="{{ route('friends/update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $findU->id }}" />
                    <button type="submit" class="btn btn-info w-100"><i class="fas fa-user-plus"></i> Accept Request</button>
                </form>
                </div>
            <!-- if user is not friend add friend -->
            @else
                <div class="col-md-4">
                <form action="{{ route('friends/store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $findU->id }}" />
                    <button type="submit" class="btn btn-info w-100 mt-1"><i class="fas fa-user-plus"></i> Add friend</button>
                </form>
                @if ($errors->has('user_id'))
                    <p class='text-center alert alert-danger'>{{ $errors->first('user_id') }}</p>
                @else
                @endif 
                </div>
            @endif
            </div>
        </div>
        @endforeach
    @else
    @endif    





    @if(!empty($requests))
            <h3 class="pb-2">You have new friend requests</h3>
            <hr>
        @foreach($requests as $request) 
            <div class="card mb-1">
                <div class="card-body row justify-content-between">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ url('storage/images') }}/{{ $request->profile_image }}" class="w-100" style="heigth: 50px;">    
                            </div>
                            <div class="col-md-8">
                                <p><a href="{{ url($request->firstname.".".$request->lastname."/".$request->id) }}">{{ $request->firstname }} {{ $request->lastname }}</a></p>
                                <small>Lives in <i class="fas fa-map-marker-alt"></i> {{ $request->city }}, {{ $request->country }}</small>
                                <br>
                                <small><i class="fas fa-heart"></i> {{ $request->status }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form action="{{ route('friends/update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ $request->id }}" />
                            <button type="submit" class="btn btn-info w-100"><i class="fas fa-user-plus"></i> Accept Request</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @else
    @endif   





        @if($users)
            <h3 class="pb-2">People You May Know</h3>
            <hr>
            @foreach($users as $user)
            <div class="card mb-1">
                <div class="card-body row justify-content-between">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ url('storage/images') }}/{{ $user->profile_image }}" class="w-100" style="heigth: 50px;">
                            </div>
                            <div class="col-md-8">
                                <p><a href="{{ url($user->firstname.".".$user->lastname."/".$user->id) }}">{{ $user->firstname }} {{ $user->lastname }}</a></p>
                                <small>Lives in <i class="fas fa-map-marker-alt"></i> {{ $user->city }}, {{ $user->country }}</small>
                                <br>
                                <small><i class="fas fa-heart"></i> {{ $user->status }}</small>
                            </div>
                        </div>
                    </div>
                <!-- check if user is friend to loggedin user and remove friend -->
                @if(auth()->user()->friends->where('friend_id', $user->id)->where('user_id', auth()->user()->id)->where('approved', 1)->first())
                    <div class="col-md-4">
                    <form action="{{ route('friends/destroy') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}" />
                        @method("DELETE")
                        <button type="submit" class="btn btn-info w-100 mt-1"><i class="fas fa-user-minus"></i> Unfriend</button>
                    </form>  
                    </div>
                <!-- check if loggedin user send request to user and is waiting for response -->    
                @elseif(App\Friend::where('friend_id', $user->id)->where('user_id', auth()->user()->id)->where('approved', 0)->first())
                    <div class="col-md-4">
                        <a href="{{ url('friends/index/list') }}" class="btn btn-info w-100 mt-1"><i class="fas fa-user-plus"></i>Request pending</a>
                    </div>
                <!-- check if user sended you request and accept the request -->
                @elseif(App\Friend::where('friend_id', auth()->user()->id)->where('user_id', $user->id)->where('approved', 0)->first())    
                    <div class="col-md-4">
                    <form action="{{ route('friends/update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ $user->id }}" />
                        <button type="submit" class="btn btn-info w-100"><i class="fas fa-user-plus"></i> Accept Request</button>
                    </form>
                    </div>
                <!-- if user is not friend add friend -->
                @else
                    <div class="col-md-4">
                    <form action="{{ route('friends/store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}" />
                        <button type="submit" class="btn btn-info w-100 mt-1"><i class="fas fa-user-plus"></i> Add friend</button>
                    </form>
                    @if ($errors->has('user_id'))
                        <p class='text-center alert alert-danger'>{{ $errors->first('user_id') }}</p>
                    @else
                    @endif 
                    </div>
                @endif
                </div>
            </div>
            @endforeach
            {{ $users->links() }}
        @else
        @endif





        </div>
    </div>
</div>

@endsection

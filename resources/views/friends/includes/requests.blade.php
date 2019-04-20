@if(!empty($requests))
        <h3 class="pb-2">You have new friend requests</h3>
        <hr>
    @foreach($requests as $request) 
        <div class="card mb-1">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <img src="{{ url('storage/images') }}/{{ $request->profile_image }}" class="img-fluid w-100" style="heigth: 50px;">    
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="d-flex flex-column p-2">
                            <a href="{{ url($request->firstname.".".$request->lastname."/".$request->id) }}" class="p-2">{{ $request->firstname }} {{ $request->lastname }}</a>
                            <small class="p-2">Lives in <i class="fas fa-map-marker-alt"></i> {{ $request->city }}, {{ $request->country }}</small>
                            <small class="p-2"><i class="fas fa-heart"></i> {{ $request->status }}</small>                                
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <form action="{{ route('friends/update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ $request->id }}" />
                            <button type="submit" class="btn btn-info w-100"><i class="fas fa-user-plus"></i> Accept Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
@endif  
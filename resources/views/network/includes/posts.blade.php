@if(!empty($friendsPosts))

    @if(session('post-success'))
        <p class="text-center alert alert-info mt-2">{{ session('post-success') }}</p>
    @elseif(session('post-error'))
        <p class="text-center alert alert-danger mt-2">{{ session('post-error') }}</p>    
    @else
    @endif  

    @foreach($friendsPosts as $post)

        @if(auth()->user()->friends->where('friend_id', $post->user->id)->where('user_id', auth()->user()->id)->where('approved', '!=', 0)->first() || $post->user->id === auth()->user()->id)

        <div class="col-md-12 card mb-2">

            <div class="card-header">
                <div class="float-left">
                    <img src="{{ url('storage/images') }}/{{ $post->user->profile_image }}" style="width: 50%; height: 30px;">
                    <a href="{{ url($post->user->firstname.".".$post->user->lastname."/".$post->user->id) }}">{{ $post->user->firstname }} {{ $post->user->lastname }}</a>
                    <small class="text-center">{{ $post->created_at }}</small>
                </div>
            </div><!-- /card-header -->

            <div class="card-body">
                <div data-toggle="modal" data-target="#myModal" data-post="{{ $post->id }}">
            @if(count(json_decode($post->images)) > 1)
                <div class="row">
                    <img src="{{ url('storage/images') }}/{{ json_decode($post->images)[0] }}" class="col-md-12 w-100" style="height: 200px; padding: 0;">
                    <img src="{{ url('storage/images') }}/{{ json_decode($post->images)[1] }}" class="col-md-6 w-100" style="height: 100px; padding: 0;">
                    <img src="{{ url('storage/images') }}/{{ json_decode($post->images)[2] }}" class="col-md-6 w-100" style="height: 100px; padding: 0;">
                </div>
            @else 
                <img src="{{ url('storage/images') }}/{{ json_decode($post->images)[0] }}" class="w-100" style="height: 200px;">
            @endif
                </div>
                
                <div class="d-flex p-2 justify-content-left">
                    <p class="p-1"><i class="fab fa-gratipay" style="color: #FF1493;"></i> {{ count($post->likes) }} Likes</p>
                    <p class="p-1"><i class="far fa-comments" style="color: #FF1493;"></i> {{ count($post->comments) }} Comments</p>
                </div>

                <div class="row text-center">
                    <div class="col-md-4">
                    	<!-- like / unlike post -->
                        @if($post->likes->where('post_id', $post->id)->where('user_id', auth()->user()->id)->first())
                            <button class="btn btn-link btn-unlike" onclick="unlikePost({{ $post->id }});"><i class="far fa-thumbs-down"></i> Unlike</button>
                        @else
                            <button class="btn btn-link btn-like" onclick="likePost({{ $post->id }});"><i class="far fa-thumbs-up"></i> Like</button>
                        @endif
                        <script src="{{ asset('js/like.js') }}"></script> 

                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-link text-center"><i class="far fa-comments"></i> Comment</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-link text-center"><i class="fas fa-share"></i> Share</button>
                    </div>
                </div>

            </div><!-- /card-body -->

            <div class="card-footer">
            	<!-- create comment -->
                @if(session('comment-success'))
                    <p class="text-center alert alert-success">{{ session('comment-success') }}</p>
                @elseif(session('comment-error'))
                    <p class="text-center alert alert-danger">{{ session('comment-error') }}</p>    
                @else
                @endif
                <form action="{{ route('comment/store') }}" method="POST">
	                @csrf
	                <div class="form-group row justify-content-center">
	                    <img src="{{ url('storage/images') }}/{{ auth()->user()->profile_image }}" class="col-md-2 w-100" style="height: 40px;">
	                    <input type="text" name="comment" class="col-md-8 form-control mt-1" placeholder="Write a comment...">
	                    <input type="hidden" name="post_id" value="{{ $post->id }}">
	                </div>                                  
                </form>
                @if ($errors->any())
                    @foreach($errors->all() as $error)
                    <p class='text-center alert alert-danger'>{{ $error }}</p>
                    @endforeach
                @else
                @endif
            </div><!-- /card-footer -->

        </div>

        @else
        @endif

    @endforeach
    
    {{ $friendsPosts->links() }}  

    @include("network.includes.post-modal")
@else
    <p class="text-center alert alert-warning">0 posts.</p>
@endif

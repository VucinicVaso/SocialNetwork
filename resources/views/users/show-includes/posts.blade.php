@if(!empty($posts))

    @if(session('post-success'))
        <p class="text-center alert alert-info mt-2">{{ session('post-success') }}</p>
    @elseif(session('post-error'))
        <p class="text-center alert alert-danger mt-2">{{ session('post-error') }}</p>    
    @else
    @endif  

    @foreach($posts as $post)
        <div class="card mt-2">

            <div class="card-header d-flex flex-row justify-content-start">
                <div class="p-2">
                    <img src="{{ url('storage/images') }}/{{ $post->user->profile_image }}" class="img-fluid" style="width:50%; height: 35px;">
                    {{ $post->user->firstname }} {{ $post->user->lastname }}
                    <small class="text-center">{{ $post->created_at }}</small>
                </div>
            </div><!-- /card-header -->

            <div class="card-body">
                <div data-toggle="modal" data-target="#myModal" data-post="{{ $post->id }}">
            @if(count(json_decode($post->images)) > 1)
                <div class="row">
                    <img src="{{ url('storage/images') }}/{{ json_decode($post->images)[0] }}" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 img-fluid w-100" style="height: 200px; padding: 0;">
                    <img src="{{ url('storage/images') }}/{{ json_decode($post->images)[1] }}" class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 img-fluid w-100" style="height: 100px; padding: 0;">
                    <img src="{{ url('storage/images') }}/{{ json_decode($post->images)[2] }}" class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 img-fluid w-100" style="height: 100px; padding: 0;">
                </div>
            @else 
                <img src="{{ url('storage/images') }}/{{ json_decode($post->images)[0] }}" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 img-fluid w-100" style="height: 200px;">
            @endif
                </div>
                
                <div class="d-flex flex-row p-2 justify-content-start">
                    <p class="p-2"><i class="fab fa-gratipay" style="color: #FF1493;"></i> {{ count($post->likes) }} Likes</p>
                    <p class="p-2"><i class="far fa-comments" style="color: #FF1493;"></i> {{ count($post->comments) }} Comments</p>
                </div>

                <div class="row d-flex flex-row justify-content-between">
                    <div class="p-2">
                        <script src="{{ asset('js/like.js') }}"></script>
                        @if($post->likes->where('post_id', $post->id)->where('user_id', auth()->user()->id)->first())
                            <button class="btn btn-link btn-unlike" onclick="unlikePost({{ $post->id }});"><i class="far fa-thumbs-down"></i> Unlike</button>
                        @else
                            <button class="btn btn-link btn-like" onclick="likePost({{ $post->id }});"><i class="far fa-thumbs-up"></i> Like</button>
                        @endif                   
                    </div>
                    <div class="p-2">
                        <button class="btn btn-link text-center"><i class="far fa-comments"></i> Comment</button>
                    </div>
                    <div class="p-2">
                        <button class="btn btn-link text-center"><i class="fas fa-share"></i> Share</button>
                    </div>
                </div>
            </div><!-- /card-body -->

            <div class="card-footer">
                @if(session('comment-success'))
                    <p class="text-center alert alert-success">{{ session('comment-success') }}</p>
                @elseif(session('comment-error'))
                    <p class="text-center alert alert-danger">{{ session('comment-error') }}</p>    
                @else
                @endif
                <form action="{{ route('comment/store') }}" method="POST">
                @csrf
                <div class="form-group row justify-content-between">
                    <img src="{{ url('storage/images') }}/{{ auth()->user()->profile_image }}" class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 img-fluid w-100" style="height: 40px;">
                    <input type="text" name="comment" class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-6 form-control mt-1" placeholder="Write a comment...">
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
    @endforeach
@else
    <p class="text-center alert alert-danger">0 posts.</p>
@endif

@include("users.show-includes.post-modal")
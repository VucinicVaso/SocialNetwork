<script type="text/javascript">

    $(document).ready(function(){

        let modalBody    = document.querySelector(".modal-body");
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $('#myModal').on('show.bs.modal', function (e) {
            var post_id = $(e.relatedTarget).data('post');

        fetch(`{{ url('post/show') }}/${post_id}`, {
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN          
            }, 
            method: 'GET',
        }).then(response => response.json())
        .then(data => {
            const { post, comments, error } = data;

            if(post != ""){

                let images        = JSON.parse(post.images);
                let countLikes    = post.likes.length;
                let countComments = comments.length;
                
                let postData = `
                    <div class="row">
                        <div class="col-md-8">
                        <!-- post images -->
                    `;
                if(images.length == 1){
                    postData += `
                        <img src="{{ url('storage/images') }}/${images[0]}" class="w-100" style="height:600px;">
                    `;
                }else {
                    postData += `
                        <div id="demo" class="carousel slide" data-ride="carousel">
                              
                            <ul class="carousel-indicators">
                                <li data-target="#demo" data-slide-to="0" class="active"></li>
                                <li data-target="#demo" data-slide-to="1"></li>
                                <li data-target="#demo" data-slide-to="2"></li>
                            </ul>

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ url('storage/images') }}/${images[0]}" class="w-100" style="height:600px;">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ url('storage/images') }}/${images[1]}" class="w-100" style="height:600px;">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ url('storage/images') }}/${images[2]}" class="w-100" style="height:600px;">
                                </div>
                            </div>

                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>

                        </div>`
                };
                    postData += `</div>`;
                    postData += `
                        <div class="col-md-4">
                            <!-- user and post data -->
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="row justify-content-left">
                                <img src="{{ url('storage/images') }}/${post.user.profile_image}" class="col-md-4 w-100" style="height:75px;">
                                <a href="{{ url('') }}/${post.user.firstname}.${post.user.lastname}/${post.user.id}" class="col-md-8" style="padding-left: 0px;">${post.user.firstname} ${post.user.lastname}
                                </a>
                                <small>${post.created_at}</small>
                            </div>
                            <p class="pt-2">${post.body}</p>
                            <hr>
                            <div class="d-flex p-2 justify-content-left">
                                <p class="p-1"><i class="fab fa-gratipay" style="color: #FF1493;"></i> ${countLikes} Likes</p>
                                <p class="p-1"><i class="far fa-comments" style="color: #FF1493;"></i> ${countComments} Comments</p>
                            </div>                            
                            <div>
                                <!-- comment form -->
                                <form action="{{ route('comment/store') }}" method="POST">
                                @csrf
                                <div class="form-group row justify-content-center">
                                    <img src="{{ url('storage/images') }}/{{ auth()->user()->profile_image }}" class="col-md-2 w-100" style="height: 40px;">
                                    <input type="text" name="comment" class="col-md-8 form-control mt-1" placeholder="Write a comment...">
                                    <input type="hidden" name="post_id" value="${post.id}">
                                </div>                                  
                                </form>                            
                            </div>
                            <hr>
                            <div class="row">
                                <!-- comments data -->
                        `;

                    if(countComments == 0){ postData += `<p class="col-md-12 text-center alert alert-warning">0 comments</p>`; }else {
                        postData += comments.map(comment => {
                            return(`
                                <div class="row pb-1">
                                    <img src="{{ url('storage/images') }}/${comment.profile_image}" alt="John Doe" class="col-md-2 w-100 rounded-circle" style="height: 50px;">
                                    <p class="col-md-4">
                                        <a href="{{ url('') }}/${comment.firstname}.${comment.lastname}/${comment.user_id}">
                                            <b>${comment.firstname} ${comment.lastname}</b>
                                        </a>
                                        <small class='float-left'>${comment.created_at}</small>
                                    </p> 
                                    <p class="col-md-6">${comment.comment}</p>
                                </div>                             
                            `);                         
                        });
                    }

                    postData += `
                            </div>
                        </div>
                    </div>`;

                modalBody.innerHTML = postData;
            }else {
                alert(error);
            }
        });

    }); 
});

</script>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-body"></div>

        </div>
    </div>
</div>


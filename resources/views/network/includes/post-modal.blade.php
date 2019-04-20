<script type="text/javascript">
$(document).ready(function(){

    let modalBody    = document.querySelector(".modal-body");
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    $('#myModal').on('show.bs.modal', function (e) {
        let post_id = $(e.relatedTarget).data('post');

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
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                        <!-- post images -->
                    `;
                if(images.length == 1){
                    postData += `<img src="${ADDRESS}/storage/images/${images[0]}" class="img-fluid w-100" style="height:500px;">`;
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
                                    <img src="${ADDRESS}/storage/images/${images[0]}" class="img-fluid w-100" style="height:500px;">
                                </div>
                                <div class="carousel-item">
                                    <img src="${ADDRESS}/storage/images/${images[1]}" class="img-fluid w-100" style="height:500px;">
                                </div>
                                <div class="carousel-item">
                                    <img src="${ADDRESS}/storage/images/${images[2]}" class="img-fluid w-100" style="height:500px;">
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
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                            <!-- user and post data -->
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="d-flex flex-row justify-content-start mt-1">
                                <img src="${ADDRESS}/storage/images/${post.user.profile_image}" class="p-2 img-fluid" style="height:75px;">
                                <a href="${ADDRESS}/${post.user.firstname}.${post.user.lastname}/${post.user.id}" class="p-2">${post.user.firstname} ${post.user.lastname}</a>
                            </div>
                            <small>${post.created_at}</small>
                            <p class="pt-2">${post.body}</p>
                            <hr>
                            <div class="d-flex p-2 flex-row justify-content-between">
                                <p><i class="fab fa-gratipay" style="color: #FF1493;"></i> ${countLikes} Likes</p>
                                <p><i class="far fa-comments" style="color: #FF1493;"></i> ${countComments} Comments</p>
                            </div>                            
                            <div class="d-flex p-2 flex-row justify-content-between">
                                <!-- comment form -->
                                <form action="{{ route('comment/store') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <img src="${ADDRESS}/storage/images/{{ auth()->user()->profile_image }}" class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 w-100 img-fluid rounded" style="height: 40px;">
                                    <input type="text" name="comment" class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-6 form-control mt-1" placeholder="Write a comment...">
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
                                    <img src="${ADDRESS}/storage/images/${comment.profile_image}" alt="John Doe" class="col-xl-2 col-lg-2 col-md-2 col-sm-4 col-4 w-100 img-fluid rounded" style="height: 50px;">
                                    <p class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                        <a href="${ADDRESS}/${comment.firstname}.${comment.lastname}/${comment.user_id}">
                                            <b>${comment.firstname} ${comment.lastname}</b>
                                        </a>
                                        <small class='float-left'>${comment.created_at}</small>
                                    </p> 
                                    <p class="col-xl-6 col-lg-6 col-md-6 col-sm-4 col-4">${comment.comment}</p>
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
        <div class="modal-content bg-dark text-white">

            <div class="modal-body"></div>

        </div>
    </div>
</div>

@if(session('success'))
    <p class="text-center alert alert-success">{{ session('success') }}</p>
@elseif(session('error'))
    <p class="text-center alert alert-danger">{{ session('error') }}</p>
@else
@endif   

<div class="card mt-1 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card-body">
        
        <form action="{{ route('post/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <img src="{{ url('storage/images') }}/{{ auth()->user()->profile_image }}" class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4 w-100 img-fluid" style="height: 50px;">
                <input type="text" name="body" class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-8 form-control" placeholder="What's on your mind?">
                <hr>
            </div>
            <div class="row justify-content-between">
                <label class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 btn btn-file"><i class="fas fa-camera-retro"></i> Photo
                    <style type="text/css">
                        input[type="file"] {
                            display: none;
                        }
                    </style>
                    <input type="file" name="filename[]" id="filename" multiple />  
                </label>                            
                <button type="submit" class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 btn btn-primary float-right">Create</button>
            </div>                        
        </form>
        
        @if ($errors->any())
            @foreach($errors->all() as $error)
            <p class='text-center alert alert-danger'>{{ $error }}</p>
            @endforeach
        @else
        @endif             

    </div>
</div>              

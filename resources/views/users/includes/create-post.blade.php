@if(session('success'))
    <p class="text-center alert alert-success">{{ session('success') }}</p>
@elseif(session('error'))
    <p class="text-center alert alert-danger">{{ session('error') }}</p>
@else
@endif
            
<div class="card">
    <div class="card-body">
        
        <form action="{{ route('post/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <img src="{{ url('storage/images') }}/{{ auth()->user()->profile_image }}" class="col-md-2 w-100" style="height: 50px;">
                <input type="text" name="body" class="col-md-10 form-control" placeholder="What's on your mind?">
                <hr>
            </div>
            <div class="row justify-content-between">
                <label class="col-md-3 btn btn-file"><i class="fas fa-camera-retro"></i> Photo
                    <style type="text/css">
                        input[type="file"] {
                            display: none;
                        }
                    </style>
                    <input type="file" name="filename[]" id="filename" multiple />  
                </label>                            
                <button type="submit" class="col-md-3 btn btn-primary float-right">Create</button>
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
@extends('layouts.app')

@section('content')
<div class="container">

    <!-- navbar -->
    @include('users.includes.navbar')

    <div class="row justify-content-center mt-2">
        <div class="col-md-10">
            <div class="card">

            @if($errors->any())
                @foreach($errors->all() as $error)
                <p class='text-center alert alert-danger'>{{ $error }}</p>
                @endforeach
            @else
            @endif

            @if(session('album_success'))
                <p class="text-center alert alert-info mt-2">{{ session('album_success') }}</p>
            @elseif(session('album_error'))
                <p class="text-center alert alert-danger mt-2">{{ session('album_error') }}</p>    
            @else
            @endif  

                <div class="card-header d-flex pt-2 justify-content-between">
                    <h2 class="pt-1"><i class="far fa-images"></i> Photos</h2>
                    <p class="pt-1">
                        <button class="btn btn-link" data-toggle="modal" data-target="#createGallery"><i class="fas fa-plus"></i> Create Album</button>
                    </p>
                </div>
                
                <div class="card-body row">
            @if(!empty($galleries))
                @foreach($galleries as $gallery)
                    <div class="col-md-4 card">
                        <div class="card-body">
                            <a href="{{ url('gallery') }}/{{ $gallery->id }}">
                            @if(!empty($gallery->photos[0]))
                                <img src="{{ url('storage/images') }}/{{ $gallery->photos[0]->photo }}" class="w-100" style="height: 200px">
                            @else
                                <img src="{{ url('storage/images/noimage.jpg') }}" class="w-100" style="height: 200px">
                            @endif
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
            @endif                    
                </div>

            </div>
        </div>
    </div>

</div>

<!-- The Gallery Modal -->
<div class="modal" id="createGallery">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create Album</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('gallery/store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="gallery_title">Title:</label>
                <input type="text" name="gallery_title" class="form-control">
            </div>
            <button type="submit" class="btn btn-info w-100">Create</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

@endsection

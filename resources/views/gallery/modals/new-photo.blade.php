<!-- The Gallery Modal -->
<div class="modal" id="createPhoto">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Photo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('photo/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" name="photo" class="form-control">
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

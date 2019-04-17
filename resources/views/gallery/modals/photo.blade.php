<script type="text/javascript">

    setProfile = (id) => {
      const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      let form = new FormData();
      form.append('photo_id', id);

      fetch('{{ url("photo/update/profileImage") }}', {
        headers: {
          "X-CSRF-TOKEN": CSRF_TOKEN        
        }, 
        method: 'POST',
        body: form
        }).then(response => response.json())
        .then(data => {
          const { success } = data;
          if(success != ""){
            location.reload();
          }else {
            alert("error");
          }
        });
    }

    setCover = (id) => {
      const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      let form = new FormData();
      form.append('photo_id', id);

      fetch('{{ url("photo/update/coverImage") }}', {
        headers: {
          "X-CSRF-TOKEN": CSRF_TOKEN        
        }, 
        method: 'POST',
        body: form
        }).then(response => response.json())
        .then(data => {
          const { success } = data;
          if(success != ""){
            location.reload();
          }else {
            alert("error");
          }
        });
    }

    deleteImage = (id) => {
      const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      fetch(`{{ url('photo/destroy') }}/${id}`, {
        headers: {
          "X-CSRF-TOKEN": CSRF_TOKEN        
        }, 
        method: 'DELETE'
        }).then(response => response.json())
        .then(data => {
          const { success } = data;
          if(success != ""){
            location.reload();
          }else {
            alert("error");
          }
        });
    }

    $(document).ready(function(){

        let showPhoto = document.querySelector("#show-photo");

        $('#photo').on('show.bs.modal', function (e) {

            const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let photoID = $(e.relatedTarget).data('photo');

            fetch(`{{ url('photo') }}/${photoID}`, {
              headers: {
                  "X-CSRF-TOKEN": CSRF_TOKEN          
              }, 
              method: 'GET',
            }).then(response => response.json())
            .then(data => {
              const { photo, error } = data;

              if(photo != ""){
                let photoData = `
                    <div class="row">
                        <div class="col-md-8">
                        <!-- photo -->
                        <img src="{{ url('storage/images') }}/${photo.photo}" class="w-100" style="height:600px;">
                      </div>
                      <div class="col-md-4">
                          <!-- user and photo data -->
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="row justify-content-left text-white">
                              <img src="{{ url('storage/images') }}//${photo.user.profile_image}" class="col-md-6 w-100" style="height:75px;">
                              <a href="#" class="col-md-6" style="padding-left: 0px;">${photo.user.firstname} ${photo.user.lastname}</a>
                              <small>${photo.created_at}</small>
                          </div>
                          <hr>
                          <div class="row justify-content-between">
                            <button class="col-md-4 btn btn-primary w-100" onclick="setProfile(${photo.id})">Profile Image</button>
                            <button class="col-md-4 btn btn-primary w-100" onclick="setCover(${photo.id})">Cover Image</button>
                            <button class="col-md-2 btn btn-danger w-100" onclick="deleteImage(${photo.id})"><i class="fas fa-trash-alt"></i></button>
                          </div>
                        </div>
                    </div>`;

                  showPhoto.innerHTML = photoData;
              }else {
                alert(error);
              }
        });

    }); 
});

</script>
<!-- The Photo Modal -->
<div class="modal" id="photo">
  <div class="modal-dialog modal-xl bg-dark">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body bg-dark" id="show-photo">

      </div>

    </div>
  </div>
</div>

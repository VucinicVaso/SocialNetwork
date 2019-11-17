function likePost(id){
	const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

	const formData = new FormData();
	formData.append('post_id', id);

	fetch(ADDRESS + '/like/store', {
	    headers: {
			"X-CSRF-TOKEN": CSRF_TOKEN	    	
	    }, 
		method: 'POST',
		body: formData
	}).then(response => response.json())
	.then(data => {
		const {success, error } = data;
		if(success != ""){
			location.reload();
		}else {
			alert("error");
		}
	});
}

function unlikePost(id){
	const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

	const formData = new FormData();
	formData.append('post_id', id);

	fetch(ADDRESS + '/like/destroy', {
	    headers: {
			"X-CSRF-TOKEN": CSRF_TOKEN	    	
	    },
		method: 'POST',
		body: formData
	}).then(response => response.json())
	.then(data => {
		const {success, error } = data;
		if(success != ""){
			location.reload();
		}else {
			alert("error");
		}
	});
}

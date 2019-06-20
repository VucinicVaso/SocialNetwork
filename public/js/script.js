window.onload = function(){		

	/* friends requests */
 	friendRequests = async function() {
 		const CSRF_TOKEN     = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		let friendsRequest   = document.querySelector('#friends-request');
		let numberOfRequests = document.querySelector('#number-of-requests');

		const msg = await fetch(ADDRESS + "/friends/get", {
			method: 'GET',
		    headers: {
		    	'X-CSRF-TOKEN': CSRF_TOKEN
		    },
		}).then(response => response.json())
		.then(data => {
				const { requests } = data;
				if(requests.length > 0){
					friendsRequest.classList.add("text-danger");
					numberOfRequests.style.display = "block";                        
					numberOfRequests.innerHTML = requests.length;
					console.log("You have (" + requests.length + ") new friend requests.");
				}else {
					numberOfRequests.style.display = "none"; 
					numberOfRequests.innerHTML = "";
					console.log("no new friends requests!");
				}
			}
		);
	}

	/* notifications */
 	notifications = async function() {
 		const CSRF_TOKEN          = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		let notificationsDIV      = document.querySelector('#notifications');
		let numberOfNotifications = document.querySelector('#number-of-notifications');

		const msg = await fetch(ADDRESS + "/notifications/index/count", {
			method: 'GET',
		    headers: {
		    	'X-CSRF-TOKEN': CSRF_TOKEN
		    },
		}).then(response => response.json())
		.then(data => {
				const { notifications } = data;
				if(notifications > 0){
					notificationsDIV.classList.add("text-danger");
					numberOfNotifications.style.display = "block";                        
					numberOfNotifications.innerHTML = notifications;
					console.log("You have (" + notifications + ") new notifications.");
				}else {
					numberOfNotifications.style.display = "none"; 
					numberOfNotifications.innerHTML = "";
					console.log("no new notifications!");
				}
			}
		);
	}

	setInterval(friendRequests, 7500);
	setInterval(notifications, 5000);

	showNotifications = () => {
		const CSRF_TOKEN            = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		let showNotificationsDIV    = document.querySelector("#show-notifications");
		let displayNotificationsDIV = "";

		fetch(ADDRESS + "/notifications/index/get", {
			method: 'GET',
		    headers: {
		    	'X-CSRF-TOKEN': CSRF_TOKEN
		    },
		}).then(response => response.json())
		.then(data => {
			const { likes, comments } = data;			
			
			likes.map(like => {
				images = JSON.parse(like.images);	
				displayNotificationsDIV +=	`
					<div class="dropdown-item">
						<div class="d-flex flex-row justify-content-between">
							<a class="p-2" href="${ADDRESS}/${like.firstname}.${like.lastname}/${like.notification_from}">
								<img class="img-fluid w-100" style="height: 50px;" src="${ADDRESS}/storage/images/${like.profile_image}" />
								<p>${like.firstname} ${like.lastname}</p>
							</a>
							<div class="p-2">
								<p>liked your post</p>
								<small>${like.created_at}</small>
							</div>
							<div class="p-2">
								<img class="img-fluid w-100" style="height: 50px;" src="${ADDRESS}/storage/images/${images[0]}" />
							</div>								
						</div>
					</div>
				`;				
			})
			displayNotificationsDIV += "<hr>";

			comments.map(comment => {
				images = JSON.parse(comment.images);
				displayNotificationsDIV +=	`
					<div class="dropdown-item">
						<div class="d-flex flex-row justify-content-between">
							<a class="p-2" href="${ADDRESS}//${comment.firstname}.${comment.lastname}/${comment.notification_from}">
								<img class="img-fluid w-100" style="height: 50px;" src="${ADDRESS}/storage/images/${comment.profile_image}" />
								<p>${comment.firstname} ${comment.lastname}</p>
							</a>
							<div class="p-2">
								<a href="${ADDRESS}//notifications/${comment.notifyID}">commented on your post</a>
								<p>${comment.created_at}</p>
							</div>
							<div class="p-2">
								<img class="img-fluid w-100" style="height: 50px;" src="${ADDRESS}/storage/images/${images[0]}" />
							</div>
						</div>
					</div>
				`;
			})
			showNotificationsDIV.innerHTML = displayNotificationsDIV;
		});			
	}

};

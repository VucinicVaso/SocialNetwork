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
		const CSRF_TOKEN         = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		let showNotifications    = document.querySelector("#show-notifications");
		let displayNotifications = "";

		fetch(ADDRESS + "/notifications/index/get", {
			method: 'GET',
		    headers: {
		    	'X-CSRF-TOKEN': CSRF_TOKEN
		    },
		}).then(response => response.json())
		.then(data => {
			const { notifications } = data;			

			if(notifications.length > 0) {
				
				notifications.map(notification => {
					images = JSON.parse(notification.images);
					if(notification.type === "like"){
						displayNotifications +=	`
							<div class="dropdown-item">
								<div class="row">
									<a class="col-md-3" href="${ADDRESS}/${notification.firstname}.${notification.lastname}/${notification.notification_from}">
										<img class="w-100" style="height: 50px;" src="${ADDRESS}/storage/images/${notification.profile_image}" />
										<p>${notification.firstname} ${notification.lastname}</p>
									</a>
									<div class="col-md-6">
										<a href="${ADDRESS}/notifications/likes">liked your post</a>
										<p>${notification.created_at}</p>
									</div>
									<div class="col-md-3">
										<img class="w-100" style="height: 50px;" src="${ADDRESS}/storage/images/${images[0]}" />
									</div>								
								</div>
							</div>
						`;
					}else if(notification.type === "comment"){
						displayNotifications +=	`
							<div class="dropdown-item">
								<div class="row">
									<a class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12" href=${ADDRESS}//${notification.firstname}.${notification.lastname}/${notification.notification_from}">
										<img class="w-100" style="height: 50px;" src="${ADDRESS}/storage/images/${notification.profile_image}" />
										<p>${notification.firstname} ${notification.lastname}</p>
									</a>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
										<a href="${ADDRESS}//notifications/comments">commented on your post</a>
										<p>${notification.created_at}</p>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
										<img class="w-100" style="height: 50px;" src="${ADDRESS}/storage/images/${images[0]}" />
									</div>
								</div>
							</div>
						`;
					}
					showNotifications.innerHTML = displayNotifications;
				})
			}
			
		});			
	}

};
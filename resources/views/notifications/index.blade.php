@extends('layouts.app')

@section('content')

	<div class="container">
	    <div class="row justify-content-left mt-2">
	        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">

	        	@if(!empty($likes))
	        		<h1>Notifications: Likes ({{ count($likes) }})</h1>
	        		<hr>
	        		@foreach($likes as $like)
	        		<div class="row mb-4">
	        			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 card">
	        				<div class="card-body d-flex flex-column">
	        					<p class="p-2">
	        						<a href="{{ url($like->user->firstname.".".$like->user->lastname."/".$like->notification_from) }}">{{ $like->user->firstname }} {{ $like->user->lastname }}</a> liked your post
	        					</p>
	        					<p class="p-2">{{ $like->created_at }}</p>
	        					<div class="p-2">
	        						<img src="{{ url('storage/images') }}/{{ json_decode($like->post->images)[0] }}" class="img-fluid w-100" style="height: 200px;">
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        		@endforeach
	        	@else
	        	@endif

	        	@if(!empty($comments))
	        		<h1>Notifications: Comments ({{ count($comments) }})</h1>
	        		<hr>	        	
	        		@foreach($comments as $comment)
	        		<div class="row mb-4">
	        			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 card">
	        				<div class="card-body d-flex flex-column">
	        					<p class="p-2">
	        						<a href="{{ url($comment->user->firstname.".".$comment->user->lastname."/".$comment->notification_from) }}">{{ $comment->user->firstname }} {{ $comment->user->lastname }}</a>  commented on your post
	        					</p>
	        					<p class="p-2">{{ $comment->created_at }}</p>
	        					<div class="p-2">
	        						<img src="{{ url('storage/images') }}/{{ json_decode($comment->post->images)[0] }}" class="img-fluid w-100" style="height: 200px;">
	        					</div>
	        					<p class="p-2"><b>Comment:</b> {{ $comment->comment->comment }}</p>
	        				</div>
	        			</div>
	        		</div>
	        		@endforeach
	        	@else
	        	@endif

	        </div>
	    </div>
	</div>

@endsection

@extends('layouts.app')

@section('content')

	<div class="container">
	    <div class="row justify-content-left mt-2">
	        <div class="col-md-8">

	        	@if(!empty($likes))
	        		<h1>Notifications: Likes ({{ count($likes) }})</h1>
	        		<hr>
	        		@foreach($likes as $like)
	        		<div class="row mb-4">
	        			<div class="col-md-12 card">
	        				<div class="card-header">
	        					<p>
	        						<a href="{{ url($like->user->firstname.".".$like->user->lastname."/".$like->notification_from) }}">{{ $like->user->firstname }} {{ $like->user->lastname }}</a> 
	        					liked your post</p>
	        					<p>{{ $like->created_at }}</p>
	        				</div>
	        				<div class="card-body">
	        					<img src="{{ url('storage/images') }}/{{ json_decode($like->post->images)[0] }}" class="w-100" style="height: 200px;">
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
	        			<div class="col-md-12 card">
	        				<div class="card-header">
	        					<p>
	        						<a href="{{ url($comment->user->firstname.".".$comment->user->lastname."/".$comment->notification_from) }}">{{ $comment->user->firstname }} {{ $comment->user->lastname }}</a> 
	        					commented on your post</p>
	        					<p>{{ $comment->created_at }}</p>
	        				</div>
	        				<div class="card-body">
	        					<img src="{{ url('storage/images') }}/{{ json_decode($comment->post->images)[0] }}" class="w-100" style="height: 200px;">
	        				</div>
	        				<div class="card-footer">
	        					<p><b>Comment:</b> {{ $comment->comment->comment }}</p>
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

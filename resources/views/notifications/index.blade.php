@extends('layouts.app')

@section('content')

	<div class="container">
	    <div class="row justify-content-left mt-2">
	        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">

	        	@if(!empty($comment))
	        		<h1>Comment from {{ $comment->firstname }} {{ $comment->lastname }}</h1>
	        		<hr>
	        		<div class="row mb-4">
	        			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 card">
	        				<div class="card-body d-flex flex-column">
	        					<p class="p-2">
	        						<a href="{{ url($comment->firstname.".".$comment->lastname."/".$comment->user_id) }}">{{ $comment->firstname }} {{ $comment->lastname }}</a> commented on your post
	        					</p>
	        					<p class="p-2">{{ $comment->created_at }}</p>
	        					<div class="p-2">
	        						<img src="{{ url('storage/images') }}/{{ json_decode($comment->images)[0] }}" class="img-fluid w-100" style="height: 200px;">
	        					</div>
	        					<p class="p-2"><b>Comment:</b> {{ $comment->comment }}</p>
	        				</div>
	        			</div>
	        		</div>
	        	@else
	        	@endif

	        </div>
	    </div>
	</div>

@endsection

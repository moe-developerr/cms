@extends('layouts.cms-master')

@section('title', 'Images Listing')

@section('content')
	<div class="container">
		@if(!count($images))
			<h1>No Images Found</h1>
		@else
			<h1>Images Listing</h1>
			<ol class="list-unstyled">
				@foreach($images as $image)
					<li><a href="{{ url('cms/images/'.$image->id).'/edit' }}">{{ $image->src }}</a></li>
				@endforeach
			</ol>
		@endif
	</div>
@stop
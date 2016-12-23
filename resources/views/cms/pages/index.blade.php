@extends('layouts.cms-master')

@section('title', 'Pages Listing')

@section('content')
	<div class="container">
		@if(!count($pages))
			<h1>No Pages Found</h1>
		@else
			<h1>Pages Listing</h1>
		@endif
		<a href="{{ route('cms.pages.create') }}" class="btn btn-primary">CREATE</a>
	</div>
@stop
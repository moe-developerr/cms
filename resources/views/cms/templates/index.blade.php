@extends('layouts.cms-master')

@section('title', 'Templates Listing')

@section('content')
	<div class="container">
		@if(!count($templates))
			<h1>No Templates Found</h1>
		@else
			<h1>Templates Listing</h1>
			<ol class="list-unstyled">
				@foreach($templates as $template)
					<li><a href="{{ url('cms/templates/'.$template->id).'/edit' }}">{{ $template->name }}</a></li>
				@endforeach
			</ol>
		@endif
		<a href="{{ route('cms.templates.create') }}" class="btn btn-primary">CREATE</a>
	</div>
@stop
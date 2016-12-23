@extends('layouts.master')

@section('title', $page->title)

@section('content')
	<div class="container">
		<h1>{{ $page-title }}</h1>

		<div class="row">
			@foreach($page->images as $image)
				<div class="col-s-4"><img src="{{ $image->src }}" alt="" class="img-responsive"></div>
			@endforeach
			@foreach($page->texts as $text)
				<div class="col-s-4">$text->content</div>
			@endforeach
		</div>
	</div>
@stop
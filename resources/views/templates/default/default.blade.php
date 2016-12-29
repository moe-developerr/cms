@extends('layouts.master')

@section('title', $page->title)

@section('content')
	<div class="container">
		<h1>{{ $page->title }}</h1>

		<div class="row">
			<div class="col-xs-12"><img src="{{ $page->content->top_image }}" alt="" class="img-responsive"></div>
			<div class="col-xs-12">{{ $page->content->top_text }}</div>
		</div>
	</div>
@stop
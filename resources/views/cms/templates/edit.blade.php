@extends('layouts.cms-master')

@section('title', $template->name)

@section('content')
	<div class="container">
		<h1>{{ $template->name }}</h1>
		<form action="{{ url('cms/templates/'.$template->id) }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="template-name">Template Name</label>
				<input type="text" name="name" id="template-name" class="form-control" value="{{ $template->name }}">
			</div>
			<div class="form-group">
				<label for="template-images">Number Of Images</label>
				<input type="text" name="nb_of_images" id="template-images" class="form-control" value="{{ $template->nb_of_images }}">
			</div>
			<div class="form-group">
				<label for="template-texts">Number Of Texts</label>
				<input type="text" name="nb_of_texts" id="template-texts" class="form-control" value="{{ $template->nb_of_texts }}">
			</div>
			<button class="btn btn-primary">UPDATE</button>
		</form>
	</div>
@stop
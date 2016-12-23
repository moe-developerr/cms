@extends('layouts.cms-master')

@section('title', 'Create Template')

@section('content')
	<div class="container">
		<h1>Create Template</h1>
		<form action="{{ route('cms.templates.store') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="template-name">Template Name</label>
				<input type="text" name="name" id="template-name" class="form-control">
			</div>
			<div class="form-group">
				<label for="template-images">Number Of Images</label>
				<input type="text" name="nb_of_images" id="template-images" class="form-control">
			</div>
			<div class="form-group">
				<label for="template-texts">Number Of Texts</label>
				<input type="text" name="nb_of_texts" id="template-texts" class="form-control">
			</div>
			<button class="btn btn-primary">STORE</button>
		</form>
	</div>
@stop
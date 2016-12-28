@extends('layouts.cms-master')

@section('title', 'Create Template')

@section('content')
	<div class="container">
		<h1>Create Template</h1>
		<form action="{{ route('cms.templates.store') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="template-name">Name</label>
				<input type="text" name="name" id="template-name" class="form-control">
			</div>
			<div class="form-group">
				<label for="template-layout">Layout</label>
				<textarea name="layout" id="template-layout" cols="30" rows="10" class="form-control fz--30"></textarea>
			</div>
			<button class="btn btn-primary">STORE</button>
		</form>
	</div>
@stop
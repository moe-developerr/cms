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
				<label for="template-layout">Layout</label>
				<input type="text" name="layout" id="template-layout" class="form-control" value="{{ $template->layout }}">
			</div>
			<button class="btn btn-primary">UPDATE</button>
		</form>
		<form action="{{ url('cms/templates/'.$template->id) }}" method="POST" class="m--t1-5">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<input type="hidden" name="is_ajax" value="false">
			<button class="btn btn-danger">DELETE</button>
		</form>
	</div>
@stop
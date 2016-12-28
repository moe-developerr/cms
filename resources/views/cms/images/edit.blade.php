@extends('layouts.cms-master')

@section('title', $image->src)

@section('content')
	<div class="container">
		<h1>{{ $image->name }}</h1>
		<form action="{{ url('cms/images/'.$image->id) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('DELETE') }}
			<input type="hidden" name="is_ajax" value="0">
			<div class="form-group">
				<img src="/uploads/images/{{ $image->category.'/'.$image->src }}" alt="" class="img-responsive">
			</div>
			<button class="btn btn-danger">DELETE</button>
		</form>
	</div>
@stop
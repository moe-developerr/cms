@extends('layouts.cms-master')

@section('title', 'Create Page')

@section('content')
	<div class="container">
		<h1>Create Page</h1>
		<br>
		<form action="{{ route('cms.pages.store') }}" method="POST" class="row">
			{{ csrf_field() }}
			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Page Settings</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="template">Choose Template</label>
							<select name="template_id" id="template" class="form-control" required>
								@foreach($templates as $template)
									<option value="{{ $template->id }}">{{ $template->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="page-name">Page Name</label>
							<input type="text" name="name" id="page-name" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="page-slug">Page Slug</label>
							<input type="text" name="slug" id="page-slug" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="page-title">Page Title</label>
							<input type="text" name="title" id="page-title" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="meta-description">Meta Description</label>
							<input type="text" name="meta_description" id="meta-description" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="page-visibility">Page Visibility</label>
							<select name="is_visible" id="page-visibility" class="form-control" required>
								<option value="0">0</option>
								<option value="1" selected>1</option>
							</select>
						</div>
						<div class="form-group">
							<label for="page-parent">Choose Parent</label>
							<select name="parent_id" id="page-parent" class="form-control" required>
								<option value="0" selected>Default</option>
								@foreach($pages as $page)
									<option value="{{ $page->parent_id }}">{{ $page->name }}</option>
								@endforeach
							</select>
						</div>
						<button class="btn btn-primary">STORE</button>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Page Content</h3>
					</div>
					<div class="panel-body page-content">
						<div class="form-group">
							<label>Top Image</label>
							<br>
							<button type="button" class="btn btn-danger gallery-owner" data-name="Top Image" data-select-multiple>Select Image</button>
							<br>
							<br>
							<div class="selected-images"><div class="row"></div></div>
						</div>
						<div class="form-group">
							<label>Top Text</label>
							<textarea name="content['top_text']" id="" cols="30" rows="10" class="form-control" style="resize: vertical;" required></textarea>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="gallery">
		<button type="button" class="close" aria-label="Close"><span aria-hidden="true" class="dis--ib">&times;</span></button>
		<div class="container">
			<div class="row">
				<div class="col-xs-12"><h2>Small</h2></div>
				@foreach($small as $sm)
					<div class="col-xs-6 col-sm-3"><img src="/uploads/images/small/{{ $sm->src }}" data-id="{{ $sm->id }}" alt="" class="img-responsive image selected"></div>
				@endforeach
				<div class="col-xs-12"><hr><h2>Medium</h2></div>
				@foreach($medium as $md)
					<div class="col-xs-6 col-sm-3"><img src="/uploads/images/medium/{{ $md->src }}" data-id="{{ $md->id }}" alt="" class="img-responsive image selected"></div>
				@endforeach
				<div class="col-xs-12"><hr><h2>Large</h2></div>
				@foreach($large as $lg)
					<div class="col-xs-6 col-sm-3"><img src="/uploads/images/large/{{ $lg->src }}" data-id="{{ $lg->id }}" alt="" class="img-responsive image selected"></div>
				@endforeach
				<div class="col-xs-12"><hr><h2>Default</h2></div>
				@foreach($default as $df)
					<div class="col-xs-6 col-sm-3"><img src="/uploads/images/default/{{ $df->src }}" data-id="{{ $df->id }}" alt="" class="img-responsive image selected"></div>
				@endforeach
			</div>
		</div>
	</div>
@stop
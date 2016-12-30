@extends('layouts.cms-master')

@section('title', 'Edit Page')

@section('content')
	<div class="container">
		<h1>Edit Page</h1>
		<br>
		<form action="/cms/pages/{{ $myPage->id }}" method="POST" class="row">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
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
									<option value="{{ $template->id }}" {{ $template->id == $myPage->template ? 'selected' : '' }}>{{ $template->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="page-name">Page Name</label>
							<input type="text" name="name" id="page-name" class="form-control" value="{{ $myPage->name }}" required>
						</div>
						<div class="form-group">
							<label for="page-slug">Page Slug</label>
							<input type="text" name="slug" id="page-slug" class="form-control" value="{{ $myPage->slug }}">
						</div>
						<div class="form-group">
							<label for="page-title">Page Title</label>
							<input type="text" name="title" id="page-title" class="form-control" value="{{ $myPage->title }}">
						</div>
						<div class="form-group">
							<label for="meta-description">Meta Description</label>
							<input type="text" name="meta_description" id="meta-description" class="form-control" value="{{ $myPage->meta_description }}">
						</div>
						<div class="form-group">
							<label for="page-visibility">Page Visibility</label>
							<select name="is_visible" id="page-visibility" class="form-control">
								<option value="0" {{ $myPage->is_visible == 0 ? 'selected' : '' }}>0</option>
								<option value="1" {{ $myPage->is_visible == 1 ? 'selected' : '' }}>1</option>
							</select>
						</div>
						<div class="form-group">
							<label for="page-parent">Choose Parent</label>
							<select name="parent_id" id="page-parent" class="form-control">
								@foreach($pages as $page)
									<option value="{{ $page->parent_id }}" {{ $myPage->parent_id == $page->parent_id ? 'selected' : '' }}>{{ $page->name }}</option>
								@endforeach
							</select>
						</div>
						<button class="btn btn-primary">UPDATE</button>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Page Content</h3>
					</div>
					<div class="panel-body page-content"></div>
				</div>
			</div>
		</form>
	</div>
@stop

@section('scripts')
	<script src="/js/vendors/dropzone.js"></script>
	<script>
		(function () {
			run();

			function run()
			{
				Dropzone.autoDiscover = false;
				attachEvents();
			}

			function attachEvents()
			{
				$('#template').change(loadTemplateForm).change();
			}

			function loadTemplateForm()
			{
				// $('.page-content').load('/cms/templates/' + $(this).val());
			}
		})();
	</script>
@stop
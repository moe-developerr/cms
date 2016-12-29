@extends('layouts.cms-master')

@section('title', 'Create Template')

@section('content')
	<div class="container">
		<h1>Create Template</h1>
		<form action="{{ route('cms.templates.store') }}" method="POST" class="dropzone" id="layoutFile">
			{{ csrf_field() }}
			<input type="hidden" name="is_ajax" value="true">
			<div class="form-group">
				<label for="template-name">Name</label>
				<input type="text" name="name" id="template-name" class="form-control" required>
			</div>
		</form>
		<div class="jumbotron">
            <ul>
                <li>File is uploaded as soon as you drop it</li>
            </ul>
        </div>
		<h2 class="success text-success hidden"></h2>
		<h2 class="error text-danger hidden"></h2>
	</div>
@stop

@section('scripts')
	<script src="/js/vendors/dropzone.js"></script>
	<script>
		(function () {
			run();

			function run()
			{
				setDropzoneOptions();
			}

			function setDropzoneOptions()
			{
				var deletePromise, uploadPromise;
				var $success = $('.success');
				var $error = $('.error');
				Dropzone.options.layoutFile = {
				    maxFiles: 1,
				    acceptedFiles: '.html',
				    paramName: 'layoutFile',
				    uploadMultiple: false,
				    parallelUploads: 100,
				    addRemoveLinks: true,
				    dictRemoveFile: 'Remove',
				    dictDefaultMessage: 'Drop layout file here to upload',

				    init: function() {
				        this.on("removedfile", function(file) {
				            var id = $(file.previewTemplate).attr('data-id');
				            $.ajax({
				                url: '/cms/templates/'+id,
				                method: 'DELETE',
				                data: { id: id },
				                error: function (r) {
				    				$error.text('Failed to Delete').removeClass('hidden');
									clearTimeout(uploadPromise);
				                	deletePromise = setTimeout(function () {
				                		$success.add($error).addClass('hidden');
				                	}, 3000);
				                },
				                success: function(r) {
				                	if(r == 1) {
				                		$success.text('Successful delete').removeClass('hidden');
				                		$('#template-name').val('');
				                	}
				                	else $error.text('Failed to delete').removeClass('hidden');

				                	clearTimeout(uploadPromise);
				                	deletePromise = setTimeout(function () {
				                		$success.add($error).addClass('hidden');
				                	}, 3000);
				                }
				            });
				        });
				    },
				    error: function(file, response) {
				    	$error.text('Failed to Upload').removeClass('hidden');
				    	clearTimeout(deletePromise);
	                	uploadPromise = setTimeout(function () {
	                		$success.add($error).addClass('hidden');
	                	}, 3000);
				    },
				    success: function(file, r) {
				    	if(typeof r.name == 'string' && r.name != '') {
				    		$(file.previewTemplate).attr('data-id', r.id);
				    		$success.text('Successful Upload').removeClass('hidden');
				    	}
	                	else $error.text(r.message).removeClass('hidden');

				        clearTimeout(deletePromise);
	                	uploadPromise = setTimeout(function () {
	                		$success.add($error).addClass('hidden');
	                	}, 3000);
				    }
				};
			}
		})();
	</script>
@stop
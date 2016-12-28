@extends('layouts.cms-master')

@section('title', 'Upload Images')

@section('content')
	<div class="container">
		<h1>Upload Images</h1>
		<form action="{{ route('cms.images.store') }}" class="dropzone" id="uploadImage">
			{{ csrf_field() }}
		</form>
		<div class="jumbotron">
            <ul>
                <li>Images are uploaded as soon as you drop them</li>
                <li>Maximum allowed size of image is 8MB</li>
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
				Dropzone.options.uploadImage = {
				    paramName: 'image',
				    uploadMultiple: false,
				    parallelUploads: 100,
				    maxFilesize: 8,
				    addRemoveLinks: true,
				    dictRemoveFile: 'Remove',
				    dictFileTooBig: 'Image is bigger than 8MB',

				    init: function() {
				        this.on("removedfile", function(file) {
				            var id = $(file.previewTemplate).attr('data-id');
				            $.ajax({
				                url: '/cms/images/'+id,
				                method: 'DELETE',
				                data: { id: id, is_ajax: 1 },
				                error: function (r) {
				    				$error.text('Failed to Delete').removeClass('hidden');
									clearTimeout(uploadPromise);
				                	deletePromise = setTimeout(function () {
				                		$success.add($error).addClass('hidden');
				                	}, 3000);
				                },
				                success: function(r) {
				                	console.log(r)
				                	if(r == 1) $success.text('Successful delete').removeClass('hidden');
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
				    	if(typeof r.src == 'string' && r.src != '') {
				    		$(file.previewTemplate).attr('data-id', r.id);
				    		$success.text('Successful Upload').removeClass('hidden');
				    	}
	                	else $error.text('Failed to Upload').removeClass('hidden');

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
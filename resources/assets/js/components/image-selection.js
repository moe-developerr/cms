// Image selection module
// <div class="col-xs-6 m--b1"><img src="/uploads/images/default/2016_12_28_1482929557_bg.jpg" alt="" class="img-responsive"></div>

(function ($doc) {
	var selected = {};
	var owner = '';
	run();

	function run()
	{
		attachEvents();
	}

	function attachEvents()
	{
		$doc.on('click', '.gallery-owner', singleSelection);
		$doc.on('click', '.gallery-owner[data-multiple-select]', multipleSelection);
	}
	
	function setOwner(owner) { owner = owner; }
	function setOwnerSelections()
	{
		
	}
	function showGallery() { $('.gallery').addClass('visible');	}

	

	function clearSelected() { $('.gallery .image.selected').removeClass('selected'); }

	function selectImage()
	{
		var $image = $(this);
		$image.addClass('selected');
		selected[owner].push($image.attr('src'));
	}

	function hideGallery() { $('.gallery').removeClass('visible'); }
	

})($(document));
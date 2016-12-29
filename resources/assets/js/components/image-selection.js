// Image selection module

(function ($doc) {
	var selections = {};
	var owner = '';
	run();

	function run()
	{
		attachEvents();
	}

	function attachEvents()
	{
		var $gallery = $('.gallery');
		$doc.on('click', '.gallery-owner', showGallery);
		$gallery.find('.close').click(hideGallery);
		$gallery.find('.image').click(toggleSelectedImage);
	}

	function showGallery()
	{
		owner = $(this).attr('data-name');
		$('body').addClass('overflow--h');
		$('.gallery').addClass('visible overflow--ya');
		highlightOwnerImages();
	}

	function hideGallery() {
		$('body').removeClass('overflow--h');
		$('.gallery').removeClass('visible')
			.find('.image.selected').removeClass('selected');
	}

	function toggleSelectedImage()
	{
		var $image = $(this);
		if($image.hasClass('selected')) deselectImage($image);
		else selectImage($image);
	}

	function highlightOwnerImages()
	{
		if(ownerIsDefined() && ownerHasSelections()) {
			$images = $('.gallery .image');
			$.each(selections[owner].src, function (i, src) {
				$images.filter('[src="' + src +'"]').addClass('selected');
			});
		}
	}
	
	function selectImage($image)
	{
		if((isSingleSelect() && isStorageLessThan1()) || !isSingleSelect()) {
			var src = $image.attr('src');
			$image.addClass('selected');
			if(!ownerIsDefined()) selections[owner] = {};
			if(!ownerHasSelections()) {
				selections[owner].src = [];
				selections[owner].id = [];
			}
			selections[owner].src.push(src);
			selections[owner].id.push($image.attr('data-id'));
			showSelectedImage(src);
		}
	}

	function deselectImage($image)
	{
		var src = $image.attr('src');
		var index = selections[owner].src.indexOf(src);
		$image.removeClass('selected');
		if(index !== -1) {
			selections[owner].src.splice(index, 1);
			selections[owner].id.splice(index, 1);
		}
		removeSelectedImage(src);
	}

	function showSelectedImage(src)
	{
		var $imagesRow = $('.gallery-owner[data-name="'+owner+'"]').closest('.form-group').find('.selected-images .row');
		if($imagesRow.find('.col-xs-6').length % 2 == 0) {
			$imagesRow.append('<div class="col-xs-6 clear--l"><img src="'+src+'" class="img-responsive"></div>');
		}
		else {
			$imagesRow.append('<div class="col-xs-6"><img src="'+src+'" class="img-responsive"></div>');
		}
	}

	function removeSelectedImage(src)
	{
		var $imagesRow = $('.gallery-owner[data-name="'+owner+'"]').closest('.form-group').find('.selected-images .row');
		$imagesRow.find('img[src="'+src+'"]').closest('.col-xs-6').remove();
	}

	function hasAttr($elem, attr)
	{
		if(typeof $elem.attr(attr) !== typeof undefined && $elem.attr(attr) !== false) return true;
		return false;
	}

	function isSingleSelect()
	{
		return !hasAttr($('.gallery-owner[data-name="'+owner+'"]'), 'data-multiple-select');
	}

	function isStorageLessThan1()
	{
		if(ownerIsDefined()) return selections[owner].src.length < 1;
		else return true;
	}

	function ownerIsDefined()
	{
		return typeof selections[owner] !== typeof undefined;
	}

	function ownerHasSelections()
	{
		return (typeof selections[owner].src !== typeof undefined) && selections[owner].src.length > 0;
	}

})($(document));
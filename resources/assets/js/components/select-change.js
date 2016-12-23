(function () {
	run();

	function run()
	{
		attachEvents();
	}

	function attachEvents()
	{
		$('#template').change(loadPageContent);
	}

	function loadPageContent()
	{
		$.ajax({
			// url: 'cms/pages/'
		});
	}
})();
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
		$('.page-content').load('/resources/views/templates/load.html', function () {
			console.log('loaded html');
		});
	}
})();
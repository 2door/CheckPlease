$(document).ready( function() {
	$(document).on('click','#select', function() {
		$('.dropdown').fadeIn(100).css('display','block');
	});
	$(document.body).click( function(e) {
		if ($(e.target).attr('class') === ".dropdown")
		    return;

	    $('.dropdown').fadeOut(100);
	});
});
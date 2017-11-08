$(document).ready(function() {
	$(document).on('click','.deleteGroup', function() {
		group_id = event.target.id;
		$('#deleteG').removeClass().addClass(group_id);
		$('.modal_deleteG').fadeIn().css('display','block');
		return false;
	});

	$(document).on('click','input#cancelG', function() {
		$('.modal_deleteG').fadeOut();
    	return false;
	});

	$(document).on('click', 'input#deleteG', function() {
		group_id = $(event.target).attr('class');
		$.post("deleteG.php", { group_id: group_id }, function() {
			location.reload();
			return false;
		});
	});
});
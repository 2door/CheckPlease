$(document).ready(function () {
	$(document).on('click','.deleteBill', function() {
		bill_id = event.target.id;
		$('#deleteB').removeClass().addClass(bill_id);
		$('.modal_deleteB').fadeIn().css('display','block');
		return false;
	});

	$(document).on('click','input#cancelB', function() {
    	$('.modal_deleteB').fadeOut();
    	return false;
    });

    $(document).on('click', 'input#deleteB', function() {
    	bill_id = $(event.target).attr('class');
    	$.post("deleteB.php", { bill_id: bill_id }, function() {
    		location.reload();
    		return false;
    	});
    });

});
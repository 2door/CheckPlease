$(document).ready(function () {
	$(document).on('click','img.add', function() {
		$('#bill_name').val("");
		$('#bill_amount').val("");
    	$('#bill_name').css('background','#cde855');
    	$('#bill_amount').css('background','#cde855');
    	$('.modal_bill').fadeIn().css('display','block');
    	group_id = event.target.id;
    	$('#addBill').removeClass().addClass(group_id);
        return false;
	});

	$(document).on('click', 'input#cancelBill', function() {
    	$('.modal_bill').fadeOut();
    	return false;
    });

    $(document).on('click', 'input#addBill', function() {
    	bill_name = $("#bill_name").val();
    	bill_amount = $("#bill_amount").val();
    	if(bill_name == ''){
    		alert("Bill name must not be empty");
    		$('#bill_name').css('background','#FF8684');
    		return false;
    	}
    	if(bill_amount == ''){
    		alert("Bill amount must not be empty");
    		$('#bill_amount').css('background','#FF8684');
    		return false;
    	}
	    else {
	    	group_id = $(event.target).attr('class');
	    	//fade out popup
	    	$('.modal_bill').fadeOut();
	    	//create the group in table
	    	$.post("addBill.php", { bill_name: bill_name, group_id: group_id, bill_amount: bill_amount }, function() {
	    		location.reload();
	    		return false;
	    	});   	
		}
    });

    $(document).on('click','input.check', function() {
    	payee_id = event.target.id;
    	if(event.target.checked) {
    		$.post("changePayee.php", { payee_id: payee_id, payed: 1 });
    	}
    	else {
    		$.post("changePayee.php", { payee_id: payee_id, payed: 0 });
    	}
    });
});
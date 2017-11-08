$(document).ready( function() {
	$(document).on('click','img.addm', function() {
		$('#member_email').val("");
    	$('#member_email').css('background','#cde855');
    	$('.modal_member').fadeIn().css('display','block');
    	group_id = event.target.id;
    	$('#addMember').removeClass().addClass(group_id);
        return false;
	});

	$(document).on('click', 'input#cancelMember', function() {
    	$('.modal_member').fadeOut();
    	return false;
    });

	$(document).on('click', 'input#addMember', function() {
    	email = $("#member_email").val();
    	if(email == ''){
    		alert("Member e-mail must not be empty");
    		$('#member_email').css('background','#FF8684');
    		return false;
    	}
	    else {
	    	group_id = $(event.target).attr('class');
	    	//fade out popup
	    	$('.modal_member').fadeOut();
	    	//create the group in table
	    	$.post("addMember.php", { email: email, group_id: group_id }, function(responseText) {
	    		$('#members'+group_id).append(responseText);
	    		return false;
	    	});   	
		}
    });
});
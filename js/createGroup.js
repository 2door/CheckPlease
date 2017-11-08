$(document).ready( function() {

    $(document).on('click', 'input.createGroup', function() {
    	//$('#members').html("<input id='member_mail' type='text' name='member_email' maxlength='45' placeholder=' Enter an e-mail address...'><br>");
    	$('#group_name').val("");
    	$('#group_name').css('background','#cde855');
    	$('.modal_group').fadeIn().css('display','block');
        return false;
    });

    $(document).on('click', 'input#cancelGroup', function() {
    	$('.modal_group').fadeOut();
    	return false;
    });

    $(document).on('click', 'input#createGroup', function() {
    	groupName = $("#group_name").val();
    	if(groupName == ''){
    		alert("Group name must not be empty");
    		$('#group_name').css('background','#FF8684');
    		return false;
    		//change bgcolor
    	}
	    else {
	    	//fade out popup
	    	$('.modal_group').fadeOut();
	    	//create the group in table
	    	$.post("createGroup.php", { groupName: groupName }, function() {
	    		location.reload();
	    		return false;
	    	});   	
		}
    });

    /*$(document).on('click', '#addGroup', function() {
    	$('#members').append("<input id='member_mail' type='text' name='member_email' maxlength='45' placeholder=' Enter an e-mail address...'><br>");
    });*/
});
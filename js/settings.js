$(document).ready( function() {
	$(document).on('submit','#changePass', function() {
		$('#new').css('background','#cde855');
		$('#confirm').css('background','#cde855');
		current = $('#current').val();
		newpass = $('#new').val();
		confirm = $('#confirm').val();
		if(confirm == newpass) {
			$.post('changePass.php', { current: current, newpass: newpass, confirm: confirm }, function() {
				$('#current').val('');
				$('#new').val('');
				$('#confirm').val('');
			});
		}
		else {
			alert("New password and confirmation must match");
			$('#new').css('background','#FF8684');
		$('#confirm').css('background','#FF8684');
		}
	});
});
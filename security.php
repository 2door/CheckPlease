<?php
	
     function loggedIn() {
	//returns true if logged in
		if(!isset($_SESSION['id'])){ 
	 	 	return false;
        }else
        	return true;
	}

	function accessResource($resource_user_id) {
	//returns true if user == resource user
		
		if($_SESSION['id'] != $resource_user_id)
			return false;
		else 
			return true; 

	}
	
	function h($string)
	{
		echo htmlspecialchars($string, ENT_QUOTES, 'utf-8');
	}
?>
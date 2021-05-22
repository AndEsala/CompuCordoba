<?php 
	function user_authenticate(){
		if (!review_user()) {
			header('Location:login');
			exit;
		}
	}

	function review_user(){
		return isset($_SESSION['user']);
	}
	
	session_start();
	user_authenticate();
?>
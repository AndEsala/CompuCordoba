<?php 
	$conn = new PDO("mysql:host=localhost; dbname=compucordoba", "root", "");

 	if (!$conn) {
 		echo "error de depuración: " . mysqli_connect_error();
 	}
 ?>
<?php 

	// connect to the database
	$conn = mysqli_connect('localhost', 'user', 'rootuser', 'library');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>
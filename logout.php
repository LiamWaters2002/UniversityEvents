<?php

	session_start();
	session_unset(); //Unset any variables used in $_SESSION
	session_destroy();
	header("Location: index.php");

?>


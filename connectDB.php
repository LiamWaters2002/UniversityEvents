<?php
$host_db = 'localhost';
$name_db = 'id20845463_events';

$userlogin = 'id20845463_users';
$userpass = 'Password123!';

try {
	//Establish a connection with the mySQL database using PHP data object
	$db = new PDO("mysql:dbname=$name_db;host=$host_db", $userlogin, $userpass); 
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch(PDOException $ex) {
	echo("Connection to the Aston Events database has failed. Here is the error:.<br>".$ex->getMessage());
	exit;
}
?>
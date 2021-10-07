<?php
$host_db = 'localhost';
$name_db = 'u_200109921_db';

$userlogin = 'u-200109921';
$userpass = 'wnp6H9HD4FmYQTR';

try {
	//Establish a connection with the mySQL database using PHP data object
	$db = new PDO("mysql:dbname=$name_db;host=$host_db", $userlogin, $userpass); 
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch(PDOException $ex) {
	echo("Connection to the Aston Events database has failed. Here is the error:.<br>".$ex->getMessage());
	exit;
}
?>
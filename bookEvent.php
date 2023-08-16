<?php
session_start();
require_once('connectDB.php');

$userID = $_POST['userID'];
$eventID = $_POST["eventID"];
//Get booked value from the userInterest table
$query = $db->prepare("SELECT booked FROM userInterest WHERE userID = :userID AND eventID = :eventID");
$query->bindParam(":userID", $userID);
$query->bindParam(":eventID", $eventID);
$query->execute();
$row =  $query->fetch();

try {
	if ($row) {

		//Invert the bookings if the user clicks the book button multiple times, this will cancel, or rebook events.
		if ($row['booked'] == 1) {
			$boolBook = 0;
        	echo "Book!";
        	if(isset($row['liked']) && $row['liked'] == 0){ //If liked and booked are false
        		$remRow = $db->prepare("DELETE FROM userInterest WHERE userID = :userID AND eventID = :eventID");
            	$remRow->bindParam(":userID", $userID);
				$remRow->bindParam(":eventID", $eventID);
				$remRow->execute(); //Delete the row for userInterest as liked and booked are both false.
            }
		} else if ($row['booked'] == 0) {
			$boolBook = 1;
        	echo "Booked!";
		}
		//Update the userInterest table so that bookings can be altered.
		$query = $db->prepare("UPDATE userInterest SET booked = :boolBook WHERE userID = :userID AND eventID = :eventID ");
		$query->bindParam(":boolBook", $boolBook);
		$query->bindParam(":userID", $userID);
		$query->bindParam(":eventID", $eventID);
		$query->execute();
		// header("Location: info.php");
	} else {
		//First time clicking book button, sets booked to true.
    	echo "Booked!";
		$query = $db->prepare("INSERT INTO userInterest values(?, ?, ?, ?)");
		$query->execute(array($userID, $eventID, 1, 0));
		// header("Location: info.php");
	}
} catch (PDOexception $ex) {
	echo "error booking an event:<br>";
	echo $ex;
}
?>

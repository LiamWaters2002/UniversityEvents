<?php
session_start();
require_once('connectDB.php');

$eventID = $_POST["eventID"];

$userID = $_POST['userID'];//$row['userID']

//Get liked from the userInterest table.
$query = $db->prepare("SELECT * FROM userInterest WHERE userID = :userID AND eventID = :eventID");
$query->bindParam(":userID", $userID);
$query->bindParam(":eventID", $eventID);
$query->execute();
$row =  $query->fetch();

try {
	if ($row) {
		//Invert the value of liked when button is clicked.
		if ($row['liked'] == 1) {
        	$boolLike = 0;
        	echo "Like!";
        	if($row['booked'] == 0){ //If liked and booked are false
        		$remRow = $db->prepare("DELETE FROM userInterest WHERE userID = :userID AND eventID = :eventID");
            	$remRow->bindParam(":userID", $userID);
				$remRow->bindParam(":eventID", $eventID);
				$remRow->execute(); //Delete the row for userInterest as liked and booked are both false.
            }
        	
		} else if ($row['liked'] == 0) {
			$boolLike = 1;
        	echo "Liked!";
		}

    	//Update the value of liked to true or false.
		$query = $db->prepare("UPDATE userInterest SET liked = :boolLike WHERE userID = :userID AND eventID = :eventID ");
		$query->bindParam(":boolLike", $boolLike);
		$query->bindParam(":userID", $userID);
		$query->bindParam(":eventID", $eventID);
		$query->execute();
	} else {
		$like = $db->prepare("INSERT INTO userInterest values(?, ?, ?, ?)");
		$like->execute(array($userID, $eventID, 0, 1));
		echo "Liked!";
	}
} catch (PDOexception $ex) {
}

?>
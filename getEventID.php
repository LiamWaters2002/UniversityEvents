<?php

session_start();

if($_POST){
    require_once('connectDB.php');
    $query = ("SELECT MAX(eventID) FROM events"); //Get the ID of the event with the largest ID.
    $result = $db->query($query);
    $id =  $result->fetch();
    for($i = 0; $i <= $id['0']; $i++){ //Go through every eventID
        if(isset($_POST[$i])){
            $_SESSION["eventID"]=$i; //Set the session eventID to the id which has been submitted through the form.
            header("Location: info.php");
        }
    }
}
?>
<?php
require_once('connectDB.php');
include 'validation.php';

//Check if all credentials have been filled in, and clears any special characters used within the user input.
$forename = clearUserInput(isset($_POST['forename']) ? $_POST['forename'] : false);
$surname = clearUserInput(isset($_POST['surname']) ? $_POST['surname'] : false);
$phone = clearUserInput(isset($_POST['phone']) ? $_POST['phone'] : false);
$email = clearUserInput(isset($_POST['email']) ? $_POST['email'] : false);
$password = isset($_POST['password']) ? $_POST['password'] : false;

$email = filter_var($email, FILTER_SANITIZE_EMAIL); //Removes illegal characters of email 

// PHP Validation
$forenameError = validateName($forename, "Forename");
$surnameError = validateName($surname, "Surname");
$phoneError = validatePhone($phone);
$emailError = validateEmail($db, $email);
$passwordError = validatePassword($password);

//Hash Password
$password = password_hash($password, PASSWORD_DEFAULT);

//If an error has been assigned an error message, echo the message.
if (!empty($forenameError) || !empty($surnameError) || !empty($surnameError) || !empty($phoneError) || !empty($emailError) || !empty($passwordError)) {

	echo "<div id = error_bar>";
	if (!empty($forenameError)) {
		echo nl2br($forenameError . "\n");
	} //Echo error, and add a new line for next message.
	if (!empty($surnameError)) {
		echo nl2br($surnameError . "\n");
	}
	if (!empty($phoneError)) {
		echo nl2br($phoneError . "\n");
	}
	if (!empty($emailError)) {
		echo nl2br($emailError . "\n");
	}
	if (!empty($passwordError)) {
		echo nl2br($passwordError);
	}
	echo "</div>";

	include 'index.php';

	exit;
}


try {

	//register user by inserting the user info 
	$stat = $db->prepare("INSERT INTO accounts VALUES(?, ?, ?, ?, ?, default)");
	$stat->execute(array($forename, $surname, $phone, $email, $password));

	session_start();
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['forename'] = $_POST['forename'];
	$_SESSION['surname'] = $_POST['surname'];
	// $_SESSION["order"] = "ascending"; //set order when you first login.
	header("Location: events.php");
	exit();
} catch (PDOexception $ex) {
	echo "There was a problem with connecting to the database and an error occurred! <br>";
	echo "See the error details here: <em>" . $ex->getMessage() . "</em>";
}
?>
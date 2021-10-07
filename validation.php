<?php

//Changes predefiend characters into HTML entities. Remove unecessary charaters within the string.
function clearUserInput($string)
{
	$string = htmlspecialchars($string);
	$string = trim($string);

	return $string;
}





function validateName($name, $lblName)
{
	//Validating Forename
	$invalid = "/^[0-9]+/";
	if (!($name)) {
		$error = $lblName . " was left blank. Please enter your " . $lblName . "!";
	} else if (preg_match($invalid, $name)) {
		$error =  "Your " . $lblName . " cannot contain numbers.";
	}

	if ($error != "" && $lblName = "Forename") {
		return $error;
	} elseif ($error != "" && $lblName = "Surname") {
		return $error;
	}
	return null;
}



function validatePhone($phone)
{
	//Validating Phone Number
	$pattern = "/^[0-9]+$/";
	$phoneError = "";
	if (!($phone)) {
		$phoneError = "Phone Number was left blank. Please enter your Phone Number!";
	} else if (!preg_match($pattern, $phone)) {
		$phoneError = "Phone Number must only contain numbers!";
	} else if (strlen($phone) != 11) { //Length must = 11
		$phoneError = "Phone Number must contain 11 numbers!";
	}
	return $phoneError;
}

function validateEmail($db, $email)
{
	//Validating Email

	$pattern = "/\S+@\S+\.\S+/";
	$emailError = "";
	// $test = test_input($email);
	if (!($email)) {
		$emailError =  "Email was left blank. Please enter your Email!";
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailError =  $email . " is not a valid emaill address";
	}
	// else if(!preg_match($pattern, $email)){//Make sure it is an aston email address, and make sure it does not include special characters.
	// 	$emailError =  $email." is not an aston emaill address.";
	// }
	else if (isEmailInUse($db, $email)) {
		$emailError = "An account already uses the email: " . $email . ".";
	}
	return $emailError;
}

function validatePassword($password)
{
	$lower = "/[a-z]/";
	$upper = "/[A-Z]/";
	$number = "/[0-9]/";
	$special = "/\W/";
	$passwordError = "";
	if (!($password)) {
		$passwordError = "Password was left blank. Please enter a password!";
	} else if (strlen($password) < 8) {
		$passwordError = "Password must be longer than 8 characters!";
	} else if (!preg_match($upper, $password)) {
		$passwordError = "Password must contain atleast 1 upper case letter!";
	} else if (!preg_match($lower, $password)) {
		$passwordError = "Password must contain atleast 1 lower case letter!";
	} else if (!preg_match($number, $password)) {
		$passwordError = "Password must contain atleast 1 number!";
	} else if (!preg_match($special, $password)) {
		$passwordError = "Password must contain atleast 1 special character!";
	}
	return $passwordError;
}

function isEmailInUse($db, $email)
{

	$query = "SELECT * FROM  accounts WHERE email = '$email'";
	$rows =  $db->query($query);
	$rows->fetch();
	if ($rows->rowCount() > 0) {
		return true;
	}
	return false;
}
?>
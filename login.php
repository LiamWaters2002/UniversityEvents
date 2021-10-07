<?php

//Check if email and passwords has been set
if (!isset($_POST['email'], $_POST['password'])) {
	// Could not get the data that should have been sent.
?>
	<div id=error_bar>
		<?php echo 'Please fill both the email and password fields!'; ?>
	</div>
	<?php
	include 'index.php';
}
// connect DB
require_once("connectDB.php");
include 'validation.php';

$email = clearUserInput($_POST['email']); //Stop html tags and removes unecessary characters.
$email = filter_var($email, FILTER_SANITIZE_EMAIL); //Removes illegal characters of email 

$password = $_POST['password'];
try {
	
	//Check for matching username and password
	$query = $db->prepare('SELECT password FROM accounts WHERE email = ?');
	$query->execute(array($_POST['email']));

	if ($query->rowCount() == 1) {// If there is an account with matching email.
		$row = $query->fetch();

		if (password_verify($_POST['password'], $row['password'])) { //Passwords match

			//Store the session email so it can be used later on to identify the user.
			session_start();
			$_SESSION["email"] = $_POST['email'];
			// $_SESSION["order"]="ascending"; //set order when you first login.
			header("Location: index.php");
			exit();
		} else {
	?>
			<div id=error_bar>
				<?php echo "You have typed your password wrong."; ?>
			</div>
		<?php
			include 'index.php';
		}
	} else {
		?>
		<div id=error_bar>
			<?php echo "Couldn't find the email in the database. Check if you typed the email correctly."; ?>
		</div>
<?php
		include 'index.php';
	}
} catch (PDOException $ex) {
	echo ("Failed to connect to the database.<br>");
	echo ($ex->getMessage());
	exit;
}
?>
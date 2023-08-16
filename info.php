<script src= "info.js"></script>
<?php
session_start();
if (!isset($_SESSION["email"])) {
?>
	<div id="error_bar">
		You cannot access more info for an event without logging in. If you do not have an account, create one.
	</div>
<?php include 'index.php';
	exit;
}
include 'layout/header.php';
?>


	<?php
	$id = $_SESSION["eventID"];
	try {
    	//Get the row for the event
		$query = $db->prepare("SELECT  * FROM  events WHERE eventID = ?");
		$query->execute(array($_SESSION['eventID']));
		//run  the query
		$row = $query->fetch();
		$email = $_SESSION["email"];
		$id = $_SESSION["eventID"];
		//step 3: display the course list in a table 	
		if ($rows && $rows->rowCount() > 0) {

			$date = new DateTime($row['date']);
			$date = $date->format("d-m-Y");

			$time = new DateTime($row['time']);
			$time = $time->format('H:i');

	?>	<!-- Display everything related to that event -->
		<div id="info_columns">
			<div id="home_section">
				<table id="table" style="width:100%" cellspacing="0" cellpadding="5">
			<?php

			echo "<th align='center'>" . $row['eventName'] . "</th>";

			echo  "<tr><b><td align='center'>" . $row['description'] . "</td></b></tr>";
			echo  "<tr><b><td align='center'>" . $row['organiser'] . "</td></b></tr>";
			echo  "<tr><b><td align='center'>" . $row['place'] . "</td></b></tr>";
			echo  "<tr><b><td align='center'>" . $row['url'] . "</td></b></tr>";
			echo  "<tr><td align='center'>" . $time . "</td></tr>";
			echo "<tr><td align='center'>" . $date . "</td></tr>";
			echo "</div>";


			echo "<tr><img length = 300 width = 300  src='images\\" . $id . ".png'></tr>";
			displayButtons($db, $_SESSION["email"], $id);
		}
		echo  '</table>';
		echo '</div>';
	} catch (PDOexception $ex) {
		echo "Sorry, a database error occurred! <br>";
		echo "Error details: <em>" . $ex->getMessage() . "</em>";
	}
			?>

			</body>

			</html>

			<?php
			function displayButtons($db, $email, $eventID)
			{

				//Get userID from email
				$query = ("SELECT * FROM accounts WHERE email = '$email'");
				$rows =  $db->query($query);
				$row =  $rows->fetch();
				$userID = $row['userID'];

				$like = "Like!";
				$book = "Book!";
				try {
					$check_user = $db->prepare("SELECT * FROM userInterest WHERE userID = '$userID' AND eventID = '$eventID'");
					$check_user->execute();

					$row = $check_user->fetch();

					//Convert this to function
					if (isset($row['liked'])) { //Stops warning
						if ($row['liked']) {
							$like = "Liked!";
						}
					}


					if (isset($row['booked'])) {
						if ($row['booked']) {
							$book = "Booked!";
						}
					}
				} catch (PDOException $ex) {
					echo $ex;
				}

				//booked event
				echo "<div class = \"home_section\">";
            	//Ajax buttons
            	$astonEmail = "/^[a-zA-Z0-9]+@aston\.ac\.uk$/";

				if (!preg_match($astonEmail, $email)) {?>
					<div id="error_bar">
					You cannot book an event if you are using a non aston email address.
					</div>
        			<p>
        			<?php
				}
            	else{
                	echo "<button class=\"submit_button\" id = \"btnBook\" onclick=\"buttonClick('btnBook', $userID, $eventID)\">$book</button><p>";
                }
            	
            	echo "<button class=\"submit_button\" id = \"btnLike\" onclick=\"buttonClick('btnLike', $userID, $eventID)\">$like</button>";
				echo "</div>";
            }	
			?>
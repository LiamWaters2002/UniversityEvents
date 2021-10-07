<script src="events.js"></script>

<?php include 'layout/header.php';
if (!isset($_POST['order'])) {
	$_SESSION["order"] = "ascending"; //Default order
} else {
	$_SESSION["order"] = $_POST["order"]; //Value given by button.
}

// if (!isset($db)) {
// 	require_once("connectdb.php");
// }
?>
<script src="events.js"></script>

<!-- Side Navigation Bar -->
<header id=custom_events>
	<nav>
		<div>
			<h3>Change Date Order:</h3>
			<form method="post" action="events.php">
				<button type="submit" class="custom_search_btn" name="order" value="ascending">Ascending</button>
			</form>

			<form method="post" action="events.php">
				<button type="submit" class="custom_search_btn" name="order" value="descending">Descending</button>
			</form>
		</div>

		<h3>Reveal All:</h3>
		<button class="custom_search_btn" onclick="revealAll()">All events</button>
		</div>


		<div>
			<h3>Hide / Reveal:</h3>
			<button class="custom_search_btn" onclick="hideCategory('sport_section')">Sport Events</button>
		</div>
		<div>
			<button class="custom_search_btn" onclick="hideCategory('culture_section')">Culture Events</button>
		</div>
		<div>
			<button class="custom_search_btn" onclick="hideCategory('other_section')">Other Events</button>
		</div>
		<div>
			<h3>Experimental Ajax:</h3>
			<h4>(Info buttons break)</h4>
        	<button class="custom_search_btn" onclick="reorder('ascending')">Ascending</button>
			<button class="custom_search_btn" onclick="reorder('descending')">Descending</button>
        	
		</div>
		<div>
			<p>



	</nav>

	<header>

	</header>

	<!-- All events are stored in their own columns, with their own css style. -->
	<div id=columns>


		<!-- Sports Column -->
		<div id="sport_section">
			<p>
			<h1>Sport Events</h1>
			<?php
			displayEvents('sport', $_SESSION["order"]);
			?>
		</div>

		<!-- Culture Column -->
		<div id="culture_section">

			<p>
			<h1>Culture Events</h1>
			<?php
			displayEvents('culture', $_SESSION["order"]);
			?>

		</div>

		<!-- Other Column -->
		<div id="other_section">
			<p>
			<h1>Other Events</h1>
			<?php
			displayEvents('other', $_SESSION["order"]);
			?>
		</div>


	</div>

	<?php

	function setCategory($order)
	{
		$_SESSION["category"] = $_POST["category"];
	}

	function displayEvents($category, $order)
	{
		include('connectDB.php');
		try {
			//Used to fetch data within the order the user selects.
			if ($order == "ascending") {
				$query = "SELECT * FROM  events WHERE eventCategory = '$category' ORDER BY date, time, eventName";
			} else if ($order == "descending") {
				$query = "SELECT * FROM  events WHERE eventCategory = '$category' ORDER BY  date DESC,  time DESC, eventName DESC";
			}
			$rows =  $db->query($query);
			$i = 0; //Used for event counter.


			if ($rows->rowCount() >= 1) {
				while ($row =  $rows->fetch()) { //If there are any events, fetch the row.

					//Format Date & Time
					$date = new DateTime($row['date']);
					$date = $date->format("d-m-Y");

					$time = new DateTime($row['time']);
					$time = $time->format('H:i');


					//Create a table, with  the class "table" so padding can be added.
					echo "<div id = $i>";
					echo "<table  class = \"table\" cellspacing=\"0\"  cellpadding=\"5\" style=\"width:100%\">";


					//Image for the event
					echo "<tr><img id=\"image\" width=\"100%\" height=\"100%\" src='images\\" . $row['eventID'] . ".png'></tr><br>";

					//Create a form, so that a submit button can send you to a page with more event info.
					echo "<tr><form method=\"post\" action=\"getEventID.php\"></tr>";
					echo "<tr><input class=\"submit_button\" type= \"submit\" name = \"" . $row['eventID'] . "\" value = \"More Info...\"></tr>";

					//Priting the details of the events within the table.
					echo "<th align='center'>" . $row['eventName'] . "</th>";
					echo  "<tr><b><td align='center'>" . $row['description'] . "</td></b></tr>";
					echo  "<tr><td align='center'>" . $time . "</td></tr>";
					echo "<tr><td align='center'>" . $date . "</td></tr>";

					//Event counter.
					$i = $i + 1;
				}
				echo "<tr></form>";
				echo '</table>';
				echo "Total Events: " . $i; //Total events for category.
				echo '</div>';
			} else {
				echo  "<p>No  course in the list.</p>\n"; //No events avaliable
			}
		} catch (PDOexception $ex) {
			echo "Sorry, there was a database error! <br>";
			echo "See details:" . $ex->getMessage();
		}
	}
	?>
	</body>

	</html>
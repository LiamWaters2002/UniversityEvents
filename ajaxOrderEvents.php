<?php
$order = $_POST["order"];
$category = $_POST["category"];

$columnName =  ucfirst($category." Events");//Reprint the name of the column, as ajax will overwrite this.
echo "<h1>$columnName</h1>";

display_events($category, $order);


function display_events($category, $order)
{require('connectDB.php');
		try {
			//Used to fetch data within the order the user selects.
			if ($order == "ascending") {
				$query = "SELECT  * FROM  events WHERE eventCategory = '$category' ORDER BY date, time, eventName";
			} else if ($order == "descending") {
				$query = "SELECT  * FROM  events WHERE eventCategory = '$category' ORDER BY  date DESC,  time DESC, eventName DESC";
			}

			$rows =  $db->query($query);
			$i = 0; //Used for event counter.


			if ($rows->rowCount() > 0) {
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
					echo "<tr><input  type= \"submit\"  value = \"More Info...\"></tr>";

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
			echo "Sorry, there was an error when connecting to the database<br>";
			echo "Here is the Error:" . $ex->getMessage();
		}
	}
?>
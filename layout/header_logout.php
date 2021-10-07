<?php
  require_once ('connectDB.php');
  $email=$_SESSION['email'];
  $query= ("SELECT forename, surname FROM accounts WHERE email = '$email'");
  $rows =  $db->query($query);
  $row =  $rows->fetch();
  $welcome = "<h2> Welcome ".$row['forename']." ".$row['surname']."! </h2>";

  
?>	
<!DOCTYPE html>
<html lang="en">

<form id="top_right_header" method = "post" action = "logout.php"  >
  
    <?php
    echo "<div id=\"Welcome\"><h1>$welcome</h1></div>";
    ?>
  
    <input class = "submit_button" type="submit" value="Log Out">
  
  </form>
</html>

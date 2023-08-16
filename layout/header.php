<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Aston Events: Events</title>

    <link href="css/astonEvents.css" rel="stylesheet" />

</head>

<body>

  <!-- Logo -->
  <header id = top_left_header>

    <img src="images/aston_logo.png" alt="Aston University" width = 300 height = 125>

  </header>
<?php
  if (session_status() === PHP_SESSION_NONE) {
    // Start the session
    session_start();
  }
require_once ('connectDB.php');

  if (isset($_SESSION["email"])){
    include 'layout/header_logout.php';
  }
  else{
    include 'layout/header_login.php';
  } 
?>
  <!-- Main Navbar -->
  <header id = "nav_bar">

    <button class = "nav_button"><a href= "index.php">Home</button></a> <!--  -->
    <button class = "nav_button"><a href= "events.php">Events</button></a>
        
  </header>
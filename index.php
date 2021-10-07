<!DOCTYPE html>
<html lang="en">

<?php include 'layout/header.php'; ?>

<head>
	<script type="text/javascript" src="validation.js"></script>
</head>

<body>
	

	<header id="register_background">
	</header>

	<div id="home_column">
		<div id="home_section">
			<h1>Welcome</h1>
			<h2>You can register for an account down below.</h2>
			<h2>If you have an account already, you can sign in on the top right.</h2>

		</div>

	</div>
	<div id="register_columns">
		<div id="register_section">
			<h1>Register Here:</h1><br>

			<form id="register_form" method="post" action="register.php">

				<h3><span id="fn_alert"></span><br>
					Forename: <input type="text" id="forename" name="forename" placeholder="eg. John" onkeyup="validName('forename', 'fn_alert')" /><br>

					<span id="sn_alert"></span><br>
					Surname: <input type="text" id="surname" name="surname" placeholder="eg. Doe" onkeyup="validName('surname', 'sn_alert')" /><br>

					<span id="phone_alert"></span><br>
					Phone: <input type="text" id="phone" name="phone" placeholder="eg. 01234567890" onkeyup="validNumber()" /><br>

					<span id="email_alert"></span><br>
					Email: <input type="text" id="email" name="email" placeholder="eg. abc123@aston.ac.uk" onKeyup="validEmail()" placeholer: email; title="Please enter your Aston University email address."><br>

					<span id="password_alert"></span><br>
					Password: <input type="password" id="password" name="password" placeholder="eg. Pa$$w0rd" onkeyup="validPassword()" /><br>
				</h3>

				<input type="submit" class="submit_button" value="Register" />
			</form>

		</div>
		<div id="password_checks">

			<h1>Password Requirements:</h1><br>
			<h3> Minimum length of 8 characters </h3>
			<h3> At least 1 upper case letter </h3>
			<h3> At least 1 lower case letter </h3>
			<h3> At least 1 number </h3>
			<h3> At least 1 special character </h3>
			<h3> </h3>

		</div>
	</div>


</body>
<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = 'Update Your Information';
include('includes/header.html');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('mysqli_connect.php'); // Connect to the db.

	$errors = []; // Initialize an error array.

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}

	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	// Check for a username:
	if (empty($_POST['pnumber'])) {
		$errors[] = 'You forgot to enter your phone number.';
	} else {
		$pn = mysqli_real_escape_string($dbc, trim($_POST['pnumber']));
	}

	if (empty($errors)) { // If everything's OK.

		// Update the user's information!

		// Make the query:
		$q = "SELECT techID FROM technicians WHERE (firstName = '$fn' AND lastName = '$ln')";
		$r = @mysqli_query($dbc, $q); // Run the query.
		$num = @mysqli_num_rows($r);
		if($num == 1)
		{
			//gets the Tech's ID
			$row = mysqli_fetch_array($r, MYSQLI_NUM);
			//UPDATE the Tech's information
			$q = "UPDATE technicians SET email = '$e' WHERE techID = $row[0]";
			$r = @mysqli_query($dbc, $q); // Run the query.
		}
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message.
				echo '<h1>Thank you!</h1>
				<p>Your information has been updated.</p><p><br></p>';

			} else { // If it did not run OK.

				// Public message:
				echo '<h1>System Error</h1>
				<p class="error">Your information could not be changed due to a system error. We apologize for any inconvenience.</p>';

				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';

			}

			mysqli_close($dbc); // Close the database connection.

			// Include the footer and quit the script (to not show the form).
			include('includes/footer.html');
			exit();// End of if ($r) IF.

		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include('includes/footer.html');
		exit();

	} else { // Report the errors.

		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p><p><br></p>';

	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>
<h1>Update Your Information</h1>
<form action="update_info.php" method="post">
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>"></p>
	<p>Email Address: <input type="email" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" > </p>
	<p>Phone Number: <input type="text" name="pnumber" size="20" maxlength="60" value="<?php if (isset($_POST['pnumber'])) echo $_POST['email']; ?>" > </p>
	<p><input type="submit" name="submit" value="Update"></p>
</form>
<?php include('includes/footer.html'); ?>
<?php 
// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.

$page_title = 'View Customers';
include('includes/header.html');
echo '<h1>Our Customers</h1>';

require('mysqli_connect.php');

// Number of records to show per page:
$display = 10;

// Define the query:
$q = "SELECT state AS state, CONCAT(firstName,' ',lastName) AS name, email AS email FROM customers ORDER BY state ASC";
$r = @mysqli_query($dbc, $q); // Run the query.
// Display the number of users
$num = mysqli_num_rows($r);
if ($num > 0)
{
	echo "<p>There are currently $num registered customers.</p>\n";

	// Table header:
	echo '<table class="active" width="100%">
	<thead>
	<tr>
		<th align="left"><strong>State</strong></th>
		<th align="left"><strong>Name</strong></th>
		<th align="left"><strong>Email</strong></th>
		<th align="left"><strong>Customer Incidents</strong></th>
		<th align="left"><strong>Customer Registrations</strong></th>
	</tr>
	</thead>
	<tbody>
	';
	
	// Fetch and print all the records....
	$bg = '#eeeeee';
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
			echo '<tr bgcolor="' . $bg . '">
			<td align="left">' . $row['state'] . '</td>
			<td align="left">' . $row['name'] . '</td>
			<td align="left">' . $row['email'] . '</td>
			<td align="left"><a href="view_customer_incidents.php?id='. $row['name'] . '"><strong>View Customer\'s Incidents</strong></a></td>
			<td align="left"><a href="view_customer_incidents.php?id='. $row['name'] . '"><strong>View Customer\'s Registrations</strong></a></td>
		</tr>
		';
	} // End of WHILE loop.
	
	echo '</tbody></table>';
	mysqli_free_result($r);
}
else
{
	echo "<p>There are no registered customers in the database.</p>";
}
mysqli_close($dbc);


include('includes/footer.html');
?>
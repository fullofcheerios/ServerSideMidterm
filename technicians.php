<?php 
// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.

$page_title = 'View Technicians';
include('includes/header.html');
echo '<h1>Our Technicians</h1>';

require('mysqli_connect.php');

// Number of records to show per page:
$display = 10;

// Define the query:
$q = "SELECT firstName as fn,lastName AS ln, email AS email,phone AS pnum FROM technicians ORDER BY firstName ASC";
$r = @mysqli_query($dbc, $q); // Run the query.
// Display the number of users
$num = mysqli_num_rows($r);
if ($num > 0)
{
	echo "<p>We currently employ $num technicians.</p>\n";

	// Table header:
	echo '<table class="active" width="60%">
	<thead>
	<tr>
		<th align="left"><strong>Last Name</strong></th>
		<th align="left"><strong>First Name</strong></th>
		<th align="left"><strong>Email</strong></th>
		<th align="left"><strong>Phone Number</strong></th>
		<th align="left"><strong>Update Information</strong></th>
	</tr>
	</thead>
	<tbody>
	';
	
	// Fetch and print all the records....
	$bg = '#eeeeee';
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
			echo '<tr bgcolor="' . $bg . '">
			<td align="left">' . $row['ln'] . '</td>
			<td align="left">' . $row['fn'] . '</td>
			<td align="left">' . $row['email'] . '</td>
			<td align="left">' . $row['pnum'] . '</td>
			<td align="left"><a href="update_info.php"><strong>Update Information</strong></a></td>
		</tr>
		';
	} // End of WHILE loop.
	
	echo '</tbody></table>';
	mysqli_free_result($r);
}
else
{
	echo "<p>There are no technicians in the database.</p>";
}
mysqli_close($dbc);


include('includes/footer.html');
?>
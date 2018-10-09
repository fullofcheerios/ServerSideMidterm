<?php 
// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.

$page_title = 'View All Incidents';
include('includes/header.html');
echo '<h1>All Open Incidents</h1>';

require('mysqli_connect.php');

// Number of records to show per page:
$display = 10;

// Define the query:
$q = "SELECT incidents.incidentID AS incidentID,
	CONCAT(technicians.firstName,' ',technicians.lastName) AS techName,
	incidents.techID AS techID, incidents.title AS title,
	incidents.dateOpened AS dtop, incidents.productCode AS pc FROM incidents, 
    technicians WHERE(( technicians.techID = incidents.techID))";
$r = @mysqli_query($dbc, $q); // Run the query.
// Display the number of users
$num = mysqli_num_rows($r);
if ($num > 0)
{
	echo "<p>There are currently $num recorded incidents.</p>\n";

	// Table header:
	echo '<table class="active" width="100%">
	<thead>
	<tr>
		<th align="left"><strong>Tech Name</strong></th>
		<th align="left"><strong>Incident ID</strong></th>
		<th align="left"><strong>Title</strong></th>
		<th align="left"><strong>Product Code</strong></th>
		<th align="left"><strong>Date Opened</strong></th>
	</tr>
	</thead>
	<tbody>
	';
	
	// Fetch and print all the records....
	$bg = '#eeeeee';
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
			echo '<tr bgcolor="' . $bg . '">
			<td align="left">' . $row['techName'] . '</td>
			<td align="left">' . $row['incidentID'] . '</td>
			<td align="left">' . $row['title'] . '</td>
			<td align="left">' . $row['pc'] . '</td>
			<td align="left">' . $row['dtop'] . '</td>
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
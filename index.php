<?php # Script 3.7 - index.php #2

// This function outputs theoretical HTML
// for adding ads to a Web page.
function create_ad() 
{
    echo '<div class="alert alert-info" role="alert"><p>';
    
    $ad_text = 'This is the midterm! ';
    for($x = 0; $x < 5; $x++) //FOR -loop for ad printing
    {
        echo $ad_text;
    }
    echo '</p></div>';
} // End of the function definition.
$page_title = 'Welcome to this Site!';
include('includes/header.html');

// Call the function:
// LAB 5: ADD BOOTSTRAP TABLE
create_ad();
?>

<div class="page-header"><h1>MIDTERM INFO</h1></div>
<p>The midterm includes all we have learned so far. Please use accessible styles.
<p>Your site will display data from the tech_support database. In addition to the home page, the
customer,incidents and technicians’ pages, supply additional pages to show the following
information or provide functionality:</p>
<ol>
  <li>Add two hyperlinks to the customer page (see example below). When hyperlinks are clicked:</li>
  <ol>
    <li>Display incidents for this customer (HINT: most customers have NO incidents)</li>
    <li>Display products this customer has registered for</li>
  </ol>
  <li>On the technician’s page, provide an EDIT link so technician information can be updated
      (NOT the ID).</li>
</ol>
<p>Show a screen shot one of the pages you created running in Cloud9.</p>
<p>Show screen shot of your cloud repo.</p>
 
<?php
// Call the function again:
create_ad();

include('includes/footer.html');
?>
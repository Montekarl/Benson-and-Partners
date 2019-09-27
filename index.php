<?php
require 'functions.php';
auth();
include_once 'dbconfig.php';

    function forceHTTPS(){
          $httpsURL = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          if( count( $_POST )>0 )
            die( 'Page should be accessed with HTTPS, but a POST Submission has been sent here. Adjust the form to point to '.$httpsURL );
          if( !isset( $_SERVER['HTTPS'] ) || $_SERVER['HTTPS']!=='on' ){
            if( !headers_sent() ){
              header( "Status: 301 Moved Permanently" );
              header( "Location: $httpsURL" );
              exit();
            }else{
              die( '<script type="javascript">document.location.href="'.$httpsURL.'";</script>' );
            }
          }
        }

    forceHTTPS();


    if(!isset($_SESSION['user_id'])){
        echo "Password incorrect";
        header('location:login.php');
        exit();
    }


    if (isset($_POST["get_data"])) {
        $id = $_POST["id"];
        $sql = "SELECT * FROM users WHERE user_id='$id'";
        $result = mysqli_query($sql);
        $row = mysqli_fetch_array($conn,$result);
        echo json_encode($row);
        exit();
    }
    if(isset($_GET['delete_id']))
    {
        $sql_query="DELETE FROM users WHERE user_id=".$_GET['delete_id'];
        mysqli_query($sql_query);
        header("Location: $_SERVER[PHP_SELF]");
    }



?>
    <!DOCTYPE html >
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Database</title>
        <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
        <link rel="stylesheet" href="style.css" type="text/css" />



        <script type="text/javascript">
            function book_viewing(id) {
                window.location.href = 'viewing_lettings_handler.php?book_viewing=' + id;
            }
        </script>

        <script type="text/javascript">
            function edt_id(id) {
                window.location.href = 'edit_data.php?edit_id=' + id;
            }

            function property_match(id){
                window.location.href= 'property_matcher_lettings.php?property_match=' + id;
            }

            function delete_id(id) {
                if (confirm('Three step confirmation required to prevent accidental deletion')) {
                    if(confirm('Please confirm twice')){
                        if(confirm('Please confirm thrice')){
                    window.location.href = 'index.php?delete_id=' + id;
                        }
                    }
                }
            }
            function book_viewing(id){
                window.location.href = 'viewing_lettings_handler.php?book_viewing=' + id;
            }

        </script>
    </head>
    <body>


    <?php
/*session_start();*/
include "header.php";
    /*include 'functions.php';
    auth();
    echo $_SESSION['user_id'];*/ ?>

    <div id="body">
        <div id="content">


<h1> TO DO LIST</h1>
<ul>
    Make adding appointment like below possible:
    <li>Sales Valuations</li>
    <li>Rental Valuations</li>
    <li>Mortgage Valuation</li>
    <li>Home Buyers Survey</li>
    <li>Full Structural Survey</li>
    <li>Taken On</li>
    <li>EPC Appointment</li>
    <li>Sales Valuations</li>
    <li>Gas Inspection</li>
    <li>Tenancy Inspection</li>
</ul>
<ul style="list-style-type:circle;">
    <li>Create additional filters in property match. Currently filtering by PRICE and BEDROOMS is only available. rightmove allows to filter garden|parking|dwelling_type|location</li>
    <li><strike>Add Filter to bedroom field on sales and lettings applicants</strike></li>
    <li><strike>Add <strong>Benson and Partners</strong> favicon</strike> </li>
    <li>Create Log Off functionality</li>
    <li><strike>Add Pagination on Lettings applicants</strike></li>
    <li>Hide the "Finish Choosing" and td with checkboxes and toggle visibility function on a link in row where the search bar is. </li>
    <li><strike>Remove links from search bar row as all of it is already in the header. </strike></li>
    <li><strike>Add mass notes functionality to applicants page. </strike></li>
    <li><strike>Add bookmark to see if the applicant has been addressed today. bookmarks should dissapear after 1 day</strike></li>
    <li>when adding new lettings property, if "available from" is blank or less than today => add "available now" as a value </li>
    <li>add styling for property matcher (sales and lettings) </li>
    <li>On viewings add "quick" feedback select with "not interested/reschedule/no show/ liked"</li>
    <li>Create logout function, currently website will logout after 1 hour of idle</li>
    <li>Create a script to parse incoming emails from rightmove, zoopla and onthemarket applicants into php form and insert that into database after amending</li>
    <li>Create a to do list, for arranging viewings, register potentials, incoming calls</li>
    <li>Create functionality to add property by inserting rightmove url and scraping data directly from rightmove</li>
    <li>Create a column in database to add if client is looking for a house or a flat (priority)</li>
    <li><strike>Work on new_lettings_properties.php, because currently you can't insert new properties on the database.</strike></li>
    <li><strike>Rewrite everyting in mysqli (50% done)</strike> </li>
    <li><strike>Rewrite <strong>EDIT SALES APPLICANT</strong> </strike></li>
    <li><strike>Merge Lettings and Sales viewings.</strike></li>
    <li><strike>Remove ALL default values from <strong>select</strong> inputs</strike></li>
    <li><strike>add header.php to all pages</strike></li>
    <li><strike>add checks from new_lettings_property.php to other pages which handles database</strike></li>
    <li><strike>Create Login System</strike></li>
    <li><strike>Create sessions for all pages</strike></li>
    <li><strike>Rewrite MODAL on Lettings Properties Data</strike></li>
    <li><strike>Add feedback functionality on viewings.</strike></li>
    <li><strike>Add Search Functionality on Sales and Lettings properties</strike></li>
    <li><strike>Add Edit and Delete functions to Sales and Lettings properties</strike></li>
    <li><strike>host website</strike></li>
    <li><strike>if for income calculations. currently if no salary is known creates errors due to division by zero</strike></li>
    <li><strike>Add sort functionality on sales applicants</strike></li>
</ul>

<?php mysqli_close($conn); ?>
</body>
</html>

<?php
 include('../includes/dbconnection.php');
include('../includes/session.php');

$delid = $_GET['delid'];

$query = mysqli_query($con,"DELETE FROM tblfees WHERE fee_id='$delid'");

if ($query == TRUE) {

        echo "<script type = \"text/javascript\">
        window.location = (\"fee.php\")
        </script>";  
}
else{

echo "<script type = \"text/javascript\">
        window.location = (\"fee.php\")
        </script>";  

}


?>


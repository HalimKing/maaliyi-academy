<?php
 include('../includes/dbconnection.php');
include('../includes/session.php');

$delid = $_GET['delid'];

$query = mysqli_query($con,"DELETE FROM tblteacher WHERE id='$delid'");

if ($query == TRUE) {

        echo "<script type = \"text/javascript\">
        window.location = (\"createTeacher.php\")
        </script>";  
}
else{

echo "<script type = \"text/javascript\">
        window.location = (\"createTeacher.php\")
        </script>"; 
        

}


?>


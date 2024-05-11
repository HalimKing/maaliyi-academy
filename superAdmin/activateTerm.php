<?php
    include('../includes/dbconnection.php');
    include('../includes/session.php');

    $activateId = $_GET['activateId'];

    $query1=mysqli_query($con,"update tblterm set isActive = 0 where isActive = 1");
    if($query1 == TRUE){

        $query=mysqli_query($con,"update tblterm set isActive = 1 where Id = '$activateId'");
        if ($query === TRUE) {

                echo "<script type = \"text/javascript\">
                window.location = (\"createTerm.php?status=success\")
                </script>";  
        }
        else{

            echo "<script type = \"text/javascript\">
            window.location = (\"createTerm.php?status=fail\")
            </script>";  
        }

    }
    else{

            echo "<script type = \"text/javascript\">
            window.location = (\"createTerm.php?status=fail\")
            </script>";  
        }

?>


<?php
// echo "<script type = \"text/javascript\">
// alert('logout')
// </script>";  

session_start();
session_unset();
session_destroy();

header("Location: ../index.php");

    // echo "<script type = \"text/javascript\">
    // window.location = (\"index.php\")
    // </script>";  
?>
<!-- Log on to codeastro.com for more projects! -->

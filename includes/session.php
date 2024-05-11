
<?php
session_start(); 
include('dbconnection.php');
// ini_set('session.gc_maxlifetime',300);
// ini_set('session.cookie_lifetime',300);
// exit();

if (isset($_SESSION['emailAddress']))
{
    $emailAddress = $_SESSION['emailAddress'];
  //   if(time() - $_SESSION["SESS_LOGIN_TIME"] > 600){
  //     session_unset();
  //     session_destroy();
  //     echo "<script type = \"text/javascript\">
  // window.location = (\"../index.php\");
  // </script>";

  //   }

}


else{
  echo "<script type = \"text/javascript\">
  window.location = (\"../index.php\");
  </script>";

}

// $expiry = 1800 ;//session expiry required after 30 mins
// if (isset($_SESSION['LAST']) && (time() - $_SESSION['LAST'] > $expiry)) {

//     session_unset();
//     session_destroy();
//     echo "<script type = \"text/javascript\">
//           window.location = (\"../index.php\");
//           </script>";

// }
// $_SESSION['LAST'] = time();
    
?>
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);
    if(isset($_POST["updateFee"])){
        $amount = $_POST["amount"];
        $feeId = $_POST["feeId"];
      
        
        $sql = mysqli_query($con, "UPDATE tblfeepayment SET feePaid=feePaid+$amount, dueAmount=dueAmount-$amount WHERE Id='$feeId'");

        if($sql == true){
            echo "
                <script>
                    alert('Updated Successfully!');
                    window.location=\"editFees.php?Id=$_GET[Id]&studentId=$_GET[studentId]&year=$_GET[year]&level=$_GET[level]\"
                </script>
            ";
        }else{
            echo "Error Occured : " . mysqli_error($con);
        }
    }























?>
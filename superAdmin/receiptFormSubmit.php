<?php  

    include('../includes/dbconnection.php');
  
    
    if (isset($_POST['submitReceiptForm'])) {
        
        $studentId = mysqli_real_escape_string($con, $_POST['studentId']);
        $receiptNumber = mysqli_real_escape_string($con, $_POST['receiptNumber']);
        $PaymentId = mysqli_real_escape_string($con, $_POST['paymentId']);
        

        $sql = mysqli_query($con, "INSERT INTO tblreceipt(studentId,receiptNumber,paymentId) VALUES('$studentId','$receiptNumber','$PaymentId')");
       
        
        if($sql == true) {
            $res = [
                'status' => 'success',
                'message' => 'Successfully Inserted!'
            ];
            echo json_encode($res);
            return false;

        }else {
            $res = [
                'status' => 'fail',
                'message' => 'Sorry Something Went Wrong!'
            ];
            echo json_encode($res);
            return false;
        }

        
    }

?>
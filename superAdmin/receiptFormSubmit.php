<?php  
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/dbconnection.php');
// Set header to JSON
header('Content-Type: application/json');



// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $studentId = mysqli_real_escape_string($con, $_POST['studentId']);
    $receiptNumber = mysqli_real_escape_string($con, $_POST['receiptNumber']);
    $PaymentId = mysqli_real_escape_string($con, $_POST['paymentId']);

    $sql = mysqli_query($con, "INSERT INTO tblreceipt(studentId,receiptNumber,paymentId) VALUES('$studentId','$receiptNumber','$PaymentId')");

    if($sql) {
        $res = [
            'status' => 'success',
            'message' => 'Successfully Inserted!'
        ];
    } else {
        $res = [
            'status' => 'fail',
            'message' => 'Sorry Something Went Wrong!'
        ];
    }

    echo json_encode($res);
    exit; // Important to stop PHP after outputting JSON
}
?>

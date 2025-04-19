<?php  

// include("../includes/dbconnection.php");
// $con=mysqli_connect("localhost", "root", "", "resultgrading");
$con=mysqli_connect("localhost", "root", "", "maaliyiri");
// $con=mysqli_connect("shareddb-u.hosting.stackcp.net", "maaliyiriDB-3133334926", "btlk9r7q8b", "maaliyiriDB-3133334926");

if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error(); 
}


if(isset($_POST["studentIds"]) && isset($_POST["yearId"] )) {
    $students_ids = $_POST["studentIds"];
    $yearId = $_POST["yearId"];
    $classId = $_POST["classId"];
    $existing_info = array();
    $promoted_array = array();
    $student_names = array();
    
    foreach ($students_ids as $student_id) {
        
        # code...
        $sql = "SELECT * FROM tblleveldata WHERE studentId='$student_id' AND sessionId='$yearId' AND classId='$classId'";
        if(mysqli_query($con, $sql)) { 
            if(mysqli_num_rows(mysqli_query($con, $sql)) > 0) { 
                array_push($existing_info, $student_id);
            }else{
                $qry = mysqli_query($con,"INSERT INTO tblleveldata(studentId,sessionId,classId) VALUES ('$student_id', '$yearId', '$classId')");
                array_push($promoted_array, $student_id);
            }
        }
    }


 
    if(count($existing_info) > 0 && count($promoted_array) > 0) {  // if found both promoted and alredy promoted students, return this.
        
        foreach ($existing_info as $element) {
            # code...
            $sql = mysqli_query($con, "SELECT firstName,lastName,otherName FROM tblstudent WHERE sid='$element'");
            if($sql == true){
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                    array_push($student_names, $row['firstName'] . ' ' . $row['lastName'] . ' ' . $row['otherName']);
                }
            }

        } //foreach end
        $res = [
            'status' => 'success_existing_promoted',
            'message'=> 'Successfully fetcheed!',
            'student_existing_info' => $student_names,
            'promoted_students' => $promoted_array
        ];
        
        echo json_encode($res);
        return false;
    } else if(count($existing_info) > 0) { // if student already promoted return this
        
        foreach ($existing_info as $element) {
            # code...
            $sql = mysqli_query($con, "SELECT firstName,lastName,otherName FROM tblstudent WHERE sid='$element'");
            if($sql == true){
                
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                    array_push($student_names, $row['firstName'] . ' ' . $row['lastName'] . ' ' . $row['otherName']);
                }
            }

        } //foreach end
        $res = [
            'status' => 'success_existing',
            'message'=> 'Successfully fetcheed!',
            'student_existing_info' => $student_names,
            
        ];
        
        echo json_encode($res);
        return false;
    } else if(count($promoted_array) > 0) { //if successfully promoted students, return this
        $res = [
            'status' => 'success_promoted',
            'message'=> 'Successfully fetcheed!',
            'promoted_students' => $promoted_array
        ];
        
        echo json_encode($res);
        return false;
    }



} //if



$array = array(array(
    'name' => 'Halim',
    'lastname' => 'Mohammed'
),
array(
    'name' => 'Bush',
    'lastname' => 'Hanif'
));

print_r($array);


?>
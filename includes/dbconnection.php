<?php
// $conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_database)or die('Cannot open database');	
// $con=mysqli_connect("localhost", "id13019632codeastro.com", "PASS=word@codeastro.com", "id13019632_attendance");

// $con=mysqli_connect("localhost", "root", "", "resultgrading");
$con=mysqli_connect("localhost", "root", "", "maaliyiri");
// $con=mysqli_connect("shareddb-u.hosting.stackcp.net", "maaliyiriDB-3133334926", "btlk9r7q8b", "maaliyiriDB-3133334926");

if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error(); 
}

    // $con=mysqli_connect("localhost", "root", "codeastro.com", "amsys");
    // if(mysqli_connect_errno()){
    // echo "Connection Fail".mysqli_connect_error();
    // }

//     function createRandomPassword() {
//         $chars = "1452636985471003232303232023232023456789";
//         srand((double)microtime()*1000000);
//         $i = 0;
//         $pass = '' ;
//         while ($i <= 7) {
    
//             $num = rand() % 33;
    
//             $tmp = substr($chars, $num, 1);
    
//             $pass = $pass . $tmp;
    
//             $i++;
    
//         }
//         return $pass;
//     }
//     $studentId = createRandomPassword();
    


// $sql = "SELECT * FROM tblstudent";
// $result = mysqli_query($con, $sql);
// if($sql == true){
//     while($row = mysqli_fetch_assoc($result)){
//         $studentId = createRandomPassword();
//         $qry = mysqli_query($con, "UPDATE tblstudent SET sid='$studentId' WHERE Id='$row[Id]'");
//         if($qry == true){
            
//         }
//         else{
//             echo "
//                 <script>
//                     alert('Error')
//                 </script>
//             ";
//         }
//     }
// }







// *********************************  *************  ********** *********************************






// $sql = mysqli_query($con, "SELECT * FROM tblstudent");

// if($sql == true){
//     // echo mysqli_num_rows($sql);
//     // return false;
//     while($row = mysqli_fetch_assoc($sql)){
//         echo $row["Id"];
//         // return false;
//         $qry = mysqli_query($con, "UPDATE tblfeepayment SET studentId='$row[sid]' WHERE studentId='$row[Id]'");
//         if($qry == false){
//             echo "
//             <script>
//             alert('Error')
//             </script>
//             ";
//             // return false;
//         }else{
//             echo "worked";
//         }
//     }
    
// }else{
//     echo "
//     <script>
//     alert('King')
//     </script>
//     ";
//     return false;
// }









// ****************************************** 

// $sql = mysqli_query($con, "SELECT * FROM tblstudent");
// while($row = mysqli_fetch_assoc($sql)){
//     $qry = mysqli_query($con, "INSERT INTO tblleveldata(studentId,sessionId,classId) VALUES('$row[sid]','$row[sessionId]','$row[classId]')");
//     if($qry == true){
//         echo "true";
//     }
// }


?>



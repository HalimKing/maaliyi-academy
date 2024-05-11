<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    // error_reporting(0);


    

    $feeNameId = $_POST["feeNameId"];
    $classId = $_POST["classId"];
    $sessionId = $_POST["sessionId"];
    // echo $feeNameId;
    

    // SQL query to find duplicate IDs
    $sql = "SELECT tblfeepayment.studentId, tblstudent.firstName, tblfeepayment.sessionId,tblfeepayment.feePaid, COUNT(tblfeepayment.studentId) AS Id
    FROM tblfeepayment
    JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
    WHERE tblfeepayment.classId = '$classId'
    GROUP BY tblfeepayment.studentId";
    
    $result = $con->query($sql);
    
    if ($result->num_rows > 0) {
        // Duplicate IDs found
        while ($row = $result->fetch_assoc()) {
            // echo "Student ID " . $row["studentId"] . " repeats " . $row["Id"] . " times.\n";

            $sid = $row["studentId"];
            $qry=mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tblterm.termName,tbllevel.levelName,tblfees.fee_amount,tblfeepayment.feePaid,tblfeepayment.month,tblfeepayment.dueAmount,tblfeepayment.Id,tblfeepayment.classId,tblfeepayment.dateCreated,tblfeetype.feeName,tblfeepayment.studentId,tblstudent.sid  FROM tblfeepayment 
            JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
            JOIN tblsession ON tblsession.Id = tblfeepayment.sessionId
            JOIN tblterm ON tblterm.id = tblfeepayment.termId
            JOIN tbllevel ON tbllevel.Id = tblfeepayment.classId
            JOIN tblfeetype ON tblfeetype.Id = tblfeepayment.feeTypeId
            JOIN tblfees ON tblfees.fee_id = tblfeepayment.feeId 
            WHERE tblfeepayment.studentId='$sid' AND tblfeepayment.classId='$classId' AND tblfeepayment.sessionId='$sessionId' AND tblfeepayment.feeTypeId='$feeNameId'
            ");
            if($qry == true){
                // echo mysqli_num_rows($qry);
                while($rr = mysqli_fetch_assoc($qry)){
                
                    // echo "<br>";
                    echo $sid. "<br>";
                    echo $rr["feePaid"] . "<br>";
                    
                    // $ccc++;
                }
                echo "<br><br>";
            }else{
                echo "ERROR : " . mysqli_error($con);
            }
            $ccc= 0;
            


        }
    } else {
        echo "No duplicate IDs found.\n";
    }
    
    // Close connection
    $con->close();

    




?>
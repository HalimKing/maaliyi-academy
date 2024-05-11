
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);

    if(isset($_POST['submit'])){

     $alertStyle ="";
      $statusMsg="";

    $termName = $_POST['term_name'];
    $feeType = $_POST['fee_type'];
    $sessionName = $_POST['session_name'];
    $feeAmount = $_POST['fee_amount'];
    $level = $_POST['level'];

    
    $dateAdded = date("Y-m-d");

    //Checks the Course Code
    $query=mysqli_query($con,"SELECT * FROM tblfees WHERE fee_type ='$feeType' AND fee_session='$sessionName'");
    $ret=mysqli_fetch_array($query);

     if($ret > 0){ //Check the coure Title
      $alertStyle ="alert alert-danger";
      $statusMsg="This Course already exist!";

    }
    else{

        $query=mysqli_query($con,"insert into tblfees(fee_type,fee_term,fee_session,level,fee_amount,reg_date) value('$feeType','$termName','$sessionName','$level','$feeAmount','$dateAdded')");

        if ($query) {
            
            $alertStyle ="alert alert-success";
            $statusMsg="Course Created and Assigned Successfully!";
        }
        else
        {
            $alertStyle ="alert alert-danger";
            $statusMsg="An error Occurred!". mysqli_error($con);
        }
  }
    }

    function formatMoney($number, $fractional=false) {
        if ($fractional) {
            $number = sprintf('%.2f', $number);
        }
        while (true) {
            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
            if ($replaced != $number) {
                $number = $replaced;
            } else {
                break;
            }
        }
        return $number;
    }
?>
<?php include 'includes/title.php';?>
<script>

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}



function showValues(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxCall2.php?fid="+str,true);
        xmlhttp.send();
    }
}

function showLecturer(str) {
    if (str == "") {
        document.getElementById("txtHintt").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHintt").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxCallLecturer.php?deptId="+str,true);
        xmlhttp.send();
    }
}



function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 20px; font-family: arial;"> ');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
   
   
}

</script>
</head>
<body>
    <!-- Left Panel -->
    <?php $page="fee"; include 'includes/leftMenu.php';?>

   <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
            <?php include 'includes/header.php';?>
        <!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
								<!-- Log on to codeastro.com for more projects! -->
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Fee</a></li>
                                    <li class="active">Print Fees</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        
                    </div>
                    

                <br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">All Students</h2></strong>
                            </div>
                            <div class="card-body">
                            <form action="" method="post">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                            <?php  
                                                        $sql = mysqli_query($con, "SELECT * FROM tblsession");
                                                        echo '
                                                            <select required name="sessionId" onchange="showValues(this.value)" class="custom-select form-control">';
                                                        echo'<option value="">--Select Session--</option>
                                                            ';
                                                        while($session_row = mysqli_fetch_array($sql)){
                                                            echo '<option value="'.$session_row['Id'].'"> '.$session_row['sessionName'] .'</option>';
                                                        }
                                                        echo '</select>';
                                                    
                                                    
                                                    ?>  
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                            <?php 
                                                    $query=mysqli_query($con,"SELECT * FROM tblfeetype");                        
                                                    $count = mysqli_num_rows($query);
                                                    if($count > 0){                       
                                                        echo ' <select required id="" name="feeNameId" class="custom-select form-control">';
                                                        echo'<option value="">--Select Fee--</option>';
                                                        while ($row = mysqli_fetch_array($query)) {
                                                        echo'<option value="'.$row['Id'].'" >'.$row['feeName'].'</option>';
                                                            }
                                                                echo '</select>';
                                                            }
                                                ?>   
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                            <?php 
                                                    $query=mysqli_query($con,"SELECT * FROM tbllevel");                        
                                                    $count = mysqli_num_rows($query);
                                                    if($count > 0){                       
                                                        echo ' <select required id="class" name="classId" class="custom-select form-control">';
                                                        echo'<option value="">--Select Class--</option>';
                                                        while ($row = mysqli_fetch_array($query)) {
                                                        echo'<option value="'. $row['Id'] .'" >'.$row['levelName'].'</option>';
                                                            }
                                                                echo '</select>';
                                                            }
                                                ?>   
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <select name="status" id="" class="custom-select form-control" required>
                                                    <option value="">-- Selecet Status --</option>
                                                    <option value="all">All</option>
                                                    <option value="owing">Owing</option>
                                                    <option value="finished">Finished</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="col-lg-3 col-md-6">
                                            <div class="form-group">
                                                <button type="submit"  name="filter" class="btn btn-info form-control">Felter</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="breadcrumbs ml-0">
                                        <div class="breadcrumbs-inner">
                                            <div class="row m-0">
                                                <div class="col-sm-4">
                                                    <div class="page-header float-left">
                                                        <div class="page-title">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="page-header float-right">
                                                        <div class="page-title">
                                                            <ol class="breadcrumb text-right">
                                                        
                                                            <!-- Log on to codeastro.com for more projects! -->
                                                                <li><a href="javascript: Clickheretoprint()"><button class="btn btn-success">Print</button></a></li>
                                                                
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php   
                                    if(isset($_POST["filter"])){
                                        $feeNameId = $_POST["feeNameId"];
                                        $classId = $_POST["classId"];
                                        $sessionId = $_POST["sessionId"];
                                        $status = $_POST["status"];
                                    
                                        // SQL query to find duplicate IDs
                                        $sqll = "SELECT tblfeepayment.studentId, tblstudent.firstName, tblfeepayment.sessionId,tblfeepayment.feePaid, COUNT(tblfeepayment.studentId) AS Id
                                        FROM tblfeepayment
                                        JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
                                        WHERE tblfeepayment.classId='$classId' AND tblfeepayment.sessionId='$sessionId' AND tblfeepayment.feeTypeId='$feeNameId'
                                        GROUP BY tblfeepayment.studentId";
                                        
                                        $result = $con->query($sqll);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                // echo "Student ID " . $row["studentId"] . " repeats " . $row["Id"] . " times.\n";
                                    
                                                $sid = $row["studentId"];
                                                $totalDueAmount = 0;
                                                $qry=mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tblterm.termName,tbllevel.levelName,tblfees.fee_amount,tblfees.feeMonth,tblfeepayment.feePaid,tblfeepayment.month,tblfeepayment.dueAmount,tblfeepayment.Id,tblfeepayment.classId,tblfeepayment.dateCreated,tblfeetype.feeName,tblfeepayment.studentId,tblstudent.sid  FROM tblfeepayment 
                                                JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
                                                JOIN tblsession ON tblsession.Id = tblfeepayment.sessionId
                                                JOIN tblterm ON tblterm.id = tblfeepayment.termId
                                                JOIN tbllevel ON tbllevel.Id = tblfeepayment.classId
                                                JOIN tblfeetype ON tblfeetype.Id = tblfeepayment.feeTypeId
                                                JOIN tblfees ON tblfees.fee_id = tblfeepayment.feeId 
                                                WHERE tblfeepayment.studentId='$sid' AND tblfeepayment.classId='$classId' AND tblfeepayment.sessionId='$sessionId' AND tblfeepayment.feeTypeId='$feeNameId'
                                                GROUP BY tblfeepayment.studentId
                                                ");
                                                $data = mysqli_fetch_assoc($qry);
                                                if(mysqli_num_rows($qry) > 0){
                                                    $qryCheck = mysqli_query($con, "SELECT SUM(dueAmount) as totalDue FROM tblfeepayment  WHERE tblfeepayment.studentId='$sid' AND tblfeepayment.classId='$classId' AND tblfeepayment.sessionId='$sessionId' AND tblfeepayment.feeTypeId='$feeNameId'");
                                                        $rowCheck = mysqli_fetch_assoc($qryCheck);

                                                        if($rowCheck["totalDue"] > 0 && $status == "owing"){
                                
                                ?>
                                    
                                
                                <div id="content" class="content text-center w-100" >
                                    <div  align="center" style="font-size:16px; height:100vh;">
                                        <br><br>
                                        <div style="text-align:center; line-height:0">
                                
                                            <img src="img/maaliyiri.jpg" width="100" alt=""> 
                                            <strong class="card-title text-uppercase"><h2> Maaliyiri Academy</h2></strong>
                                            <p class="text-capitalize" style="margin-bottom: 100px;">centre of excelence</p>
                                            <div class="form-group">
                                            <!-- <h3>Fee Receipt</h3> -->
                                            </div>
                                        </div>

                                        <div style="width: 100%; display:flex;justify-content:space-between; margin-top:-100px;">
                                            <div>
                                                
                                            </div>
                                            <div>
                                                <div class="form-group text-left">
                                                    <h4 style="font-weight: 100;"  class="pt-2"><strong>EMAIL : </strong>maaliyiriacademy@gmail.com</h4>
                                                </div>
                                            </div>
                                        </div>
                                                <br>
                                                <br>
                                        <div style="width: 100%; display:flex;justify-content:space-between;margin-top:-50px;">
                                            <div>
                                                <div class="form-group">
                                                    <div class="text-left" style="width:100%; text-align:left">
                                                        <h4 style="font-weight: 100; text-transform:uppercase" class="pt-2"><strong style="font-weight:800">STUDENT : </strong> <?php echo $data["firstName"] . ' '. $data["lastName"] . ' '. $data["otherName"] ?></h4>
                                                        <!-- <br> -->
                                                        <h4 style="font-weight: 100; text-transform:uppercase" class="pt-2"><strong style="font-weight:800">Class : </strong> <?php echo $data["levelName"] ?></h4>
                                                        <!-- <br> -->
                                                        
                                                        <h4 style="font-weight: 100; text-transform:uppercase"  class="pt-2"><strong style="font-weight:800">Academic Year : </strong> <?php echo $data["sessionName"] ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group text-left">
                                                  
                                                
                                                    <h4 style="font-weight: 100; text-transform:uppercase"><strong style="font-weight:800">Date : </strong><span class="currentDate"></span><?php  //echo date("l jS \of F Y h:i:s A") ?></h4>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div style=" margin-top:30px;" class="table-responsive">
                                            <table border="1" cellpadding="4" cellspacing="0" style="font-family: arial;	text-align:left;" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Fee Type</th>
                                                    <?php 
                                                        $level = explode(" ", $_GET["level"]);
                                                    if(explode(" ", $data["levelName"])[0] == "Primary"){
                                                        ?>
                                                        <th scope="col">Term</th>

                                                    <?php  }else{?>
                                                        <th scope="col">Month</th>


                                                        <?php  }?>
                                                    
                                                    <th scope="col">Fee Amount</th>
                                                    <th scope="col">Amount Paid</th>
                                                    <th scope="col">Amount Owing</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
                                                        $qrry = mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tblterm.termName,tbllevel.levelName,tblfees.fee_amount,tblfees.feeMonth,tblfeepayment.feePaid,tblfeepayment.month,tblfeepayment.dueAmount,tblfeepayment.Id,tblfeepayment.classId,tblfeepayment.dateCreated,tblfeetype.feeName,tblfeepayment.studentId,tblstudent.sid  FROM tblfeepayment 
                                                        JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
                                                        JOIN tblsession ON tblsession.Id = tblfeepayment.sessionId
                                                        JOIN tblterm ON tblterm.id = tblfeepayment.termId
                                                        JOIN tbllevel ON tbllevel.Id = tblfeepayment.classId
                                                        JOIN tblfeetype ON tblfeetype.Id = tblfeepayment.feeTypeId
                                                        JOIN tblfees ON tblfees.fee_id = tblfeepayment.feeId 
                                                        WHERE tblfeepayment.studentId='$sid' AND tblfeepayment.classId='$classId' AND tblfeepayment.sessionId='$sessionId' AND tblfeepayment.feeTypeId='$feeNameId'");

                                                        
                                                        

                                                        if($qrry == true){
                                                            while($rowFee = mysqli_fetch_assoc($qrry)){
                                                               

                                                        
                                                        
                                                        // while($rowpaymentprint = mysqli_fetch_assoc($sql)){
                                                            $totalDueAmount += $rowFee["dueAmount"];
                                                    ?>
                                                    <tr>
                                                    <td><?php echo $rowFee["feeName"] ?></td>
                                                        <?php 
                                                            $level = explode(" ", $_GET["level"]);
                                                        if(explode(" ", $rowFee["levelName"])[0] == "Primary"){
                                                            ?>
                                                            <td><?php echo $rowFee["termName"] ?></td>

                                                        <?php  }else{?>
                                                            <td><?php echo $rowFee["feeMonth"] ?></td>


                                                            <?php  }?>
                                                        <td>GHS <?php echo formatMoney($rowFee["fee_amount"], true)  ?></td>
                                                        <td>GHS <?php echo formatMoney($rowFee["feePaid"], true)  ?></td>
                                                        <td>GHS <?php echo formatMoney($rowFee["dueAmount"], true)  ?></td>
                                                    </tr>
                                                        <?php 
                                                        $count++;


                                                        
                                                            }
                                                    
                                                            // }
                                                        ?>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan=""><strong style="font-size: 20px;">Total</strong></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th colspan=""><strong style="font-size: 16px;">GHS <?php  echo formatMoney($totalDueAmount, true)  ?></strong></th>
                                                    </tr>
                                                    <?php   }?>
                                                </tfoot>
                                            </table>
                                        </div>
                                            <br><br><br>
                                            <br><br><br>
                                    
                                        <div style="display: flex; justify-content:space-between">
                                            <div>
                                                <h4>Headmaster/Headmistress Signature</h4><br>
                                                <hr style="border: 1px dotted #000;width:300px;padding-left:0">
                                            </div>
                                            <div class="text-left">
                                                <h4>Contact Us On:</h4><br>
                                                <h4>0249917743 / 0207194046</h4>
                                            </div>
                                            
                                        </div>
                                        <!-- <br><br><br>
                                            <br><br><br>
                                            <br><br><br>
                                            <br><br><br> -->
                                     

                                    </div>
                                    
                                
                                    <?php
                                                // *********************** SELECT ALL THAT ARE NOT OWING *********
                                                }elseif($rowCheck["totalDue"] <= 0 && $status == "finished"){

                                                // }
                                            // }
                                          
                                           
                                            ?>
                                           <div id="content" class="content text-center w-100" >
                                    <div  align="center" style="font-size:16px; height:100vh;">
                                        <br><br>
                                        <div style="text-align:center; line-height:0">
                                
                                            <img src="img/maaliyiri.jpg" width="100" alt=""> 
                                            <strong class="card-title text-uppercase"><h2> Maaliyiri Academy</h2></strong>
                                            <p class="text-capitalize" style="margin-bottom: 100px;">centre of excelence</p>
                                            <div class="form-group">
                                            <!-- <h3>Fee Receipt</h3> -->
                                            </div>
                                        </div>

                                        <div style="width: 100%; display:flex;justify-content:space-between; margin-top:-100px;">
                                            <div>
                                                
                                            </div>
                                            <div>
                                                <div class="form-group text-left">
                                                    <h4 style="font-weight: 100;"  class="pt-2"><strong>EMAIL : </strong>maaliyiriacademy@gmail.com</h4>
                                                </div>
                                            </div>
                                        </div>
                                                <br>
                                                <br>
                                        <div style="width: 100%; display:flex;justify-content:space-between;margin-top:-50px;">
                                            <div>
                                                <div class="form-group">
                                                    <div class="text-left" style="width:100%; text-align:left">
                                                        <h4 style="font-weight: 100; text-transform:uppercase" class="pt-2"><strong style="font-weight:800">STUDENT : </strong> <?php echo $data["firstName"] . ' '. $data["lastName"] . ' '. $data["otherName"] ?></h4>
                                                        <!-- <br> -->
                                                        <h4 style="font-weight: 100; text-transform:uppercase" class="pt-2"><strong style="font-weight:800">Class : </strong> <?php echo $data["levelName"] ?></h4>
                                                        <!-- <br> -->
                                                        
                                                        <h4 style="font-weight: 100; text-transform:uppercase"  class="pt-2"><strong style="font-weight:800">Academic Year : </strong> <?php echo $data["sessionName"] ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group text-left">
                                                  
                                                
                                                    <h4 style="font-weight: 100; text-transform:uppercase"><strong style="font-weight:800">Date : </strong><span class="currentDate"></span><?php  //echo date("l jS \of F Y h:i:s A") ?></h4>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div style=" margin-top:30px;" class="table-responsive">
                                            <table border="1" cellpadding="4" cellspacing="0" style="font-family: arial;	text-align:left;" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Fee Type</th>
                                                        <?php 
                                                        $level = explode(" ", $_GET["level"]);
                                                    if(explode(" ", $data["levelName"])[0] == "Primary"){
                                                        ?>
                                                        <th scope="col">Term</th>

                                                    <?php  }else{?>
                                                        <th scope="col">Month</th>


                                                        <?php  }?>
                                                    
                                                    <th scope="col">Fee Amount</th>
                                                    <th scope="col">Amount Paid</th>
                                                    <th scope="col">Amount Owing</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
                                                        $qrry = mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tblterm.termName,tbllevel.levelName,tblfees.fee_amount,tblfees.feeMonth,tblfeepayment.feePaid,tblfeepayment.month,tblfeepayment.dueAmount,tblfeepayment.Id,tblfeepayment.classId,tblfeepayment.dateCreated,tblfeetype.feeName,tblfeepayment.studentId,tblstudent.sid  FROM tblfeepayment 
                                                        JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
                                                        JOIN tblsession ON tblsession.Id = tblfeepayment.sessionId
                                                        JOIN tblterm ON tblterm.id = tblfeepayment.termId
                                                        JOIN tbllevel ON tbllevel.Id = tblfeepayment.classId
                                                        JOIN tblfeetype ON tblfeetype.Id = tblfeepayment.feeTypeId
                                                        JOIN tblfees ON tblfees.fee_id = tblfeepayment.feeId 
                                                        WHERE tblfeepayment.studentId='$sid' AND tblfeepayment.classId='$classId' AND tblfeepayment.sessionId='$sessionId' AND tblfeepayment.feeTypeId='$feeNameId'");

                                                        
                                                        

                                                        if($qrry == true){
                                                            while($rowFee = mysqli_fetch_assoc($qrry)){
                                                               

                                                        
                                                        
                                                        // while($rowpaymentprint = mysqli_fetch_assoc($sql)){
                                                            $totalDueAmount += $rowFee["dueAmount"];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $rowFee["feeName"] ?></td>
                                                        <?php 
                                                            $level = explode(" ", $_GET["level"]);
                                                        if(explode(" ", $rowFee["levelName"])[0] == "Primary"){
                                                            ?>
                                                            <td><?php echo $rowFee["termName"] ?></td>

                                                        <?php  }else{?>
                                                            <td><?php echo $rowFee["feeMonth"] ?></td>


                                                            <?php  }?>
                                                        <td>GHS <?php echo formatMoney($rowFee["fee_amount"], true)  ?></td>
                                                        <td>GHS <?php echo formatMoney($rowFee["feePaid"], true)  ?></td>
                                                        <td>GHS <?php echo formatMoney($rowFee["dueAmount"], true)  ?></td>
                                                    </tr>
                                                        <?php 
                                                        $count++;


                                                        
                                                            }
                                                    
                                                            // }
                                                        ?>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan=""><strong style="font-size: 20px;">Total</strong></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th colspan=""><strong style="font-size: 16px;">GHS <?php  echo formatMoney($totalDueAmount, true)  ?></strong></th>
                                                    </tr>
                                                    <?php   }?>
                                                </tfoot>
                                            </table>
                                        </div>
                                            <br><br><br>
                                            <br><br><br>
                                    
                                        <div style="display: flex; justify-content:space-between">
                                            <div>
                                                <h4>Headmaster/Headmistress Signature</h4><br>
                                                <hr style="border: 1px dotted #000;width:300px;padding-left:0">
                                            </div>
                                            <div class="text-left">
                                                <h4>Contact Us On:</h4><br>
                                                <h4>0249917743 / 0207194046</h4>
                                            </div>
                                            
                                        </div>
                                        <!-- <br><br><br>
                                            <br><br><br>
                                            <br><br><br>
                                            <br><br><br> -->
                                     

                                    </div>
                                    
                                            <?php
                                                        }elseif($status == "all"){

                                                        // }
                                             ?>
                                                        <!-- ************** SELECT ALL FEES *******************-->
                                                        
                                <div id="content" class="content text-center w-100" >
                                    <div  align="center" style="font-size:16px; height:100vh;">
                                        <br><br>
                                        <div style="text-align:center; line-height:0">
                                
                                            <img src="img/maaliyiri.jpg" width="100" alt=""> 
                                            <strong class="card-title text-uppercase"><h2> Maaliyiri Academy</h2></strong>
                                            <p class="text-capitalize" style="margin-bottom: 100px;">centre of excelence</p>
                                            <div class="form-group">
                                            <!-- <h3>Fee Receipt</h3> -->
                                            </div>
                                        </div>

                                        <div style="width: 100%; display:flex;justify-content:space-between; margin-top:-100px;">
                                            <div>
                                                
                                            </div>
                                            <div>
                                                <div class="form-group text-left">
                                                    <h4 style="font-weight: 100;"  class="pt-2"><strong>EMAIL : </strong>maaliyiriacademy@gmail.com</h4>
                                                </div>
                                            </div>
                                        </div>
                                                <br>
                                                <br>
                                        <div style="width: 100%; display:flex;justify-content:space-between;margin-top:-50px;">
                                            <div>
                                                <div class="form-group">
                                                    <div class="text-left" style="width:100%; text-align:left">
                                                        <h4 style="font-weight: 100; text-transform:uppercase" class="pt-2"><strong style="font-weight:800">STUDENT : </strong> <?php echo $data["firstName"] . ' '. $data["lastName"] . ' '. $data["otherName"] ?></h4>
                                                        <!-- <br> -->
                                                        <h4 style="font-weight: 100; text-transform:uppercase" class="pt-2"><strong style="font-weight:800">Class : </strong> <?php echo $data["levelName"] ?></h4>
                                                        <!-- <br> -->
                                                        
                                                        <h4 style="font-weight: 100; text-transform:uppercase"  class="pt-2"><strong style="font-weight:800">Academic Year : </strong> <?php echo $data["sessionName"] ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group text-left">
                                                  
                                                
                                                    <h4 style="font-weight: 100; text-transform:uppercase"><strong style="font-weight:800">Date : </strong><span class="currentDate"></span><?php  //echo date("l jS \of F Y h:i:s A") ?></h4>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div style=" margin-top:30px;" class="table-responsive">
                                            <table border="1" cellpadding="4" cellspacing="0" style="font-family: arial;	text-align:left;" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Fee Type</th>
                                                    <?php 
                                                        $level = explode(" ", $_GET["level"]);
                                                    if(explode(" ", $data["levelName"])[0] == "Primary"){
                                                        ?>
                                                        <th scope="col">Term</th>

                                                    <?php  }else{?>
                                                        <th scope="col">Month</th>


                                                        <?php  }?>
                                                    
                                                    <th scope="col">Fee Amount</th>
                                                    <th scope="col">Amount Paid</th>
                                                    <th scope="col">Amount Owing</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
                                                        $qrry = mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tblterm.termName,tbllevel.levelName,tblfees.fee_amount,tblfees.feeMonth,tblfeepayment.feePaid,tblfeepayment.month,tblfeepayment.dueAmount,tblfeepayment.Id,tblfeepayment.classId,tblfeepayment.dateCreated,tblfeetype.feeName,tblfeepayment.studentId,tblstudent.sid  FROM tblfeepayment 
                                                        JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
                                                        JOIN tblsession ON tblsession.Id = tblfeepayment.sessionId
                                                        JOIN tblterm ON tblterm.id = tblfeepayment.termId
                                                        JOIN tbllevel ON tbllevel.Id = tblfeepayment.classId
                                                        JOIN tblfeetype ON tblfeetype.Id = tblfeepayment.feeTypeId
                                                        JOIN tblfees ON tblfees.fee_id = tblfeepayment.feeId 
                                                        WHERE tblfeepayment.studentId='$sid' AND tblfeepayment.classId='$classId' AND tblfeepayment.sessionId='$sessionId' AND tblfeepayment.feeTypeId='$feeNameId'");

                                                        
                                                        

                                                        if($qrry == true){
                                                            while($rowFee = mysqli_fetch_assoc($qrry)){
                                                               

                                                        
                                                        
                                                        // while($rowpaymentprint = mysqli_fetch_assoc($sql)){
                                                            $totalDueAmount += $rowFee["dueAmount"];
                                                    ?>
                                                    <tr>
                                                    <td><?php echo $rowFee["feeName"] ?></td>
                                                        <?php 
                                                            $level = explode(" ", $_GET["level"]);
                                                        if(explode(" ", $rowFee["levelName"])[0] == "Primary"){
                                                            ?>
                                                            <td><?php echo $rowFee["termName"] ?></td>

                                                        <?php  }else{?>
                                                            <td><?php echo $rowFee["feeMonth"] ?></td>


                                                            <?php  }?>
                                                        <td>GHS <?php echo formatMoney($rowFee["fee_amount"], true)  ?></td>
                                                        <td>GHS <?php echo formatMoney($rowFee["feePaid"], true)  ?></td>
                                                        <td>GHS <?php echo formatMoney($rowFee["dueAmount"], true)  ?></td>
                                                    </tr>
                                                        <?php 
                                                        $count++;


                                                        
                                                            }
                                                    
                                                            // }
                                                        ?>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan=""><strong style="font-size: 20px;">Total</strong></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th colspan=""><strong style="font-size: 16px;">GHS <?php  echo formatMoney($totalDueAmount, true)  ?></strong></th>
                                                    </tr>
                                                    <?php   }?>
                                                </tfoot>
                                            </table>
                                        </div>
                                            <br><br><br>
                                            <br><br><br>
                                    
                                        <div style="display: flex; justify-content:space-between">
                                            <div>
                                                <h4>Headmaster/Headmistress Signature</h4><br>
                                                <hr style="border: 1px dotted #000;width:300px;padding-left:0">
                                            </div>
                                            <div class="text-left">
                                                <h4>Contact Us On:</h4><br>
                                                <h4>0249917743 / 0207194046</h4>
                                            </div>
                                            
                                        </div>
                                        <!-- <br><br><br>
                                            <br><br><br>
                                            <br><br><br>
                                            <br><br><br> -->
                                     

                                    </div>
                                    

                                                        <?php
                                                }
                                              }
                                             }
                                        }else{ //num rows
                                            echo "<div class=\"row\">
                                            <div class=\"col-12 text-center border-1\">
                                               <h1> NO RESULT FOUND</h1>
                                            </div>
                                        </div> ";
                                        } //num rows
                                
                                
                                    }//if isset
                                
                                    ?>
                                </div>
                                   
                            </div>
                        </div>
                    </div>
<!-- end of datatable -->

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

        <?php include 'includes/footer.php';?>

        <script type="text/javascript">
        
            $(document).ready(function() {
            
            let todayDate = new Date();
            let currentDay = todayDate.getDay();
            let day = "";
            let option = {
            weekday:"short",
            day: "numeric",
            month: "short",
            year: "numeric"
            }
            var currentDate = $(".currentDate");
            
            // console.log("Workig alright");
            day = todayDate.toLocaleDateString("en-US", option);
            currentDate.text(day)
            console.log(currentDate);
        } );

    </script>

<!-- Log on to codeastro.com for more projects! -->

</body>
</html>

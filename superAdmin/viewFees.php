
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
                                    <li class="active">View Fees</li>
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
                                                        echo'<option value="'.$row['levelName']. ' ' . $row['Id'].'" >'.$row['levelName'].'</option>';
                                                            }
                                                                echo '</select>';
                                                            }
                                                ?>   
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-group">
                                                <button type="submit"  name="filter" class="btn btn-info form-control">Felter</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Session</th>
                                                <!-- <th>Term</th> -->
                                                <!-- <th>Month</th> -->
                                                <th>Class</th>
                                                <th>Fee Type</th>
                                                <th>Total Fee Amount</th>
                                                <th>Total Fee Paid</th>
                                                <th>Due Amount</th>
                                                <!-- <th>Date</th> -->
                                                <th>Status</th>
                                                <th>Action</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            if(isset($_POST["filter"])){
                                                $feeNameId = $_POST["feeNameId"];
                                                // $feeType = $_POST["fee_type"];
                                                $sessionId = $_POST["sessionId"];
                                                // $termId = $_POST["termId"];
                                                $class = $_POST["classId"];
                                                $classExplode = explode(" ",$class);
                                                $classExplodeLastIndex = count($classExplode)-1;
                                                $classId = $classExplode[$classExplodeLastIndex];


                                                // echo "<script> alert('classId : $classId,SessionId : $sessionId, termId : $termId,feeTypeId : $feeNameId')</script>";
                                            

                                                    $ret=mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tblterm.termName,tbllevel.levelName,tblfees.fee_amount,SUM(tblfees.fee_amount) as totalFeeAmount,tblfeepayment.feePaid,SUM(tblfeepayment.feePaid) as totalAmountPaid,tblfeepayment.month,tblfeepayment.dueAmount,SUM(tblfeepayment.dueAmount) as totalDueAmount,tblfeepayment.Id,tblfeepayment.dateCreated,tblfeetype.feeName,tblfeepayment.studentId,tblstudent.sid  FROM tblfeepayment 
                                                    LEFT JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
                                                    LEFT JOIN tblsession ON tblsession.Id = tblfeepayment.sessionId
                                                    LEFT JOIN tblterm ON tblterm.id = tblfeepayment.termId
                                                    LEFT JOIN tbllevel ON tbllevel.Id = tblfeepayment.classId
                                                    LEFT JOIN tblfeetype ON tblfeetype.Id = tblfeepayment.feeTypeId
                                                    LEFT JOIN tblfees ON tblfees.fee_id = tblfeepayment.feeId
                                                    WHERE tblfeepayment.sessionId='$sessionId'  AND tblfeepayment.classId='$classId' AND tblfeepayment.feeTypeId='$feeNameId' 
                                                    GROUP BY tblfeepayment.studentId,tblsession.sessionName,tbllevel.levelName");

                                                   
                                               




                                                
                                                
                                            }else{
                                                $ret=mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tblterm.termName,tbllevel.levelName,tblfees.fee_amount,SUM(tblfees.fee_amount) as totalFeeAmount,tblfeepayment.feePaid,SUM(tblfeepayment.feePaid) as totalAmountPaid,tblfeepayment.month,tblfeepayment.dueAmount,SUM(tblfeepayment.dueAmount) as totalDueAmount,tblfeepayment.Id,tblfeepayment.dateCreated,tblfeetype.feeName,tblfeepayment.studentId,tblstudent.sid  FROM tblfeepayment 
                                                LEFT JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
                                                LEFT JOIN tblsession ON tblsession.Id = tblfeepayment.sessionId
                                                LEFT JOIN tblterm ON tblterm.id = tblfeepayment.termId
                                                LEFT JOIN tbllevel ON tbllevel.Id = tblfeepayment.classId
                                                LEFT JOIN tblfeetype ON tblfeetype.Id = tblfeepayment.feeTypeId
                                                LEFT JOIN tblfees ON tblfees.fee_id = tblfeepayment.feeId 
                                                GROUP BY tblfeepayment.studentId,tblsession.sessionName,tbllevel.levelName");
                                            }
                                                
                                                $cnt=1;
                                                $ccc = mysqli_error($con);
                                                if(!$ret){
                                                    echo $ccc;
                                                }
                                                // echo "<script> alert('Come')</script>";
                                                    
                                                
                                                while ($row=mysqli_fetch_assoc($ret)) {
                                                    $levelExplode = explode(" ", $row["levelName"]);
                                                    
                                                    // echo "<script> alert('SessionId : $sessionId, termId : $termId,feeTypeId : $feeNameId')</script>";
                                                
                                            ?>
                                                <tr>

                                                    <td><?php echo $cnt;?></td>
                                                    <td><?php  echo $row['firstName'].' '.$row['lastName'].' '.$row['otherName'];?></td>
                                                    <td><?php echo $row['sessionName'];?></td>
                                                    
                                                    <?php
                                                            // if($levelExplode[0] == "Primary"){
                                                            //     echo "<td>Fist, Second And Third Term</td>";
                                                            // }else{
                                                                // echo "<td>$row[termName]</td>";
                                                            // }
                                                        
                                                    ?>
                                                    <!-- <td><?php //echo $row['termName'];?></td> -->
                                                    <!-- <td><?php //echo $row['month'];?></td> -->
                                                    <td><?php echo $row['levelName'];?></td>
                                                    <td><?php echo $row['feeName'];?></td>
                                                    <td><?php echo formatMoney($row['totalFeeAmount'],true);?></td>
                                                    <td><?php echo formatMoney($row['totalAmountPaid'],true);?></td>
                                                    <td><?php echo formatMoney($row['totalDueAmount'],true);?></td>
                                                    <!-- <td><?php //echo $row['dateCreated'];?></td> -->
                                                    <?php 
                                                        if($row['fee_amount'] == $row['feePaid'] ){
                                                            echo " <td ><p style=\"background-color: green; color: white; text-align:center;border-radius: 20px\"  class=\"py-1 px-2\">Finished</p></td>";
                                                        }elseif($row['fee_amount'] > $row['feePaid']){
                                                            echo " <td ><p style=\"background-color: red; color: white; text-align:center;border-radius: 20px\" class=\"py-1 px-2\">Owing</p></td>";
                                                        }elseif($row['fee_amount'] < $row['feePaid']){
                                                            echo " <td ><p style=\"background-color: yellow; color: #000; text-align:center;border-radius: 20px; \" class=\"py-1 px-2\">(Owing)</p></td>";
                                                        }
                                                    ?>
                                                    <!-- <td><?php //echo $row['levelName'];?></td> -->
                                                    
                                                    
                                                    <td style="display: flex; align-items:center;justify-content:center">
                                                        <button style="width: 100%;" class="btn "><a width="100%" title="Print student fee rport" href="printFee.php?Id=<?php echo $row['Id'];?>&studentId=<?php echo $row['studentId'];?>&year=<?php echo $row["sessionName"] ?>&level=<?php echo $row["levelName"] ?>" ><i class="fa fa-print fa-1x"></i> </a></button>
                                                    <!-- <hr> -->
                                                    <span style="width: 10px; height: 100%; background-color:red; z-index:99"></span>
                                                    <button style="width: 100%;" class="btn" ><a title="Edit student fee" href="editFees.php?Id=<?php echo $row['Id'];?>&studentId=<?php echo $row['studentId'];?>&year=<?php echo $row["sessionName"] ?>&level=<?php echo $row["levelName"] ?>"><i class="fa fa-edit fa-1x"></i> </a></button>
                                                </td>
                                                </tr>
                                                <?php  //}elseif($levelExplode[0] == "Primary"){ ?>
                                                <?php 
                                            // }
                                                $cnt=$cnt+1;
                                                }?>
                                                                                    
                                        </tbody>
                                    </table>
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

<!-- Log on to codeastro.com for more projects! -->

</body>
</html>

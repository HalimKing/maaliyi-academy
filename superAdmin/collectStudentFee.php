
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);

    if(isset($_GET["Id"]) || isset($_GET["levelId"]) || isset($_GET["sessionId"])){

    

    $qrystd = mysqli_query($con,"SELECT * FROM tblleveldata WHERE studentId='$_GET[Id]'");
    $rowstd = mysqli_fetch_assoc($qrystd);
    $qrylevel = mysqli_query($con,"SELECT * FROM tbllevel WHERE Id='$_GET[levelId]'");
    $rowlevel = mysqli_fetch_assoc($qrylevel);
    $qrysession = mysqli_query($con,"SELECT * FROM tblsession WHERE Id='$_GET[sessionId]'");
    $rowsession = mysqli_fetch_assoc($qrysession);

    // $qryFee = mysqli_query($con, "SELECT month FROM tblfee WHERE ");
    if($rowstd <= 0 ||  $rowlevel <= 0 || $rowsession <= 0){
        echo "<script type = \"text/javascript\">
        window.location = (\"collectFees.php\")
        </script>";
    }
    }else{
        echo "<script type = \"text/javascript\">
        window.location = (\"collectFees.php\")
        </script>"; 
    }
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
<!-- Head -->
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
                    <div class="col-sm-4 dash">
                        <div class="page-header float-left">
                            <div class="page-title ">
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
                                    <li class="active">Collect Fees</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs" style="background-color: transparent;">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1><a href="collectFees.php"><button class="btn btn-dark">Back</button></a></h1>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                   
               

                <br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center"><?php echo $rowstd['firstName'].' '.$rowstd['lastName'].' '.$rowstd['otherName']; ?></h2></strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr><!-- Log on to codeastro.com for more projects! -->
                                                <th>#</th>
                                                <th>Fee Type</th>
                                                <th>Session</th>
                                                <th>Month / Term</th>
                                                <th>Fee</th>

                                                <!-- <th>Fee Paid</th>
                                                <th>Due Fee</th> -->
                                                <th>Action</th>

                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                                // $ret=mysqli_query($con,"SELECT tblstudent.Id, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName,tblstudent.city,tblstudent.address,tblstudent.sessionId,tblstudent.classId,
                                                // tblstudent.dateCreated, tbllevel.levelName,tblsession.sessionName
                                                // from tblstudent
                                                // JOIN tbllevel ON tbllevel.Id = tblstudent.classId
                                                // INNER JOIN tblsession ON tblsession.Id = tblstudent.sessionId");
                                                $cnt=1;
                                                
                                                // echo "<script>alert('Good')</script>";
                                                $splitLevel = explode(" ",$rowlevel['levelName']);
                                                
                                                if( $splitLevel[0] === "Primary"){
                                                    $query = mysqli_query($con, "SELECT tblfees.fee_id,tblfees.fee_amount,tblfees.sessionId,tblfees.termId,tblsession.sessionName,tblfeetype.feeName,tblfees.feeNameId,tblterm.termName FROM tblfees 
                                                    JOIN tblsession ON tblsession.Id = tblfees.sessionId
                                                    JOIN tblterm ON tblterm.id = tblfees.termId
                                                    JOIN tblfeetype ON tblfeetype.Id = tblfees.feeNameId
                                                    WHERE level='Primary' ORDER BY tblsession.sessionName ASC");
                                                }elseif($splitLevel[0] === "KG"){
                                                    $query = mysqli_query($con, "SELECT tblfees.fee_id,tblfees.fee_amount,tblfees.sessionId,tblfees.termId,tblsession.sessionName,tblfeetype.feeName,tblfees.feeNameId,tblfees.feeMonth
                                                    FROM tblfees
                                                    JOIN tblsession ON tblsession.Id = tblfees.sessionId
                                                    JOIN tblfeetype ON tblfeetype.Id = tblfees.feeNameId
                                                    WHERE level='KG' ORDER BY tblsession.sessionName ASC");

                                                }elseif($splitLevel[0] === "Nursery"){
                                                    $query = mysqli_query($con, "SELECT tblfees.fee_id,tblfees.fee_amount,tblfees.sessionId,tblfees.termId,tblsession.sessionName,tblfeetype.feeName,tblfees.feeNameId,tblfees.feeMonth
                                                    FROM tblfees
                                                    JOIN tblsession ON tblsession.Id = tblfees.sessionId
                                                    JOIN tblfeetype ON tblfeetype.Id = tblfees.feeNameId
                                                    WHERE level='Nursery' ORDER BY tblsession.sessionName ASC");

                                                }elseif($splitLevel[0] === "Creche"){
                                                    $query = mysqli_query($con, "SELECT tblfees.fee_id,tblfees.fee_amount,tblfees.sessionId,tblfees.termId,tblsession.sessionName,tblfeetype.feeName,tblfees.feeNameId,tblfees.feeMonth
                                                    FROM tblfees
                                                    JOIN tblsession ON tblsession.Id = tblfees.sessionId
                                                    JOIN tblfeetype ON tblfeetype.Id = tblfees.feeNameId
                                                    WHERE level='Creche' ORDER BY tblsession.sessionName ASC");

                                                }
                                                
                                                
                                                
                                                // echo "<script>alert('Good to go')</script>";
                                                while ($row=mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $cnt;?></td>
                                                    <td><?php  echo $row['feeName']?></td>
                                                    <td><?php echo $row['sessionName'];?></td>
                                                    <td><?php 
                                                        if($splitLevel[0] != "Primary"){
                                                            echo $row['feeMonth'];
                                                        }else{
                                                            echo $row['termName'];
                                                        }
                                                   ?></td>
                                                    <td>GHS <?php echo formatMoney($row['fee_amount'],true);?></td>
                                                    <!-- <td><?php //echo "Waiting";?></td> -->
                                                    <td><a title=" Click to take student fee" href="feePayment.php?fee_id=<?php echo $row['fee_id'] ?>&Id=<?php echo $_GET["Id"] ?>&level=<?php echo $splitLevel[0] ?>&sessionId=<?php echo $row['sessionId'] ?>&levelId=<?php echo $rowlevel["Id"]  ?>&termId=<?php echo $row["termId"] ?>&feetypeId=<?php echo $row["feeNameId"] ?>"><img src="img/money.png"  width="30px" alt=""></a></td>
                                                    
                                                    
                                                    <!-- <td> -->
                                                    <!-- <a href="collectStudentFee.php?Id=<?php // echo $row['Id'];?>&levelId=<?php //echo $row['classId'] ?>" title="Collet Fee"><i class="fa fa-money fa-1x"></i> Collect</a></td> -->
                                                </tr>
                                                <?php 
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

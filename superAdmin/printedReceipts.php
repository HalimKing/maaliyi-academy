
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
                                    <li><a href="#">Fees</a></li>
                                    <li class="active">Receipts</li>
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
                                <strong class="card-title"><h2 align="center">All Receipts</h2></strong>
                            </div>
                            <div class="card-body">
                               
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Receipt Number</th>
                                                <th>Student Name</th>
                                                <th>Amount</th>
                                                <th>Payment Amount</th>
                                                <th>Payment Balance</th>
                                                <th>Due Amount</th>
                                                <th>Date</th>
                                                
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $receipt=mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName, tblreceipt.receiptNumber,  tblreceipt.studentId,tblreceipt.paymentId,tblreceipt.receiptDate, tblfeepayment.feePaid, tblfeepayment.feeAmount, tblfeepayment.dueAmount, tblfeepayment.dateCreated  
                                            FROM tblreceipt 
                                            JOIN tblfeepayment ON tblfeepayment.Id = tblreceipt.paymentId	
                                            JOIN tblstudent ON tblstudent.sid = tblreceipt.studentId");
                                                $cnt=1;
                                                
                                                // echo "<script> alert('Come')</script>";
                                                    
                                                
                                            while ($row=mysqli_fetch_assoc($receipt)) {
                                                    
                                                
                                            ?>
                                                <tr>

                                                    <td><?php echo $cnt;?></td>
                                                    <td><?php echo $row['receiptNumber'];?></td>
                                                    <td><?php  echo $row['firstName'].' '.$row['lastName'].' '.$row['otherName'];?></td>
                                                    <td><?php echo $row['feeAmount'];?></td>
                                                    <td><?php echo $row['feePaid'];?></td>
                                                    <td><?php echo floatval($row['feeAmount']) - floatval($row['feePaid']);?></td>
                                                    <td><?php echo $row['dueAmount'];?></td>
                                                    <td><?php echo $row['receiptDate'];?></td>
                                                   
                                                </td>
                                                </tr>
                                                <?php  //}elseif($levelExplode[0] == "Primary"){ ?>
                                                <?php 
                                            // }
                                                $cnt=$cnt+1;
                                                }?>
                                                                                    
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Receipt Number</th>
                                                <th>Student Name</th>
                                                <th>Amount</th>
                                                <th>Payment Amount</th>
                                                <th>Payment Balance</th>
                                                <th>Due Amount</th>
                                                <th>Date</th>
                                            </tr>
                                        </tfoot>
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


<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);

// $lev = $_GET["level"];
    // $qryterm = mysqli_query($con,"SELECT * FROM tblterm WHERE id='$_GET[termId]'");

    // $qrystd = mysqli_query($con,"SELECT * FROM tblstudent WHERE Id='$_GET[Id]'");

    // $qryfee = mysqli_query($con,"SELECT * FROM tblfees WHERE fee_id='$_GET[fee_id]'");

    // $qrysession = mysqli_query($con,"SELECT * FROM tblsession WHERE Id='$_GET[sessionId]'");


    $qry=mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tblterm.termName,tbllevel.levelName,tblfees.fee_amount,tblfees.feeMonth,tblfeepayment.feePaid,tblfeepayment.dueAmount,tblfeepayment.dateCreated,tblfeepayment.sessionId,tblfeepayment.studentId,tblfeetype.feeName FROM tblfeepayment 
    LEFT JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
    LEFT JOIN tblsession ON tblsession.Id = tblfeepayment.sessionId
    LEFT JOIN tblterm ON tblterm.id = tblfeepayment.termId
    LEFT JOIN tbllevel ON tbllevel.Id = tblfeepayment.classId
    LEFT JOIN tblfeetype ON tblfeetype.Id = tblfeepayment.feeTypeId
    LEFT JOIN tblfees ON tblfees.fee_id = tblfeepayment.feeId WHERE tblfeepayment.Id='$_GET[Id]'");

    if($qry == false){
        header("location: viewFees.php");
        // echo mysqli_error($con);
    }

    // $rowterm = mysqli_fetch_assoc($qryterm);

    // $rowstd = mysqli_fetch_assoc($qrystd);
    

    // $rowfee = mysqli_fetch_assoc($qryfee);
    

    $rowpayment = mysqli_fetch_assoc($qry);
    $classExplode = explode(" ", $rowpayment['levelName']);
    $lev = $classExplode[0];

    // echo "<script>alert('$lev')</script>";




if(isset($_POST['update'])){

     $alertStyle ="";
      $statusMsg="";
    // student
    $studentId = $rowpayment["studentId"];
    $feeId=$rowpayment["feeId"];
    $sessionId=$rowpayment['sessionId'];
    $feeAmount=$_POST['fee_amount'];
    $paidAmount = $_POST['feePaid'];
    // $dueAmount = $_POST['dueAmount'];


    $dateCreated = date("Y-m-d");


 
    $query=mysqli_query($con,"SELECT * FROM tblfeepayment WHERE Id ='$_GET[Id]'");
    $ret=mysqli_fetch_assoc($query);
    if($ret > 0){

        $query=mysqli_query($con,"UPDATE tblfeepayment SET feePaid=feePaid+$paidAmount, dueAmount=dueAmount-$paidAmount WHERE Id='$_GET[Id]'");

        if ($query) {

            $alertStyle ="alert alert-success";
            $statusMsg="Fee Updated Successfully!";
            echo "
            <script>
                confirm('Succesful Updated Fee');
                window.location = (\"viewFees.php\")
            </script>
            ";
            // header("location: collectStudentFee.php?Id=$rowstd[Id]&levelId=$_GET[levelId]&sessionId=$rowsession[Id]");
        }
        else
        {
            $alertStyle ="alert alert-danger";
            $statusMsg="An error Occurred!" . mysqli_error($con);
        }

    }
    else{

        
        $alertStyle ="alert alert-danger";
        $statusMsg="Error Occured!";
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
                                    <li class="active">Edit Fee Payment</li>
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
                                <h1><a href="viewFees.php"><button class="btn btn-dark">Back</button></a></h1>
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
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">Edit <strong><?php echo $rowpayment['firstName'].' '.$rowpayment['lastName'].' '.$rowpayment['otherName'] . ' ' . $rowpayment['feeName']  ?></strong></h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                        
                                            <h2>Student Fee Information</h2>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Class</th>
                                                            <th scope="col">Fee Type</th>
                                                            <th scope="col">Year</th>
                                                            <th scope="col">Month/Term</th>
                                                            <th scope="col">Fee Amount</th>
                                                            <th scope="col">Fee Paid</th>
                                                            <th scope="col">Balance</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                        $sql = mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tblterm.termName,tbllevel.levelName,tblfees.fee_amount,tblfees.feeMonth,tblfeepayment.feePaid,tblfeepayment.dueAmount,tblfeepayment.dateCreated,tblfeetype.feeName,tblfeepayment.Id FROM tblfeepayment 
                                                                        LEFT JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
                                                                        LEFT JOIN tblsession ON tblsession.Id = tblfeepayment.sessionId
                                                                        LEFT JOIN tblterm ON tblterm.id = tblfeepayment.termId
                                                                        LEFT JOIN tbllevel ON tbllevel.Id = tblfeepayment.classId
                                                                        LEFT JOIN tblfeetype ON tblfeetype.Id = tblfeepayment.feeTypeId
                                                                        LEFT JOIN tblfees ON tblfees.fee_id = tblfeepayment.feeId WHERE tblfeepayment.studentId='$_GET[studentId]' AND tblsession.sessionName='$_GET[year]' AND tbllevel.levelName='$_GET[level]'");
                                                                    
                                                                    $count = 1;
                                                                    if($query == true){
                                                                        while($rowman = mysqli_fetch_assoc($sql)){
                                                                            $totalAmount += $rowman["fee_amount"];
                                                                            $totalPaid += $rowman["feePaid"];
                                                                            $totalAmountOwe += $rowman["dueAmount"];
                                                                    
                                                            
                                                            ?>
                                                            <tr>
                                                            <th scope="row"><?php echo $count ?></th>
                                                            <td><?php echo $rowman["levelName"] ?></td>
                                                            <td><?php echo $rowman["feeName"] ?></td>
                                                            <td><?php echo $rowman["sessionName"] ?></td>
                                                            <?php 
                                                                $level = explode(" ", $_GET["level"]);
                                                                if($level[0] == "Primary"){
                                                            ?>
                                                               <td><?php echo $rowman["termName"] ?></td>

                                                            <?php  }else{?>
                                                                <td><?php echo $rowman["feeMonth"] ?></td>


                                                            <?php  }?>
                                                            
                                                            
                                                            <td><?php echo formatMoney($rowman["fee_amount"], true) ?></td>
                                                            <td><?php echo formatMoney($rowman["feePaid"], true) ?></td>
                                                            <td><?php echo formatMoney($rowman["dueAmount"], true) ?></td>
                                                            <td>
                                                                <form action="updateFee.php?Id=<?php echo $_GET['Id'];?>&studentId=<?php echo $_GET['studentId'];?>&year=<?php echo $_GET["year"] ?>&level=<?php echo $_GET["level"] ?>" method="POST">
                                                                    <div class="form-group d-flex justify-content-between gap-2">
                                                                        <input type="text" id="feePaid" name="amount" class="form-control" placeholder="Enter Amount">
                                                                        <input type="hidden" value="<?php echo $rowman["Id"] ?>" name="feeId">
                                                                        <button type="submit" name="updateFee" class="btn btn-success">Update</button>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td>
                                                            <a href="receiptPreview.php?feeId=<?php echo $_GET["Id"] ?>"><button class="btn btn-primary">Preview</button></a>
                                                                
                                                            </td>

                                                            </tr>

                                                            <?php 
                                                            $count++;
                                                                    }
                                                                }
                                                            ?>
                                                            
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="5">Total</th>
                                                                <th><?php echo formatMoney($totalAmount,true)  ?></th>
                                                                <th><?php echo formatMoney($totalPaid, true)  ?></th>
                                                                <th><?php echo formatMoney($totalAmountOwe, true)  ?></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>

                                                </div>
                                            </div>
                                            
                                            

                                            
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
               

                
<!-- end of datatable -->

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

        <?php include 'includes/footer.php';?>



    <script type="text/javascript">
        

            // $("#feePaid").keyup(function (e) { 
            //     $("#dueAmount").val()-$("#feePaid").val();
            //     var fP = $("#feePaid").val();
            //     var feeAmt = $("#dueAmount").val();
                
            //     var feeBalance = feeAmt - fP;
            //     $("#dueAmount").val(feeBalance).fx;
            // });
            // var feeAmt = $("#dueAmount").val();
            // updateBalance(feeAmt);
            // function updateBalance(balance){
            //     $("#dueAmount").val(balance.toFixed);
            // }
            // $("#feePaid").on("input", function () {

            //     // $("#dueAmount").val()-$("#feePaid").val();
            //     var fP = parseFloat( $("#feePaid").val());
            //     var feeAmt = $("#dueAmount").val();
            //     if($("#feePaid").val() != ""){
            //         var feeBalance = feeAmt - fP;
            //     }
                
                
                
            //     // var feeBalance = feeAmt - fP;
            //     $("#dueAmount").val(feeBalance.toFixed(2));
            // });
            let numbers = "1234567890.";
            $("#feePaid").on("input", function () { 
                $(this).val($(this).val().replace(/[^0-9.]/g, ''));
                
                // Ensure only one decimal point
                if ($(this).val().split('.').length > 2) {
                    $(this).val($(this).val().substring(0, $(this).val().lastIndexOf('.')));
                }
                
            });
      
  </script>

</body>
</html>

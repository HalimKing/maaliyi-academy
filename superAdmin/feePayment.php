
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);

    $lev = $_GET["level"];
    $qryterm = mysqli_query($con,"SELECT * FROM tblterm WHERE id='$_GET[termId]'");

    $qrystd = mysqli_query($con,"SELECT * FROM tblstudent WHERE Id='$_GET[Id]'");

    $qryfee = mysqli_query($con,"SELECT  tblfees.fee_amount,tblfees.feeMonth,tblfees.feeNameId,tblfeetype.feeName
    FROM tblfees
    JOIN tblfeetype ON tblfeetype.Id = tblfees.feeNameId
    WHERE fee_id ='$_GET[fee_id]'");

    $qryFeePay = mysqli_query($con, "SELECT * FROM tblfeepayment WHERE studentId='$_GET[Id]' AND sessionId='$_GET[sessionId]' AND feeId='$_GET[fee_id]' AND classId='$_GET[levelId]' AND feeTypeId='$_GET[feetypeId]'");
    if($qryFeePay == true){
        $rowFeePay = mysqli_fetch_assoc($qryFeePay);
        if(mysqli_num_rows($qryFeePay) > 0){
            echo "grate";
            // return false;
        }
        // echo "Woow";
        // return false;
    }else{
        // echo "Hooo" . mysqli_error($con);
        // return false;
    }

    // $qryfee = mysqli_query($con,"SELECT * FROM tblfeetype WHERE Id='$_GET[fee_id]'");

    $qrysession = mysqli_query($con,"SELECT * FROM tblsession WHERE Id='$_GET[sessionId]'");

    if($qrystd == false && $qryfee == false && $qrysession == false){
        header("location: collectStudentFee.php");
    }

    $rowterm = mysqli_fetch_assoc($qryterm);
    
    
    $rowstd = mysqli_fetch_assoc($qrystd);
    $ssql = mysqli_query($con, "SELECT * FROM tbllevel WHERE id='$rowstd[classId]'");
    $rowLevel = mysqli_fetch_assoc($ssql);

    $rowfee = mysqli_fetch_assoc($qryfee);
    

    $rowsession = mysqli_fetch_assoc($qrysession);




if(isset($_POST['payment'])){

     $alertStyle ="";
      $statusMsg="";
    // student
    $studentId = $rowstd["Id"];
    $feeId=$_GET["fee_id"];
    $sessionId=$rowsession['Id'];
    $feeAmount=$_POST['feeAmount'];
    $paidAmount = $_POST['feePaid'];
    // $dueAmount = $_POST['dueAmount'];


    $dateCreated = date("Y-m-d");

 
        $query=mysqli_query($con,"SELECT * FROM tblfeepayment WHERE studentId ='$_GET[Id]' AND feeId='$_GET[fee_id]' AND sessionId='$sessionId'");
        $ret=mysqli_fetch_assoc($query);
        if($ret > 0){

            $alertStyle ="alert alert-danger";
            $statusMsg="Student Already paid!";

        }
        else{

            $query=mysqli_query($con,"INSERT INTO tblfeepayment(studentId,sessionId,termId,month,classId,feeId,feeTypeId,feeAmount,feePaid,dueAmount,dateCreated) VALUES('$_GET[Id]','$sessionId','$rowterm[id]','$rowfee[feeMonth]','$_GET[levelId]','$feeId','$rowfee[feeNameId]','$feeAmount','$paidAmount',$feeAmount-$paidAmount,'$dateCreated')");

            if ($query) {
                $sqq = mysqli_query($con, "SELECT * FROM tblfeepayment ORDER BY Id DESC LIMIT 0,1");
                $r = mysqli_fetch_assoc($sqq);
              

                $alertStyle ="alert alert-success";
                $statusMsg="Fee saved Added Successfully!";
                echo "
                <script>
                    alert('Succesful saved Fee');
                    window.location=\"receiptPreview.php?feeId=$r[Id]\"
                </script>
                ";
                // window.location = (\"collectStudentFee.php?Id=$_GET[Id]&levelId=$_GET[levelId]&sessionId=$rowsession[Id]\")

                // header("location: collectStudentFee.php?Id=$rowstd[Id]&levelId=$_GET[levelId]&sessionId=$rowsession[Id]");
            }
            else
            {
                $alertStyle ="alert alert-danger";
                $statusMsg="An error Occurred!" . mysqli_error($con);
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
                    <div class="col-sm-4 dash">
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
                                    <li><a href="#">Student</a></li>
                                    <li class="active">Add Student</li>
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
                                <h1><a href="collectStudentFee.php?<?php echo "Id=$_GET[Id]&levelId=$_GET[levelId]&sessionId=$_GET[sessionId]" ?>"><button class="btn btn-dark">Back</button></a></h1>
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
                                <strong class="card-title"><h2 align="center">Collect <strong><?php echo $rowstd['firstName'] .' '.$rowstd['lastName'] .' '.$rowstd['otherName'] . ' </strong>' . '   ' . $rowfee['feeName'] ?></h2></strong>
                            </div>
                            
                            <div class="card-body">
                                
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="row pb-3">
                                            <div class="col-12">
                                                <h3><strong>Class :</strong> <span><?php  echo $rowLevel["levelName"] ?></span> </h3>
                                            </div>
                                        </div>
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                        <form method="Post" action="" autocomplete="off">
                                            <h2>Student Fee Information</h2>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Fee Type <span style="color: red;">*</span></label>
                                                        <input id="" name="feeType" value="<?php echo $rowfee['feeName']  ?>" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Firstname" autocomplete="off" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
												<!-- Log on to codeastro.com for more projects! -->
                                                    <label for="x_card_code" class="control-label mb-1">Session<span style="color: red;">*</span></label>
                                                        <input id="" name="session" value="<?php echo $rowsession['sessionName']  ?>" type="text" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Lastname" autocomplete="off" readonly>
                                                        </div>
                                                    </div>
                                                    <div>
                                        <div class="row">
                                           
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Term <span style="color: red;">*</span></label>
                                                    <input id="" name="othername" value="<?php echo $rowterm['termName']  ?>" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Term" readonly>
                                               </div>
                                           </div>
                                           <?php 
                                               if($lev == "KG" || $lev == "Nursery" || $lev == "Creche"){

                                               
                                           ?>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Month <span style="color: red;">*</span></label>
                                                    <input id="" name="othername" value="<?php echo $rowfee['feeMonth']  ?>" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Term" readonly>
                                                </div>
                                           </div>
                                           <?php } ?>
                                       </div>            
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Fee Amount</label>
                                                        <input id="" name="feeAmount" value="<?php echo formatMoney($rowfee['fee_amount'],true)  ?>" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Fee Amount" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                <?php 
                                                    if(mysqli_num_rows($qryFeePay) > 0){
                                                    
                                                ?>
                                                    <div class="form-group">
                                                        <label for="" class="control-label">Fee</label>
                                                        <p class="form-control">Collected</p>
                                                    </div>
                                                <?php  
                                                
                                                    }else{

                                                
                                                ?>
                                                    <div class="form-group">
                                                        <label for="x_card_code" class="control-label mb-1">Fee Paid <span style="color: red;">*</span></label>
                                                        <input id="feePaid" name="feePaid"  type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Fee Paid" required>
                                                    </div>
                                                <?php 
                                                    }
                                                ?>
                                                    
                                                </div>
                                        </div>
                                       

                                     
                                        
                                         <div class="row">
                                                
                                                </div>
                                                <!-- <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                   <?php
                                                        //echo"<div id='txtHint'></div>";
                                                    ?>                                    
                                                    </div>
                                                 
                                                </div> -->
                                                
                                             </div>
                                             

                                             
                                             
											 <!-- Log on to codeastro.com for more projects! -->
                                             <?php 
                                                if(mysqli_num_rows($qryFeePay) > 0){

                                                
                                                
                                             ?>
                                             
                                                

                                            <?php  
                                            
                                                }else{

                                               
                                            ?>
                                                <button type="submit" name="payment" class="btn btn-success">Save Payment</button>
                                            <?php 
                                                 }
                                            ?>
                                            </div>
                                        </form>
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
        

      // Menu Trigger
     

           
            $(".fee-paid").keyup(function (e) { 
                var fP = $(".fee-paid").val();
                var fee = $(".fee").val();
                var fee_bal = $(".fee-balance");
                var f = fee - fP;
                $(".fee-balance").val(f);
                
            });


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

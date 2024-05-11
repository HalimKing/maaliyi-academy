
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);


if(isset($_GET['editFeeId'])){

$_SESSION['feeId'] = $_GET['editFeeId'];

$query = mysqli_query($con,"SELECT tblfees.feeMonth,tblterm.termName,tblfeetype.feeName,tblfees.level, tblfees.fee_amount,tblsession.sessionName
FROM tblfees
JOIN tblterm ON tblterm.id = tblfees.termId
JOIN tblfeetype ON tblfeetype.Id = tblfees.feeNameId
JOIN tblsession ON tblsession.Id = tblfees.sessionId
WHERE tblfees.fee_id='$_SESSION[feeId]'");


$rowi = mysqli_fetch_array($query);
if($rowi<= 0){
    // echo "<script type = \"text/javascript\">
    // window.location = (\"fee.php\")
    // </script>"; 
    echo mysqli_error($con);
}
$ftype = $rowi["termId"];



}

else{

echo "<script type = \"text/javascript\">
    window.location = (\"fee.php\")
    </script>"; 
}


if(isset($_POST['submit'])){

     $alertStyle ="";
    $statusMsg="";
    $termId = $_POST['termId'];
    $feeType = $_POST['fee_type'];
    $sessionId = $_POST['sessionId'];
    $feeAmount = $_POST['fee_amount'];
    $level = $_POST['level'];

    
    $dateAdded = date("Y-m-d");
   

    $query=mysqli_query($con,"UPDATE tblfees SET  fee_amount='$feeAmount', reg_date='$dateAdded' WHERE fee_id='$_SESSION[feeId]'");

    if ($query) {
        
    $alertStyle ="alert alert-success";
    $statusMsg="Fee Edited Successfully!";
    echo "<script type = \"text/javascript\">
            alert('Fee Edited Successfully!')
            window.location = (\"fee.php\")
            </script>"; 
    
    }
    else
    {
    $alertStyle ="alert alert-danger";
    $statusMsg="An error Occurred!";
    }
    
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
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Fee</a></li>
                                    <li class="active">Edit Fee</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <buttun class="btn btn-dark"><a style="color: white;" href="fee.php">Back</a></buttun>
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
                                <strong class="card-title"><h2 align="center">Add New Fee</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                        <form method="Post" action="">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Fee Type</label>
                                                        <p class="form-control"><?php echo $rowi['feeName'] ?></p>

                                                        
                                                        <!-- <input id="" name="fee_type" type="text" class="form-control cc-exp" value="<?php //echo $rowi['fee_type']  ?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Fee Type"> -->
                                                    </div>
                                                </div>
                                                <div class="col-6">
												    <!-- Log on to codeastro.com for more projects! -->
                                                    <label for="x_card_code" class="control-label mb-1">Session</label>
                                                    <p class="form-control"><?= $rowi["sessionName"] ?></p>
                                                    
                                                        
                                                </div>
                                                
                                            </div>
                                                    <div>
                                                <div class="row">
                                                <div class="col-6">
												    <!-- Log on to codeastro.com for more projects! -->
                                                    <label for="cc-exp" class="control-label mb-1">Level</label>
                                                    <p class="form-control"><?= $rowi["level"] ?></p>
                                                   
                                                    
                                                   
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                    <label for="x_card_code" class="control-label mb-1">Term</label>
                                                    <p class="form-control"><?= $rowi["termName"] ?></p>
                                                        
                                                    </div>
                                                </div>
                                            
                                            </div>
                                             
                                             <div class="row">
                                                <?php  if($rowi["level"] != "Primary"){ ?>
                                                <div class="col-6">
                                                        <div class="form-group">
                                                    
                                                            <label for="cc-exp" class="control-label mb-1">Month</label>
                                                            <p class="form-control"><?= $rowi["feeMonth"] ?></p>
                                                    
                                                                                                                
                                                        </div>
                                                </div>
                                                <?php } ?>
                                                <div class="col-6">
                                                        <div class="form-group">
                                                    
                                                            <label for="cc-exp" class="control-label mb-1">Fee Amount</label>
                                                            <input id="fee_amount" name="fee_amount" type="text" autofocus class="form-control cc-exp" value="<?php echo $rowi['fee_amount'] ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Fee Amount">
                                                    
                                                                                                                
                                                        </div>
                                                </div>
                                               
                                            </div>
                                                <button type="submit" name="submit" class="btn btn-primary">Update Fee</button>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- Log on to codeastro.com for more projects! -->
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
                    </div><!--/.col-->
               

              

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

        <?php include 'includes/footer.php';?>



    <script type="text/javascript">

            $('#fee_amount').on('input', function() {
            // Remove non-numeric characters and except for the decimal point
            $(this).val($(this).val().replace(/[^0-9.]/g, ''));
            
            // Ensure only one decimal point
            if ($(this).val().split('.').length > 2) {
                $(this).val($(this).val().substring(0, $(this).val().lastIndexOf('.')));
            }
        });
      
  </script>

</body>
</html>

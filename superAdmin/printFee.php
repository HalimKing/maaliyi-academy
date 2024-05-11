
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);

    if(isset($_GET["Id"]) == ""){
        echo "
                 <script>
                   
                     window.location = (\"viewFees.php\")
                 </script>
                ";
    }

    $query = mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tblterm.termName,tbllevel.levelName,tblfees.fee_amount,tblfees.feeMonth,tblfeepayment.feePaid,tblfeepayment.dueAmount,tblfeepayment.dateCreated,tblfeetype.feeName FROM tblfeepayment 
    JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
    JOIN tblsession ON tblsession.Id = tblfeepayment.sessionId
    JOIN tblterm ON tblterm.id = tblfeepayment.termId
    JOIN tbllevel ON tbllevel.Id = tblfeepayment.classId
    JOIN tblfeetype ON tblfeetype.Id = tblfeepayment.feeTypeId
    JOIN tblfees ON tblfees.fee_id = tblfeepayment.feeId WHERE tblfeepayment.studentId='$_GET[studentId]'");

    $sql = mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tblterm.termName,tbllevel.levelName,tblfees.fee_amount,tblfees.feeMonth,tblfeepayment.feePaid,tblfeepayment.dueAmount,tblfeepayment.dateCreated,tblfeetype.feeName FROM tblfeepayment 
    JOIN tblstudent ON tblstudent.sid = tblfeepayment.studentId
    JOIN tblsession ON tblsession.Id = tblfeepayment.sessionId
    JOIN tblterm ON tblterm.id = tblfeepayment.termId
    JOIN tbllevel ON tbllevel.Id = tblfeepayment.classId
    JOIN tblfeetype ON tblfeetype.Id = tblfeepayment.feeTypeId
    JOIN tblfees ON tblfees.fee_id = tblfeepayment.feeId WHERE tblfeepayment.studentId='$_GET[studentId]' AND tblsession.sessionName='$_GET[year]' AND tbllevel.levelName='$_GET[level]'");

    
    if($sql == true){
        if(mysqli_num_rows($sql) > 0){
            $rowStudent = mysqli_fetch_assoc($query);
            $levelNameExplode = explode(" ",$rowpaymentprint["levelName"]);
            
        }else{
            echo "
            <script>
              
                window.location = (\"viewFees.php?status=error\")
            </script>
           ";
        }
        
    }else{
        echo "
        <script>
          
            window.location = (\"viewFees.php?status=error\")
        </script>
       ";

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
   

// $lev = $_GET["level"];
//     $qryterm = mysqli_query($con,"SELECT * FROM tblterm WHERE id='$_GET[termId]'");

//     $qrystd = mysqli_query($con,"SELECT * FROM tblstudent WHERE Id='$_GET[Id]'");

//     $qryfee = mysqli_query($con,"SELECT * FROM tblfees WHERE fee_id='$_GET[fee_id]'");

//     $qrysession = mysqli_query($con,"SELECT * FROM tblsession WHERE Id='$_GET[sessionId]'");

//     if($qrystd == false && $qryfee == false && $qrysession == false){
//         header("location: collectStudentFee.php");
//     }

//     $rowterm = mysqli_fetch_assoc($qryterm);

//     $rowstd = mysqli_fetch_assoc($qrystd);
    

//     $rowfee = mysqli_fetch_assoc($qryfee);
    

//     $rowsession = mysqli_fetch_assoc($qrysession);




// if(isset($_POST['payment'])){

//      $alertStyle ="";
//       $statusMsg="";
//     // student
//     $studentId = $rowstd["Id"];
//     $feeId=$_GET["fee_id"];
//     $sessionId=$rowsession['Id'];
//     $feeAmount=$_POST['feeAmount'];
//     $paidAmount = $_POST['feePaid'];
//     // $dueAmount = $_POST['dueAmount'];


//     $dateCreated = date("Y-m-d");

 
//         $query=mysqli_query($con,"SELECT * FROM tblfeepayment WHERE studentId ='$_GET[Id]' AND feeId='$_GET[fee_id]' AND sessionId='$sessionId'");
//         $ret=mysqli_fetch_assoc($query);
//         if($ret > 0){

//             $alertStyle ="alert alert-danger";
//             $statusMsg="Student Already paid!";

//         }
//         else{

//             $query=mysqli_query($con,"INSERT INTO tblfeepayment(studentId,sessionId,termId,classId,feeId,feeAmount,feePaid,dueAmount,dateCreated) VALUES('$studentId','$sessionId','$rowterm[id]','$_GET[levelId]','$feeId','$feeAmount','$paidAmount',$feeAmount-$paidAmount,'$dateCreated')");

//             if ($query) {

//                 $alertStyle ="alert alert-success";
//                 $statusMsg="Fee saved Added Successfully!";
//                 echo "
//                 <script>
//                     alert('Succesful saved Fee');
//                     window.location = (\"collectStudentFee.php?Id=$rowstd[Id]&levelId=$_GET[levelId]&sessionId=$rowsession[Id]\")
//                 </script>
//                 ";
//                 // header("location: collectStudentFee.php?Id=$rowstd[Id]&levelId=$_GET[levelId]&sessionId=$rowsession[Id]");
//             }
//             else
//             {
//                 $alertStyle ="alert alert-danger";
//                 $statusMsg="An error Occurred!" . mysqli_error($con);
//             }
//         }
    

   
// }

  ?>

<!-- Head -->
<?php include 'includes/title.php';?>

<style>
    #content{
        font-size: 22px;
    }
</style>

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
    <?php $page="fee"; include 'includes/leftMenu.php'; ?>

   <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
            <?php include 'includes/header.php';?>
        <!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs ml-0">
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
                                    <li class="active">Print Fee</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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
        
        <div class="content text-center w-100" >
            
           
            <div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">
                <div class="row" style="width: 100%; height: 97vh;">
                    <div class="col-lg-12">
                        <div class="card" id="content" align="center" style="font-size:16px">
                            <br><br><br><br>
                            <div style="text-align:center; line-height:0">
                                
                                <img src="img/maaliyiri.jpg" width="100" alt=""> 
                                <strong class="card-title text-uppercase"><h2> Maaliyiri Academy</h2></strong>
                                <p class="text-capitalize" style="margin-bottom: 100px;">centre of excelence</p>
                                <div class="form-group">
                                <!-- <h3>Fee Receipt</h3> -->
                                </div>
                            </div>
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php //echo $statusMsg;?></div>
                                        <!-- <form method="Post" action="" autocomplete="off"> -->
                                            
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
                                                        <div class="text-left">
                                                            <h4 style="font-weight: 100; text-transform:uppercase" class="pt-2"><strong style="font-weight:800">STUDENT : </strong> <?php echo $rowStudent["firstName"] . ' '. $rowStudent["lastName"] . ' '. $rowStudent["otherName"] ?></h4>
                                                            <!-- <br> -->
                                                            <h4 style="font-weight: 100; text-transform:uppercase" class="pt-2"><strong style="font-weight:800">Class : </strong> <?php echo $rowStudent["levelName"] ?></h4>
                                                            <!-- <br> -->
                                                          
                                                            <h4 style="font-weight: 100; text-transform:uppercase"  class="pt-2"><strong style="font-weight:800">Academic Year : </strong> <?php echo $rowStudent["sessionName"] ?></h4>
                                                        </div>
                                                        
													
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group text-left">
                                                    

                                                    
                                                    <?php  
                                                     
                                                            // echo "<h4 style=\"font-weight: 100;\" class=\"pt-2\"><strong>Term : </strong>  $rowpaymentprint[termName] </h4>";
                                                            // if($levelNameExplode[0] != "Primary" ){
                                                            //     echo "<h4 style=\"font-weight: 100;\" class=\"pt-2\"><strong>Month : </strong>  $rowpaymentprint[feeMonth] </h4>";
                                                            // }
                                                        
                                                    ?>
                                                    
                                                        <h4 style="font-weight: 100; text-transform:uppercase"><strong style="font-weight:800">Date : </strong><span id="currentDate"></span><?php  //echo date("l jS \of F Y h:i:s A") ?></h4>
                                                        
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
                                                        if($level[0] == "Primary"){
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
                                                            $count = 1;
                                                            $totalDueAmount;
                                                            while($rowpaymentprint = mysqli_fetch_assoc($sql)){
                                                                $totalDueAmount += $rowpaymentprint["dueAmount"];
                                                        ?>
                                                        <tr>
                                                        <td><?php echo $rowpaymentprint["feeName"] ?></td>
                                                        <?php 
                                                            $level = explode(" ", $_GET["level"]);
                                                        if($level[0] == "Primary"){
                                                         ?>
                                                         <td><?php echo $rowpaymentprint["termName"] ?></td>

                                                        <?php  }else{?>
                                                            <td><?php echo $rowpaymentprint["feeMonth"] ?></td>


                                                            <?php  }?>
                                                        <td>GHS <?php echo formatMoney($rowpaymentprint["fee_amount"], true)  ?></td>
                                                        <td>GHS <?php echo formatMoney($rowpaymentprint["feePaid"], true)  ?></td>
                                                        <td>GHS <?php echo formatMoney($rowpaymentprint["dueAmount"], true)  ?></td>
                                                        </tr>
                                                        <?php 
                                                        $count++;
                                                            }
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
                                              
                                                
                                    </div>
                                             

                                            </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
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
        var currentDate = $("#currentDate");
        
        // console.log("Workig alright");
        day = todayDate.toLocaleDateString("en-US", option);
        currentDate.text(day)
        console.log(currentDate);
      } );

      // Menu Trigger
    //   $('#menuToggle').on('click', function(event) {
    //         var windowWidth = $(window).width();   		 
    //         if (windowWidth<1010) { 
    //             $('body').removeClass('open'); 
    //             if (windowWidth<760){ 
    //             $('#left-panel').slideToggle(); 
    //             } else {
    //             $('#left-panel').toggleClass('open-menu');  
    //             } 
    //         } else {
    //             $('body').toggleClass('open');
    //             $('#left-panel').removeClass('open-menu');  
    //         } 
                
    //         });

           
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

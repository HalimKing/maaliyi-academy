
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);

    if(isset($_POST['submit'])){

     $alertStyle ="";
      $statusMsg="";

    $termId = $_POST['termId'];
    $feeType = $_POST['feeNameId'];
    $sessionId = $_POST['sessionId'];
    $feeAmount = $_POST['fee_amount'];
    $level = $_POST['level'];
    $month = $_POST["month"];

    
    $dateAdded = date("Y-m-d");

    

    //Checks the Course Code
    if($level === "Primary"){
        $query=mysqli_query($con,"SELECT * FROM tblfees WHERE feeNameId ='$feeType' AND termId='$termId' AND sessionId='$sessionId' AND level='$level'");
    $ret=mysqli_fetch_assoc($query);
    }elseif($level === "KG" || $level === "Nursery" || $level === "Creche"){
        $query=mysqli_query($con,"SELECT * FROM tblfees WHERE feeNameId ='$feeType' AND feeMonth='$month' AND sessionId='$sessionId' AND termId='$termId' AND level='$level'");
        $ret=mysqli_fetch_assoc($query);
    }
    
// $ret > 0
     if(mysqli_num_rows($query) > 0){ //Check the coure Title
      $alertStyle ="alert alert-danger";
      $statusMsg="This Fee already exist!";

    }
    else{
        $tm = mysqli_query($con, "SELECT * FROM tblterm LIMIT 1");
        $rowtm = mysqli_fetch_assoc($tm);
        $query=mysqli_query($con,"INSERT INTO tblfees(feeNameId,feeMonth,termId,sessionId,level,fee_amount,reg_date) VALUE('$feeType','$month','$termId','$sessionId','$level','$feeAmount','$dateAdded')");

        if ($query) {
                
            $alertStyle ="alert alert-success";
            $statusMsg="Fee Created Successfully!";
        }
        else
        {
            $alertStyle ="alert alert-danger";
            $statusMsg="An error Occurred!";
        }


        // if($level == "Primary"){
        //     $tm = mysqli_query($con, "SELECT * FROM tblterm LIMIT 1");
        //     $rowtm = mysqli_fetch_assoc($tm);
        //     $query=mysqli_query($con,"INSERT INTO tblfees(feeNameId,termId,sessionId,level,fee_amount,reg_date) VALUE('$feeType','$rowtm[id]','$sessionId','$level','$feeAmount','$dateAdded')");

        //     if ($query) {
                
        //         $alertStyle ="alert alert-success";
        //         $statusMsg="Fee Created Successfully!";
        //     }
        //     else
        //     {
        //         $alertStyle ="alert alert-danger";
        //         $statusMsg="An error Occurred!". mysqli_error($con);
        //     }
        // }
        // if($level == "KG" || $level === "Nursery" || $level === "Creche"){
           
        //     $query=mysqli_query($con,"INSERT INTO tblfees(feeNameId,termId,sessionId,level,fee_amount,reg_date) VALUE('$feeType','$termId','$sessionId','$level','$feeAmount','$dateAdded')");

        //     if ($query) {
                
        //         $alertStyle ="alert alert-success";
        //         $statusMsg="Fee Created Successfully!";
        //     }
        //     else
        //     {
        //         $alertStyle ="alert alert-danger";
        //         $statusMsg="An error Occurred!";
        //     }
        // }

        
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
                                    <li class="active">Add Fees</li>
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
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Fee Type</label>
                                                        <?php 
                                                            $query=mysqli_query($con,"SELECT * FROM tblfeetype");                        
                                                            $count = mysqli_num_rows($query);
                                                            if($count > 0){                       
                                                                echo ' <select required id="" name="feeNameId" class="custom-select form-control">';
                                                                echo'<option value="">--Select Level--</option>';
                                                                while ($row = mysqli_fetch_array($query)) {
                                                                echo'<option value="'.$row['Id'].'" >'.$row['feeName'].'</option>';
                                                                    }
                                                                        echo '</select>';
                                                                    }
                                                        ?> 
                                                         
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
												    <!-- Log on to codeastro.com for more projects! -->
                                                    <label for="x_card_code" class="control-label mb-1">Session</label>
                                                    <?php  
                                                        $sql = mysqli_query($con, "SELECT * FROM tblsession WHERE isActive='1'");
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
                                                <!--  -->
                                                
                                            </div>
                                                    <div>
                                                <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="cc-exp" class="control-label mb-1">Level</label>
                                                    <select required class="custom-select form-control" name="level" id="level">
                                                        <option value="">--Select Level--</option>
                                                        <option value="KG">KG</option>
                                                        <option value="Primary">Primary</option>
                                                        <!-- <option value="Primary">Primary</option> -->
                                                        <option value="Creche">Creche</option>
                                                        <option value="Nursery">Nursery</option>
                                                    </select>
                                                    <?php
                                                        //echo"<div id='txtHint'></div>";
                                                     ?>   
                                                                                                            
                                                </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 term">
												    <!-- Log on to codeastro.com for more projects! -->
                                                    <label for="x_card_code" class="control-label mb-1">Term/Semester</label>
                                                    <?php  
                                                    
                                                        $sql = mysqli_query($con, "SELECT * FROM tblterm");
                                                        echo '
                                                            <select required id="term" name="termId" onchange="showValues(this.value)" class="custom-select form-control">';
                                                        echo'<option value="" id="sht">--Select Term/Semester--</option>
                                                            ';
                                                        while($term_row = mysqli_fetch_array($sql)){
                                                            echo '<option value="'.$term_row['id'].'"> '.$term_row['termName'] .'</option>';
                                                        }
                                                        echo '</select>';
                                                    
                                                    
                                                    ?>
                                                    
                                                        <!-- <input id="" name="courseCode" type="text" class="form-control cc-exp" value="" Required placeholder="Course Code"> -->
                                                        <!-- <input id="" maxlength="4" onkeypress="return isNumber(event)" name="courseId" type="text" class="form-control cc-cvc" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Course ID should start from 0001"> -->
                                                </div>
                                                

                                                
                                            
                                            </div>
                                             
                                             <div class="row">
                                                <div class="col-md-6 col-sm-12 month">
                                                        <label for="x_card_code" class="control-label mb-1">Month</label>
                                                        <select class="custom-select form-control" required name="month" id="month">
                                                            <option value="">--Select Month--</option>
                                                            <option value="January">January</option>
                                                            <option value="Feburary">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May</option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="Augest">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                        </select> 
                                                    </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Fee Amount</label>
                                                        <input id="amount" name="fee_amount" type="text" class="form-control cc-exp" autocomplete="off" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Fee Amount" required>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                                <button type="submit" name="submit" class="btn btn-success">Add Fees</button>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- Log on to codeastro.com for more projects! -->
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
               

                <br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">All Fees</h2></strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr><!-- Log on to codeastro.com for more projects! -->
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Term/Semester</th>
                                            <th>Month</th>
                                            <th>Session</th>
                                            <th>Level</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                        <?php
                                        $ret=mysqli_query($con,"SELECT * FROM tblfees");
                                        $qry = mysqli_query($con,"SELECT tblfees.fee_id,tblfees.feeMonth,tblterm.termName,tblfees.termId,tblsession.sessionName,tblfees.level,tblfees.fee_amount,tblfees.reg_date,tblfeetype.feeName
                                        FROM tblfees 
                                        JOIN tblterm ON tblterm.id = tblfees.termId 
                                        JOIN tblfeetype ON tblfeetype.Id = tblfees.feeNameId 
                                        JOIN tblsession ON tblsession.Id = tblfees.sessionId");

                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($qry)) {
                                            

                                            
                                                            ?>
                                                
                                                <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td><?php  echo $row['feeName'];?></td>
                                                <td><?php  echo $row['termName'];?></td>
                                                <td><?php  echo $row['feeMonth'];?></td>
                                                <td><?php  echo $row['sessionName'];?></td>
                                                <td><?php  echo $row['level'];?></td>
                                                <td><?php  echo "GHS " . formatMoney($row['fee_amount'],true);?></td>
                                                <td><?php  echo $row['reg_date'];?></td>
                                                
                                                <td><a href="editFee.php?editFeeId=<?php echo $row['fee_id'];?>" title="Edit Details"><i class="fa fa-edit fa-1x"></i></a>
                                                </td>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $(".term").hide();
            $(".month").hide();
          $('#bootstrap-data-table-export').DataTable();
      } );

      // Menu Trigger
      $('#menuToggle').on('click', function(event) {
            var windowWidth = $(window).width();   		 
            if (windowWidth<1010) { 
                $('body').removeClass('open'); 
                if (windowWidth<760){ 
                $('#left-panel').slideToggle(); 
                } else {
                $('#left-panel').toggleClass('open-menu');  
                } 
            } else {
                $('body').toggleClass('open');
                $('#left-panel').removeClass('open-menu');  
            } 
                
            }); 

      $("#level").change(function (e) { 
        
       
        if($("#level").val() == ""){
            $(".term").hide();
            $("#term").removeAttr("required");

            $(".month").hide();
            $("#month").removeAttr("required",true);
        }else if($("#level").val() == "Primary"){
            $(".month").hide();
            $("#month").removeAttr("required",true);

            $(".term").show();
            $("#term").attr("required",true);
        }else{
            $(".term").show();
            $("#term").attr("required");

            $(".month").show();
            $("#month").attr("required",true);
        }

        // if($("#level").val() == ""){
        //     $(".term").hide();
        //     $(".term").hide();  
        //     // $(selector).remove();
        // }
      });

     
      $('#amount').on('input', function() {
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

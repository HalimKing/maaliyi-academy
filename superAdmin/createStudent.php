
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);

    $year1 = "2022/2023";
    $year2 = "2023/2024";
    
    function compareAcademicYears($year1, $year2) {
        // Split the academic years into arrays
        $parts1 = explode('/', $year1);
        $parts2 = explode('/', $year2);
    
        // Extract and compare the numeric parts
        $numericYear1 = intval($parts1[0]);
        $numericYear2 = intval($parts2[0]);
    
        if ($numericYear1 > $numericYear2) {
            return "$year1 is greater than $year2";
        } elseif ($numericYear1 < $numericYear2) {
            return "$year1 is less than $year2";
        } else {
            return "$year1 is equal to $year2";
        }
        // echo compareAcademicYears($year1, $year2);
    }
    
    
// return false;
if(isset($_POST['submit'])){

     $alertStyle ="";
      $statusMsg="";

    //   Start
    function createRandomPassword() {
        $chars = "1452636985471003232303232023232023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
        while ($i <= 7) {
    
            $num = rand() % 33;
    
            $tmp = substr($chars, $num, 1);
    
            $pass = $pass . $tmp;
    
            $i++;
    
        }
        return $pass;
    }
    $studentId = createRandomPassword();
    // echo $studentId;
    // return false;

    // ******** End *****************



// student
  $firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];
  $othername=$_POST['othername'];
  $gender = $_POST["gender"];
  $class = $_POST['classId'];
  $city = $_POST['city'];
  $address = $_POST['address'];
//   $levelId=$_POST['levelId'];
    $sessionId=$_POST['sessionId'];
    // guidian
    $guidianName = $_POST['guidianName'];
    $guidianPhone = $_POST['guidianPhone'];
    $additionalPhone = $_POST['additionalPhone'];
    $email = $_POST['email'];
    $dob = $_POST['dOB'];
 


$departmentId=$_POST['departmentId'];
// $facultyId=$_POST['facultyId'];
  $dateCreated = date("Y-m-d");



    $query=mysqli_query($con,"select * from tblstudent where sid ='$studentId'");
    // $ret=mysqli_fetch_array($query);
    while($query == false){
        $studentId = createRandomPassword();
    }
    // if($ret > 0){

    //   $alertStyle ="alert alert-danger";
    //   $statusMsg="Student with the Matric Number already exist!";

    // }
    // else{

    $query=mysqli_query($con,"insert into tblstudent(sid,firstName,lastName,otherName,gender,dateOfBirth,classId,sessionId,city,address,guidianName,guidianPhone,additionalPhone,email,dateCreated) value('$studentId','$firstname','$lastname','$othername','$gender','$dob','$class','$sessionId','$city','$address','$guidianName','$guidianPhone','$additionalPhone','$email','$dateCreated')");

    $queryLevelData = mysqli_query($con, "INSERT INTO tblleveldata(studentId,sessionId,classId) VALUES('$studentId','$sessionId','$class')");

    if ($query) {

      $alertStyle ="alert alert-success";
      $statusMsg="Student Added Successfully!";
  }
  else
    {
      $alertStyle ="alert alert-danger";
      $statusMsg="An error Occurred!" . mysqli_error($con);
    }
//   }
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
    <?php $page="student"; include 'includes/leftMenu.php';?>

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
                                    <li><a href="#">Student</a></li>
                                    <li class="active">Add Student</li>
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
                                <strong class="card-title"><h2 align="center">Add New Student</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                        <form method="Post" action="" autocomplete="off">
                                            <h2>Student Information</h2>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Firstname <span style="color: red;">*</span></label>
                                                        <input id="" name="firstname" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Firstname" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
												<!-- Log on to codeastro.com for more projects! -->
                                                    <label for="x_card_code" class="control-label mb-1">Lastname <span style="color: red;">*</span></label>
                                                        <input id="" name="lastname" type="text" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Lastname" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Othername</label>
                                                        <input id="" name="othername" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Othername">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Gender <span style="color: red;">*</span></label>
                                                        <select required name="gender" class="custom-select form-control">
                                                            <option value="">--Select Level--</option>
                                                            
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Date of Birth</label>
                                                        <input id="" name="dOB" type="date" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                                    </div>
                                                </div>
                                                
                                            
                                            </div>

                                        <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Class <span style="color: red;">*</span></label>
                                                <?php 
                                                    $query=mysqli_query($con,"select * from tbllevel");                        
                                                    $count = mysqli_num_rows($query);
                                                    if($count > 0){                       
                                                        echo ' <select required name="classId" class="custom-select form-control">';
                                                        echo'<option value="">--Select Level--</option>';
                                                        while ($row = mysqli_fetch_array($query)) {
                                                        echo'<option value="'.$row['Id'].'" >'.$row['levelName'].'</option>';
                                                            }
                                                                echo '</select>';
                                                            }
                                                ?>   
                                                </div>
                                            </div>
                                                
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                     <label for="x_card_code" class="control-label mb-1">Session <span style="color: red;">*</span></label>
                                                    <?php 
                                                    $query=mysqli_query($con,"select * from tblsession where isActive = 1");                        
                                                    $count = mysqli_num_rows($query);
                                                    if($count > 0){                       
                                                        echo ' <select required name="sessionId" class="custom-select form-control">';
                                                        echo'<option value="">--Select Session--</option>';
                                                        while ($row = mysqli_fetch_array($query)) {
                                                        echo'<option value="'.$row['Id'].'" >'.$row['sessionName'].'</option>';
                                                            }
                                                                echo '</select>';
                                                            }
                                                ?>   
                                                </div>
                                            </div>
                                           
                                        </div>
                                         <div class="row">
                                                
                                                </div>
                                                <!-- <div class="col-6">
                                                    <div class="form-group">
                                                   <?php
                                                        //echo"<div id='txtHint'></div>";
                                                    ?>                                    
                                                    </div>
                                                 
                                                </div> -->
                                                
                                             </div>
                                             <div class="row">
                                             <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Town/City <span style="color: red;">*</span></label>
                                                        <input id="" name="city" type="text" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Town/City">
                                                    </div>
                                                </div>



                                                 <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Residental Address <span style="color: red;">*</span></label>
                                                    <input id="" name="address" type="text" class="form-control cc-cvc fee" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Residental Address">
                                                    </div>
                                                    
                                                </div>
                                               
                                             </div>
                                             <hr>

                                             <h2>Guidian Information</h2>
                                             <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Full Name <span style="color: red;">*</span></label>
                                                    <input id="" name="guidianName" type="text" class="form-control cc-cvc fee-balance" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Full Name">
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Phone Number <span style="color: red;">*</span></label>
                                                    <input id="" name="guidianPhone" type="text" class="form-control cc-cvc fee-balance" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Phone Number">
                                                    </div>
                                                    
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Second Phone Number</label>
                                                    <input id="" name="additionalPhone" type="text" class="form-control cc-cvc fee-balance" value="" data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Second Phone Number">
                                                    </div>
                                                
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Email</label>
                                                    <input id="" name="email" type="email" class="form-control cc-cvc fee-balance" value="" data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Fees balance">
                                                    </div>
                                                
                                                </div>
                                             </div>
											 <!-- Log on to codeastro.com for more projects! -->
                                             
                                                <button type="submit" name="submit" class="btn btn-success">Add New Student</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
               

                    <br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">All Student</h2></strong>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                        <thead>
                                            
                                            <tr>
                                                <th>#</th>
                                                <!-- Log on to codeastro.com for more projects! -->
                                                <th>FullName</th>
                                                <th>Gender</th>
                                                
                                                <th>Class</th>
                                                <th>Session</th>
                                                <th>Town/City</th>

                                                <th>Resident Address</th>

                                                
                                                <th>Date</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $ret=mysqli_query($con,"SELECT tblstudent.Id, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName,tblstudent.gender,tblstudent.city,tblstudent.address,tblstudent.sessionId,tblstudent.classId,
                                            tblstudent.dateCreated, tbllevel.levelName,tblsession.sessionName
                                            from tblstudent
                                            JOIN tbllevel ON tbllevel.Id = tblstudent.classId
                                            INNER JOIN tblsession ON tblsession.Id = tblstudent.sessionId");
                                            $cnt=1;
                                            
                                            while ($row=mysqli_fetch_array($ret)) {
                                                                ?>
                                            <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php  echo $row['firstName'].' '.$row['lastName'].' '.$row['otherName'];?></td>

                                            <td><?php  echo $row['gender'];?></td>
                                            <td><?php  echo $row['levelName'];?></td>
                                            <!-- <td><?php  //echo $row['facultyName'];?></td> -->

                                            <td><?php  echo $row['sessionName'];?></td>
                                            <td><?php  echo $row['city'];?></td>
                                            <td><?php  echo $row['address'];?></td>
                        
                                            <td><?php  echo $row['dateCreated'];?></td>
                                            
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




    <script type="text/javascript">

           
            $(".fee-paid").keyup(function (e) { 
                var fP = $(".fee-paid").val();
                var fee = $(".fee").val();
                var fee_bal = $(".fee-balance");
                var f = fee - fP;
                $(".fee-balance").val(f);
                
            });
      
  </script>

</body>
</html>


<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    include('../includes/functions.php');

    if(isset($_GET['levelId'])  && isset($_GET['sessionId'])){

        $matricNo = $_GET['Id'];
        $levelId = $_GET['levelId'];
        $sessionId = $_GET['sessionId'];
        // $semesterId = $_GET['semesterId'];


        $stdQuery=mysqli_query($con,"select * from tblstudent where Id = '$matricNo'");                        
        $rowStd = mysqli_fetch_array($stdQuery);

        // $semesterQuery=mysqli_query($con,"select * from tblsemester where Id = '$semesterId'");                        
        // $rowSemester = mysqli_fetch_array($semesterQuery);

        $sessionQuery=mysqli_query($con,"select * from tblsession where Id = '$sessionId'");                        
        $rowSession = mysqli_fetch_array($sessionQuery);

        $levelQuery=mysqli_query($con,"select * from tbllevel where Id = '$levelId'");                        
        $rowLevel = mysqli_fetch_array($levelQuery);

    
    }
    else{
        echo "<script type = \"text/javascript\">
        window.location = (\"viewStudent.php\");
        </script>";
    }

//------------------------------------ UPDATE STUDENT INFO -----------------------------------------------

if(isset($_POST["update"])){
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
   
  
  
//   $departmentId=$_POST['departmentId'];
  // $facultyId=$_POST['facultyId'];

    $dateCreated = date("Y-m-d");
    $query = mysqli_query($con,"UPDATE tblstudent SET firstName='$firstname',lastName='$lastname',otherName='$othername',gender='$gender',dateOfBirth='$dob',classId='$class',sessionId='$sessionId',city='$city',address='$address',guidianName='$guidianName',guidianPhone='$guidianPhone',additionalPhone='$additionalPhone',email='$email',dateCreated='$dateCreated' WHERE Id='$_GET[Id]'");
    if($query){
        echo "<script>confirm('Student successful updated!')</script>";
        header("location:viewStudent.php");
    }else{
     echo "Failed to update : " . mysqli_error($con);
    }
}


//------------------------------------ COMPUTE RESULT -----------------------------------------------

if (isset($_POST['compute'])){


}//end of POST


?>



<?php include 'includes/title.php';?>
</head>
<body>
    <!-- Left Panel -->
     
         <?php $page="student";include 'includes/leftMenu.php';?>

    <div id="right-panel" class="right-panel">

        <!-- Header-->
                    <?php include 'includes/header.php';?>
        <!-- Header-->

       
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                          
                        </div> <!-- .card -->
                    </div><!--/.col-->
               
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">
                                    <h4 align="center"><?php echo  $rowStd['firstName'].' '.$rowStd['lastName']?>&nbsp;&nbsp;<?php ?> Information</h>
                                </strong>
                            </div>
                            <div class="card-body">
                                       <!-- <div class="<?php // echo $alertStyle;?>" role="alert"><?php //echo $statusMsg;?></div> -->
                                        <form method="Post" action="" autocomplete="off">
                                            <h2>Student Information</h2>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Firstname <span style="color: red;">*</span></label>
                                                        <input id="" name="firstname" value="<?php echo $rowStd["firstName"] ?>" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Firstname" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
												<!-- Log on to codeastro.com for more projects! -->
                                                    <label for="x_card_code" class="control-label mb-1">Lastname <span style="color: red;">*</span></label>
                                                        <input id="" name="lastname" value="<?php echo $rowStd["lastName"] ?>" type="text" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Lastname" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Othername</label>
                                                        <input id="" name="othername" value="<?php echo $rowStd["otherName"] ?>" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Othername">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Gender <span style="color: red;">*</span></label>
                                                        <select required name="gender" class="custom-select form-control">';
                                                            <option value="">--Select Level--</option>
                                                            <?php 
                                                                if($rowStd["gender"] == "Male"){
                                                                    echo "<option selected value=\"Male\">Male</option>
                                                                    <option value=\"Female\">Female</option>";
                                                                }elseif($rowStd["gender"] == "Female"){
                                                                    echo "
                                                                    <option value=\"Male\">Male</option>
                                                                    <option selected value=\"Female\">Female</option>";
                                                                }
                                                            ?>
                                                            
                                                            <!-- <option value="Male">Male</option>
                                                            <option value="Female">Female</option> -->
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                
                                                
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
													<!-- Log on to codeastro.com for more projects! -->
                                                        <label for="cc-exp" class="control-label mb-1">Date of Birth</label>
                                                        <input id="" name="dOB" type="date" class="form-control cc-exp" value="<?php echo $rowStd["dateOfBirth"] ?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
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
                                                    if($row["Id"] == $rowStd["classId"]){
                                                        echo'<option selected value="'.$row['Id'].'" >'.$row['levelName'].'</option>';
                                                    }else{
                                                        echo'<option value="'.$row['Id'].'" >'.$row['levelName'].'</option>';
                                                    }
                                                
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
                                                    $query=mysqli_query($con,"select * from tblsession");                        
                                                    $count = mysqli_num_rows($query);
                                                    if($count > 0){                       
                                                        echo ' <select required name="sessionId" class="custom-select form-control">';
                                                        echo'<option value="">--Select Session--</option>';
                                                        while ($row = mysqli_fetch_assoc($query)) {
                                                            if($row["sessionName"] == $rowSession["sessionName"]){
                                                                echo'<option selected value="'.$row['Id'].'" >'.$row['sessionName'].'</option>';
                                                            }else{
                                                               
                                                                echo'<option value="'.$row['Id'].'" >'.$row['sessionName'].'</option>';
                                                            }
                                                        
                                                            }
                                                                echo '</select>';
                                                            }
                                                ?>   
                                                </div>
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
                                             <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Town/City <span style="color: red;">*</span></label>
                                                        <input id="" name="city" value="<?php echo $rowStd["city"] ?>" type="text" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Town/City">
                                                    </div>
                                                </div>

                                                 <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Residental Address <span style="color: red;">*</span></label>
                                                    <input id="" name="address" value="<?php echo $rowStd["address"] ?>" type="text" class="form-control cc-cvc fee" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Residental Address">
                                                    </div>
                                                    
                                                </div>
                                               
                                             </div>
                                             <hr>

                                             <h2>Guidian Information</h2>
                                             <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Full Name <span style="color: red;">*</span></label>
                                                    <input id="" name="guidianName" value="<?php echo $rowStd["guidianName"] ?>" type="text" class="form-control cc-cvc fee-balance" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Full Name">
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Phone Number <span style="color: red;">*</span></label>
                                                    <input id="" name="guidianPhone" value="<?php echo $rowStd["guidianPhone"] ?>" type="text" class="form-control cc-cvc fee-balance" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Phone Number">
                                                    </div>
                                                    
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Second Phone Number</label>
                                                    <input id="" name="additionalPhone" value="<?php echo $rowStd["additionalPhone"] ?>" type="text" class="form-control cc-cvc fee-balance" value="" data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Second Phone Number">
                                                    </div>
                                                
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Email</label>
                                                    <input id="" name="email" value="<?php echo $rowStd["email"] ?>" type="email" class="form-control cc-cvc fee-balance" value="" data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Fees balance">
                                                    </div>
                                                
                                                </div>
                                             </div>
											 <!-- Log on to codeastro.com for more projects! -->
                                             
                                             <button class="btn btn-danger"><a style="color: white;" href="viewStudent.php">Go Back</a></button>   
                                             <button type="submit" name="update" class="btn btn-success">Update Student</button>
                                            </div>
                                        </form>
                                    </div>
        </div>
    </div>
                    
<!-- end of datatable -->

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

        <?php include 'includes/footer.php';?>



    

</body>
</html>

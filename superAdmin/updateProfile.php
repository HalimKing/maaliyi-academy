
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);


    $querys = mysqli_query($con,"select * from tbladmin where emailAddress='$emailAddress'");
    $rrow = mysqli_fetch_array($querys);
    

if(isset($_POST['submit'])){

     $alertStyle ="";
     $statusMsg=""; 

  $firstname=$_POST['firstname'];
  $lastname=$_POST['lastname'];
  $othername=$_POST['othername'];
  $emailAddress=$_POST['emailAddress'];
  $phoneNo=$_POST['phoneNo'];

    // $dateAssigned = date("Y-m-d");

    // if($password != $confirmPass){

    //     $alertStyle ="alert alert-danger";
    //     $statusMsg="Password New Miss Matched!";
    // }else{
        $ret=mysqli_query($con,"UPDATE tbladmin SET firstName='$firstname', lastName='$lastname', otherName='$othername', phoneNo='$phoneNo' WHERE emailAddress='$emailAddress'");

        if($ret == TRUE){

            $alertStyle ="alert alert-success";
            $statusMsg="Profile Updated Successfully!";
        }
        else
        {
        $alertStyle ="alert alert-danger";
        $statusMsg="An error Occurred!";
        }

    // }

  
}
  ?>

<?php include 'includes/title.php';?>
</head>
<body>
    <!-- Left Panel -->
    <?php $page="profile"; include 'includes/leftMenu.php';?>

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
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Profile</a></li>
                                    <li class="active">Update Information</li>
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
                                <strong class="card-title">UPDATE PROFILE</strong>
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
                                                        <label for="cc-exp" class="control-label mb-1">Firstname</label>
                                                        <input id="" name="firstname" type="tel" class="form-control cc-exp" value="<?php echo $rrow['firstName'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Firstname">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="x_card_code" class="control-label mb-1">Lastname</label>
                                                        <input id="" name="lastname" type="tel" class="form-control cc-cvc" value="<?php echo $rrow['lastName'];?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Lastname">
                                                        </div>
                                                    </div>
                                                    <div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Othername</label>
                                                        <input id="" name="othername" type="text" class="form-control cc-exp" value="<?php echo $rrow['otherName'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Othername">
                                                    </div>
                                                </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Email Address</label>
                                                    <input readonly id="" name="emailAddress" type="email" class="form-control cc-cvc" value="<?php echo $rrow['emailAddress'];?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Email Address">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Phone Number</label>
                                                        <input id="phone" name="phoneNo" type="text" class="form-control cc-exp" value="<?php echo $rrow['phoneNo'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Phone Number" title="You can't update">
                                                    </div>
                                                </div>

                                             
                                              
                                        </div>
                                       

                                                <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
                                            </div>
                                        </form>
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
          

          $('#phone').on('input', function() {
                // Remove non-numeric characters and except for the decimal point
                $(this).val($(this).val().replace(/[^0-9+]/g, ''));
                
                // Ensure only one decimal point
                if ($(this).val().split('.').length > 2) {
                    $(this).val($(this).val().substring(0, $(this).val().lastIndexOf('.')));
                }
            });
      } );

      // Menu Trigger
      

      
  </script>

</body>
</html>


<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);

if(isset($_POST['submit'])){
    
    $cpassword=md5($_POST['currentpassword']);
    $newpassword=md5($_POST['newpassword']);
    $conPassword = md5($_POST["conpassword"]);

    $query=mysqli_query($con,"SELECT * FROM tbladmin WHERE emailAddress='$emailAddress' and password='$cpassword'");
    $row=mysqli_fetch_array($query);
    if($row > 0){
        if($newpassword != $conPassword){
            $alertStyle ="alert alert-danger";
            $statusMsg="Your New Password Miss Matched!";
        }else{
            $ret=mysqli_query($con,"UPDATE tbladmin SET password='$newpassword' WHERE emailAddress='$emailAddress'");

            $alertStyle ="alert alert-success";
            $statusMsg="Password changed successfully!";

            echo "
                <script>
                    alert('Password changed successfully!');
                    window.location = (\"../index.php\")
                </script>
                ";
        }
    

    } else {

      $alertStyle ="alert alert-danger";
      $statusMsg="Your current password is wrong!";
    }
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
                                    <li><a href="#">Profile</a></li>
                                    <li class="active">Change Password</li>
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
                                <strong class="card-title">Change Password</strong>
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
                                                        <label for="cc-exp" class="control-label mb-1">Current Password</label>
                                                        <input id="" name="currentpassword" type="password" class="form-control cc-exp" value="" Required placeholder="Current Password">
                                                    </div>
                                                </div>
                                            </div>
                                        <div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">New Password</label>
                                                        <input id="" name="newpassword" type="password" class="form-control cc-exp" value="" data-val="true" placeholder="New Password">
                                                    </div>
                                                </div>
                                             </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Confirm New Password</label>
                                                        <input id="" name="conpassword" type="password" class="form-control cc-exp" value="" data-val="true" placeholder="Confirm New Password">
                                                    </div>
                                                </div>
                                             </div>

                                        <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                    </div>
                                                </div>
                                             </div>

                                        <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                </div>
                                                </div>
                                        </div>

                                                <button type="submit" name="submit" class="btn btn-success">Change Password</button>
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




</body>
</html>

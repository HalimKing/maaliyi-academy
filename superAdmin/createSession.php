
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
error_reporting(0);

if(isset($_GET['status']) && $_GET['status'] == "success"){

      $alertStyle ="alert alert-success";
      $statusMsg="Session Set and Updated Successfully!";
}


if(isset($_POST['submit'])){

     $alertStyle ="";
      $statusMsg="";

  $sessionName=$_POST['sessionName'];


    $query=mysqli_query($con,"select * from tblsession where sessionName ='$sessionName'");
    $ret=mysqli_fetch_array($query);
    if($ret > 0){

      $alertStyle ="alert alert-danger";
      $statusMsg="This Session already exist!";

    }
    else{

    $query=mysqli_query($con,"insert into tblsession(sessionName,isActive) value('$sessionName','0')");

    if ($query) {

      $alertStyle ="alert alert-success";
      $statusMsg="Session Added Successfully!";
  }
  else
    {
      $alertStyle ="alert alert-danger";
      $statusMsg="An error Occurred!";
    }
  }
}
  ?>


    <?php include 'includes/title.php';?>
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <!-- Left Panel -->
    <?php $page="session"; include 'includes/leftMenu.php';?>

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
                        <div class="page-header ">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Session</a></li>
                                    <li class="active">Add Session</li>
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
                                <strong class="card-title"><h2 align="center">Add New Session</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                        <form method="Post" action="">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Session</label>
                                                        <input id="" name="sessionName" type="tel" class="form-control cc-exp" value="" placeholder="Session Name">
                                                    </div>
                                                </div>
                                               
                                                    </div>
                                                    <div>

                                                <button type="submit" name="submit" class="btn btn-success">Add Session</button>
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
                                <strong class="card-title"><h2 align="center">All Session</h2></strong>
                            </div>
                            <div class="card-body">
                                <div class=" table-responsive">
                                <table id="example" class="table table-hover table-striped table-bordered ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Session</th>
                                                <th>Status</th>
                                                <th>Make Active</th>
                                                <th>Edit</th>
                                                <th>Delete</th>                                           
                                                </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                                $ret=mysqli_query($con,"SELECT * from tblsession");
                                                $cnt=1;
                                                while ($row=mysqli_fetch_array($ret)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td><?php  echo $row['sessionName'];?></td>
                                                <td><?php  if($row['isActive'] == 1){ echo "Active";}else{ echo "InActive";}?></td>
                                                <td><a href="activateSession.php?activateId=<?php echo $row['Id'];?>" title="Activate Session"><i class="fa fa-check fa-1x"></i></a></td>
                                                <td><a href="editSession.php?editid=<?php echo $row['Id'];?>" title="Edit Session Details"><i class="fa fa-edit fa-1x"></i></a></td>
                                                <td><a onclick="return confirm('Are you sure you want to delete?')" href="deleteSession.php?delid=<?php echo $row['Id'];?>" title="Delete Session"><i class="fa fa-trash fa-1x"></i></a></td>
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
    //     $(document).ready(function() {
    //       $('#bootstrap-data-table-export').DataTable();
    //   } );
      $(document).ready(function(){
            $("#example").DataTable();
        })

      
  </script>

</body>
</html>

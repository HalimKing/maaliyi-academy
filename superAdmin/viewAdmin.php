
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');

  ?>


<!-- Head -->
<?php include 'includes/title.php';?>

</head>
<body>
    <!-- Left Panel -->
    <?php $page="admin"; include 'includes/leftMenu.php';?>

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
                                    <li><a href="#">Staff</a></li>
                                    <li class="active">View Staff</li>
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
                          
                           
                        </div> <!-- .card -->
                    </div><!--/.col-->
               
                    <br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">All Administrator</h2></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <!-- <th>Staff ID</th> -->
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Othername</th>
                                            <th>EmailAddress</th>
                                            <th>PhoneNo</th>
                                            <!-- <th>Faculty</th> -->
                                            <!-- <th>Department</th> -->
                                            <th>Date Added</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                        <?php
                            $ret=mysqli_query($con,"SELECT * FROM tbladmin");
                            $cnt=1;
                            while ($row=mysqli_fetch_array($ret)) {
                                    ?>
                                <tr>
                                <td><?php echo $cnt;?></td>
                                <!-- <td><?php  //echo $row['staffId'];?></td> -->
                                <td><?php  echo $row['firstName'];?></td>
                                <td><?php  echo $row['lastName'];?></td>
                                <td><?php  echo $row['otherName'];?></td>
                                <td><?php  echo $row['emailAddress'];?></td>
                                <td><?php  echo $row['phoneNo'];?></td>
                                <!-- <td><?php  //echo $row['facultyName'];?></td> -->
                                <!-- <td><?php  //echo $row['departmentName'];?></td> -->
                                <td><?php  echo $row['dateCreated'];?></td>
                                <!-- <td><a href="editAdmin.php?editid=<?php //echo $row['staffId'];?>" title="View Admin"><i class="fa fa-edit fa-1x"></i></a></td> -->
                                <td><a onclick="return confirm('Are you sure you want to delete?')" href="deleteAdmin.php?delid=<?php echo $row['emailAddress'];?>" title="Delete Admin"><i class="fa fa-trash fa-1x"></i></a></td>
                                </tr>
                                <?php 
                                $cnt=$cnt+1;
                            }
                        ?>
                                                                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
<!-- end of datatable -->

            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

        <?php include 'includes/footer.php';?>


</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="../assets/js/main.js"></script>

<script src="../assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );

      
  </script>

</body>
</html>


<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');

  ?>

<!-- Head -->
<?php include 'includes/title.php';?>


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
                                    <li><a href="#">Student</a></li>
                                    <li class="active">View Student</li>
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
                                                <th>Info</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $ret=mysqli_query($con,"SELECT tblstudent.Id, tblstudent.firstName, tblstudent.lastName, tblstudent.otherName,tblstudent.gender,tblstudent.classId,tblstudent.city,tblstudent.address,tblstudent.sessionId,
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
                                            <td><a href="updateStudent.php?levelId=<?php echo $row["classId"];  ?>&sessionId=<?php echo $row["sessionId"] ?>&Id=<?php echo $row["Id"] ?>"><i class="fa fa-eye fa-1x"></i>View</a></td>
                                            <!-- Log on to codeastro.com for more projects! -->
                                            <td style="text-align: center;"><!--<a href="editStudent.php?editStudentId=<?php //echo $row['Id'];?>" title="Edit Details"><i class="fa fa-edit fa-1x"></i></a>-->
                                            <a onclick="return confirm('Are you sure you want to delete?')" href="deleteStudent.php?delid=<?php echo $row['Id'];?>" title="Delete Student Details"><i class="fa fa-trash fa-1x"></i></a></td>
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




</body>
</html>

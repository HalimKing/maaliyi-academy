
<?php
$email = $_SESSION['emailAddress'];
$query = mysqli_query($con,"select * from tbladmin where emailAddress='$email'");
$row = mysqli_fetch_array($query);
$staffFullName = $row['firstName'].' '.$row['lastName'];
?>
<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                <li class="menu-title">ADMIN: &nbsp;&nbsp;&nbsp;<?php echo $staffFullName;?></li>
                    <li class="<?php if($page=='dashboard'){ echo 'active'; }?>">
                        <a href="index.php"><i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                  
                        <li class="menu-item-has-children dropdown <?php if($page=='admin'){ echo 'active'; }?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Admin</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-plus"></i><a href="createAdmin.php">Add Administrator</a></li>
                                <!-- <li><i class="fa fa-eye"></i><a href="viewAdmin.php">View Administrator</a></li> -->
                            </ul>
                        </li>
                 
                 <li class="menu-item-has-children dropdown <?php if($page=='session'){ echo 'active'; }?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Session</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-plus"></i> <a href="createSession.php">Add New Session</a></li>
                    </ul>
                </li>
                 <!-- <li class="menu-item-has-children dropdown <?php if($page=='term'){ echo 'active'; }?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Term/Semester</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-plus"></i> <a href="createTerm.php">Add New Term</a></li>
                    </ul>
                </li> -->
                   
                  
                   
                    <li class="menu-title">Student Section</li>
                    <li class="menu-item-has-children dropdown <?php if($page=='student'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Student</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i> <a href="createStudent.php">Add New Student</a></li>
                            <li><i class="fa fa-eye"></i> <a href="viewStudent.php">View Student</a></li>
                            <li><i class="fa-regular fa-circle-dot"></i> <a href="promoteStudent.php">Promote Students</a></li>
                        </ul>
                    </li>

                    

                     <!-- <li class="menu-item-has-children dropdown <?php if($page=='courses'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Courses</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i> <a href="createCourses.php">Add New Course</a></li>
                            <li><i class="fa fa-eye"></i> <a href="viewCourses.php">View Courses</a></li>
                        </ul>
                    </li> -->

                     <!-- <li class="menu-item-has-children dropdown <?php if($page=='level'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Class</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i> <a href="createClass.php">Add New Class</a></li>
                            <li><i class="fa fa-eye"></i> <a href="viewCourses.php">View Class</a></li>
                        </ul>
                    </li> -->

                    <!-- <li class="menu-title">Results and Grading</li>
                      <li class="menu-item-has-children dropdown <?php //if($page=='result'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Result</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i> <a href="studentList.php">Compute GPA</a></li>
                            <li><i class="fa fa-plus"></i> <a href="studentList2.php">Compute CGPA</a></li>
                            <li><i class="fa fa-plus"></i> <a href="studentList3.php">View/Print Result</a></li>                     
                            <li><i class="fa fa-plus"></i> <a href="gradingCriteria.php">View Grading Criteria</a></li>

                        </ul>
                    </li> -->
                    <li class="menu-title">Fees</li>
                      <li class="menu-item-has-children dropdown <?php if($page=='fee'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="menu-icon fa-solid fa-money-bill"></i> Fees</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus"></i> <a href="fee.php">Create Fees</a></li>
                            <li><i class="fa fa-download" aria-hidden="true"> </i> <a href="collectFees.php">Collect Fees</a></li>
                            <li><i class="fa fa-eye"></i> <a href="viewFees.php">View Fees</a></li>
                            <li><i class="fa fa-print"></i> <a href="printBulkFee.php">Print Bulk</a></li>
                            <li><i class="fa fa-book"></i> <a href="printedReceipts.php">Receipts</a></li>
                            

                        </ul>
                    </li>

                    <li class="menu-title">Account</li>
                    <li class="menu-item-has-children dropdown <?php if($page=='profile'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-user-circle"></i>Profile</a>
                        <ul class="sub-menu children dropdown-menu">
                            <!-- <li><i class="menu-icon fa fa-key"></i> <a href="changePassword.php">Change Password</a></li> -->
                            <li><i class="menu-icon fa fa-user"></i> <a href="updateProfile.php">Update Profile</a></li>
                            <li><i class="menu-icon fa fa-edit"></i> <a href="changePassword.php">Change Password</a></li>
                            </li>
                        </ul>
                         <li>
                        <a onclick="return confirm('Are you sure you want to logout?')" href="logout.php"> <i class="menu-icon fa fa-power-off"></i>Logout </a>
                    </li>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
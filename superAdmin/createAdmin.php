
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    error_reporting(0);

    if(isset($_POST['submit'])){

        $alertStyle ="";
        $statusMsg="";

        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $othername=$_POST['othername'];
        $emailAddress=$_POST['emailAddress'];

        $phoneNo=$_POST['phoneNo'];
        $password=md5($_POST['password']);
        // $staffId=$_POST['staffId'];
        $roleId=2;
        $dateCreated = date("Y-m-d");

        $confirmPass=md5($_POST['confPassword']);
        $dateAssigned = date("Y-m-d");

        if($password != $confirmPass){

            $alertStyle ="alert alert-danger";
            $statusMsg="Password miss matched!";
        }else{

            $que=mysqli_query($con,"SELECT * FROM tbladmin WHERE emailAddress ='$emailAddress'");
            $res=mysqli_fetch_array($que);
            if($res > 0){

                $alertStyle ="alert alert-danger";
                $statusMsg="Administrator with the Email Address already exist!";

            }
            else{

                $query=mysqli_query($con,"insert into tbladmin(firstName,lastName,otherName,emailAddress,phoneNo,password,dateCreated) value('$firstname','$lastname','$othername','$emailAddress','$phoneNo','$password','$dateCreated')");

                if($query) {

                    $alertStyle ="alert alert-success";
                    $statusMsg="Administrator Created Successfully!";
                    
                
                }
                else
                {
                    $alertStyle ="alert alert-danger";
                    $statusMsg="An error Occurred!";
                }
            }
        }
    }
?>

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
            xmlhttp.open("GET","ajaxCall.php?fid="+str,true);
            xmlhttp.send();
        }
    }
    
    function showRole(str) {
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
            xmlhttp.open("GET","ajaxCallRole.php?id="+str,true);
            xmlhttp.send();
        }
    }
    </script>
    
    
    
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
                            <li><a href="#">Administrator</a></li>
                            <li class="active">Add Administrator</li>
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
                        <strong class="card-title"><h2 align="center">Add New Administrator</h2></strong>
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
                                                <label for="cc-exp" class="control-label mb-1">Firstname <span style="color: red;">*</span></label>
                                                <input id="" name="firstname" type="tel" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Firstname">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label for="x_card_code" class="control-label mb-1">Lastname <span style="color: red;">*</span></label>
                                                <input id="" name="lastname" type="tel" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Lastname">
                                                </div>
                                            </div>
                                            <div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Othername</label>
                                                <input id="" name="othername" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Othername">
                                            </div>
                                        </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="x_card_code" class="control-label mb-1">Email Address <span style="color: red;">*</span></label>
                                            <input id="" name="emailAddress" type="email" class="form-control cc-cvc" value="" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Email Address">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Phone Number <span style="color: red;">*</span></label>
                                                <input id="phone" name="phoneNo" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Phone Number">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Create Password <span style="color: red;">*</span></label>
                                                <input id="" name="password" type="password" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Create Password">
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="row">
                                        
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="x_card_code" class="control-label mb-1">Confirm Password <span style="color: red;">*</span></label>
                                            <input id="" name="confPassword" type="password" class="form-control cc-cvc" value="" data-val="true" Required data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>

                                

                                        <button type="submit" name="submit" class="btn btn-success">Add Admin</button>
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
                        <strong class="card-title"><h2 align="center">All Administrator</h2></strong>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="example" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Othername</th>
                                    <th>EmailAddress</th>
                                    <th>PhoneNo</th>
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
                                            <td>
                                            <?php if($row['emailAddress'] == $_SESSION['emailAddress']):
                                                
                                            ?>
                                            <a disabled onclick='return alert("Can not delete your own account!")' href="" title="Can't Delete Yourself"><button class="btn" readonly disabled><i class="fa fa-trash fa-1x"></i></button></a>
                                            <?php else: ?>
                                                <a onclick="return confirm('Are you sure you want to delete?')" href="deleteAdmin.php?delid=<?php echo $row['emailAddress'];?>" title="Delete Admin"><button class="btn"><i class="fa fa-trash fa-1x"></i></button></a>

                                                <?php endif ?>
                                            </td>
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

            $('#phone').on('input', function() {
                // Remove non-numeric characters and except for the decimal point
                $(this).val($(this).val().replace(/[^0-9+]/g, ''));
                
                // Ensure only one decimal point
                if ($(this).val().split('.').length > 2) {
                    $(this).val($(this).val().substring(0, $(this).val().lastIndexOf('.')));
                }
            });
        })

      
  </script>

</body>
</html>

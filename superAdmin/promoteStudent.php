
<?php

    include('../includes/dbconnection.php');
    include('../includes/session.php');
    // error_reporting(0);

    if(isset($_POST['submit'])){

     $alertStyle ="";
      $statusMsg="";

    $termName = $_POST['term_name'];
    $feeType = $_POST['fee_type'];
    $sessionName = $_POST['session_name'];
    $feeAmount = $_POST['fee_amount'];
    $level = $_POST['level'];

    
    $dateAdded = date("Y-m-d");

    //Checks the Course Code
    $query=mysqli_query($con,"SELECT * FROM tblfees WHERE fee_type ='$feeType' AND fee_session='$sessionName'");
    $ret=mysqli_fetch_array($query);

     if($ret > 0){ //Check the coure Title
      $alertStyle ="alert alert-danger";
      $statusMsg="This Course already exist!";

    }
    else{

        $query=mysqli_query($con,"insert into tblfees(fee_type,fee_term,fee_session,level,fee_amount,reg_date) value('$feeType','$termName','$sessionName','$level','$feeAmount','$dateAdded')");

        if ($query) {
            
            $alertStyle ="alert alert-success";
            $statusMsg="Course Created and Assigned Successfully!";
        }
        else
        {
            $alertStyle ="alert alert-danger";
            $statusMsg="An error Occurred!". mysqli_error($con);
        }
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
                                    <li><a href="#">Student</a></li>
                                    <li class="active">Promote Students</li>
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
                        
                    </div>
                    

                <br><br>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="left">Promote Students</h2></strong>
                            </div>
                            <div class="card-body">
                                <div class="messages alert d-none"></div>
                                <!-- <div class="row promote-container d-none py-5" >
                                    <h4 class="pb-2">Promote Section</h4>
                                    <div class="col-lg-5 col-md-5 col-sm-12">
                                        <div class="form-group">
                                        <?php  
                                                    $sql = mysqli_query($con, "SELECT * FROM tblsession");
                                                    echo '
                                                        <select required id="promotion-year" name="sessionId" onchange="showValues(this.value)" class="custom-select form-control">';
                                                    echo'<option value="">--Select Session--</option>
                                                        ';
                                                    while($session_row = mysqli_fetch_array($sql)){
                                                        echo '<option value="'.$session_row['Id'].'"> '.$session_row['sessionName'] .'</option>';
                                                    }
                                                    echo '</select>';
                                                
                                                
                                                ?>  
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-lg-5 col-md-5 col-sm-12">
                                        <div class="form-group">
                                        <?php 
                                                $query=mysqli_query($con,"SELECT * FROM tbllevel");                        
                                                $count = mysqli_num_rows($query);
                                                if($count > 0){                       
                                                    echo ' <select required id="class" name="classId" class="custom-select form-control promotion-class">';
                                                    echo'<option value="">--Select Class--</option>';
                                                    while ($row = mysqli_fetch_array($query)) {
                                                    echo'<option value="'. $row['Id'].'" >'.$row['levelName'].'</option>';
                                                        }
                                                            echo '</select>';
                                                        }
                                            ?>   
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="form-group">
                                            <button type="button" role="button" id="promote-btn"  name="filter" class="btn btn-warning form-control">Promote</button>
                                        </div>
                                    </div>
                                </div>
                                 -->
                                
                                <form action="" method="post">
                                    <div class="row filter-container">
                                    <h4 class="pb-2">Filter Section</h4>
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <div class="form-group">
                                            <?php  
                                                function getSession($con){
                                                    $sql = mysqli_query($con, "SELECT * FROM tblsession");
                                                    echo '
                                                        <select required name="sessionId" onchange="showValues(this.value)" class="custom-select form-control">';
                                                    echo'<option value="">--Select Session--</option>
                                                        ';
                                                    while($session_row = mysqli_fetch_array($sql)){
                                                        echo '<option value="'.$session_row['Id'].'"> '.$session_row['sessionName'] .'</option>';
                                                    }
                                                    echo '</select>';
                                                }
                                                getSession($con);
                                                
                                                ?>  
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <div class="form-group">
                                            <?php 
                                            function getClass($con){
                                                    $query=mysqli_query($con,"SELECT * FROM tbllevel");                        
                                                    $count = mysqli_num_rows($query);
                                                    if($count > 0){                       
                                                        echo ' <select required id="class" name="classId" class="custom-select form-control">';
                                                        echo'<option value="">--Select Class--</option>';
                                                        while ($row = mysqli_fetch_array($query)) {
                                                        echo'<option value="'.$row['levelName']. ' ' . $row['Id'].'" >'.$row['levelName'].'</option>';
                                                            }
                                                                echo '</select>';
                                                            }
                                                }
                                                getClass($con)
                                                ?>   
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-2 col-md-2">
                                            <div class="form-group">
                                                <button type="submit"  name="filter" class="btn btn-info form-control float-right">View</button>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </form>
                                
                                <div class="promote-container d-none">
                                <?php
                                    include 'Modals/promoteModal.php';
                                    ?>
                                </div>
                            


                                <?php
                                 if(isset($_POST["filter"])){
                                              
                                 
                                 ?>
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th data-orderable="false" class="no-sort"><input id="select-all" type="checkbox" name="" class=""></th>
                                                <th>Name</th>
                                                <th>Session</th>
                                                <th>Class</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // $feeType = $_POST["fee_type"];
                                                $sessionId = $_POST["sessionId"];
                                                // $termId = $_POST["termId"];
                                                $class = $_POST["classId"];
                                                $classExplode = explode(" ",$class);
                                                $classExplodeLastIndex = count($classExplode)-1;
                                                $classId = $classExplode[$classExplodeLastIndex];


                                                    $ret=mysqli_query($con,"SELECT tblstudent.firstName,tblstudent.lastName,tblstudent.otherName,tblsession.sessionName,tbllevel.levelName,tblleveldata.studentId,tblleveldata.sessionId,tblleveldata.classId
                                                    FROM tblleveldata
                                                    JOIN tblstudent ON tblstudent.sid = tblleveldata.studentId
                                                    JOIN tblsession ON tblsession.Id = tblleveldata.sessionId
                                                    JOIN tbllevel ON tbllevel.Id = tblleveldata.classId
                                                    WHERE tblleveldata.sessionId='$sessionId' AND tblleveldata.classId='$classId'");

                                                   
                                                $cnt=1;
                                                $ccc = mysqli_error($con);
                                                if(!$ret){
                                                    echo $ccc;
                                                }
                                                // echo "<script> alert('Come')</script>";
                                                    
                                                
                                                while ($row=mysqli_fetch_assoc($ret)) {
                                                    $levelExplode = explode(" ", $row["levelName"]);
                                                    
                                                    // echo "<script> alert('SessionId : $sessionId, termId : $termId,feeTypeId : $feeNameId')</script>";
                                                
                                            ?>
                                                <tr>

                                                    <td><input type="checkbox" name="" class="select-checkbox" id="" value="<?php echo $row["studentId"] ?>"></td>
                                                    <td><?php  echo $row['firstName'].' '.$row['lastName'].' '.$row['otherName'];?></td>
                                                    <td><?php echo $row['sessionName'];?></td>
                                               
                                                    
                                                    <td><?php echo $row['levelName'];?></td>
                                                    
                                                </tr>
                                               
                                                <?php 
                                            // }
                                                $cnt=$cnt+1;
                                                }
                                                
                                          ?>
                                                                                    
                                        </tbody>
                                    </table>
                                </div>
                                <?php   } ?>
                                
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
    
    $(document).ready(function () {
        
        $("#select-all").click(function(){
        let checkboxes = $(".select-checkbox");
        
        checkboxes.prop("checked", $(this).prop("checked"));
        if ($(this).prop("checked")) { 
            $(".promote-container").removeClass("d-none")
         }else {
            $(".promote-container").addClass("d-none")
         }
      
        })
        
        $(".select-checkbox").click(function() {
            // let checked = $(".select-checkbox").prop("checked");
            const checkbox = $(this).find(".select-checkbox");
            checkbox.prop("checked", !checkbox.prop("checked"));
            
            let totalCheckboxes = $(".select-checkbox").length;
            let totalCheckboxesChecked = $(".select-checkbox:checked").length;
            
            if ( totalCheckboxes != totalCheckboxesChecked) {
                
                $("#select-all").prop("checked", false);
                if(totalCheckboxesChecked > 0) {
                    $(".promote-container").removeClass("d-none");
                }else{
                    $(".promote-container").addClass("d-none");
                }
            }else{
                $("#select-all").prop("checked", true);
                
                if(totalCheckboxesChecked > 0) {
                    $(".promote-container").removeClass("d-none");
                }else{
                    $(".promote-container").addClass("d-none");
                }
            }
        });

        $(document).on("click", "#promote-btn", function () {
            let selectedClassId = $(".promotion-class").val();
            let selectedYearId = $("#promotion-year").val();
            let input_checked = $(".select-checkbox:checked");

            if (selectedClassId == '' && selectedYearId == '') {
                alert('Please select session and Class');
                return false;
            }else if(selectedClassId == '') {
                alert('Please select Class');
                return false;
            }else if(selectedYearId == '') {
                alert('Please select Session');
                return false;
            }
            
            let students_id = [];
            input_checked.each(function() {
                students_id.push($(this).val())
            });
            if (students_id.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "save_promoted_students.php",
                    data: {
                        studentIds: students_id,
                        yearId: selectedYearId,
                        classId: selectedClassId

                    },
                    success: function (response) {
                        let res = $.parseJSON(response);
                        // clear the modal input fields and checkboxes
                        $(".messages p").remove();
                        $("#promoteModal .promotion-class").val('');
                        $("#promoteModal #promotion-year").val('');
                        $("#select-all").prop("checked", false);
                        $(".select-checkbox").prop("checked", false);
                        $(".promote-container").addClass("d-none")
                        $("#promoteModal").modal('hide');

                        if(res.status == "success_existing") {
                            // alert(res.student_existing_info);
                            $(".messages").removeClass("d-none");
                            $(".messages").addClass("alert-warning");
                            for (let i = 0; i < res.student_existing_info.length; i++) {
                                
                                $(".messages").append(
                                `<p>Sorr! ${res.student_existing_info[i]} have alredy been promoted!</p>`
                                );
                                
                            }
                           
                        }else if(res.status == "success_promoted"){
                            $(".messages").removeClass("d-none");
                            $(".messages").addClass("alert-success");
                            $(".messages").append(
                            `<p> ${res.promoted_students.length} student have been promoted successfully!</p>`
                            );
                        }else if(res.status == "success_existing_promoted") {
                            // alert(res.student_existing_info);
                            // alert(res.promoted_students.length);
                            $(".messages").removeClass("d-none");
                            $(".messages").addClass("alert-warning");
                            $(".messages").append(
                            `<p> ${res.promoted_students.length} student have been promoted successfully!</p>`
                            );
                            for (let i = 0; i < res.student_existing_info.length; i++) {
                                
                                $(".messages").append(
                                `<p>Sorr! ${res.student_existing_info[i]} have alredy been promoted!</p>`
                                );
                                
                            }
                        }
                        
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
           
            
        });
    });
</script>

</body>
</html>

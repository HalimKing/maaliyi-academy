<style>
    .modal .modal-header {
    display: flex;
}
</style>
<!-- Button trigger modal -->
<button type="button" class="btn btn-warning float-end" data-bs-toggle="modal" data-bs-target="#promoteModal">
  Promote
</button>

<!-- Modal -->
<div class="modal fade" id="promoteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Promote Student(s) To</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="promoteStudent">
      <div class="modal-body">
        <div class="form-group mb-2">
            <label for="">Academic year</label>
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
        <div class="form-group mb-2">
            <label for="">Class</label>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" role="button" id="promote-btn"  name="filter" class="btn btn-warning">Proceed</button>
      </div>
      </form>
    </div>
  </div>
</div>
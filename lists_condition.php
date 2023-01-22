<?php 
include('config/db.php');
// Start Accept 
if(isset($_POST['accept'])) {
  $id = $_POST['id'];
  $status = $_POST['status'];
  $emp_id = $_POST['emp_id'];

  $sql = "UPDATE `status` SET `stat_status`='$status', emp_id = $emp_id WHERE stat_id = $id";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo 'success';
  } else {
    echo 'failed';
  }
}
// End Accept 

// Start Reject 
if(isset($_POST['reject'])) {
  $id = $_POST['id'];
  $status = $_POST['status'];
  $emp_id = $_POST['emp_id'];

  $sql = "UPDATE `status` SET `stat_status`='$status', emp_id = $emp_id WHERE stat_id = $id";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo 'success';
  } else {
    echo 'failed';
  }
}
// End Reject 


?>
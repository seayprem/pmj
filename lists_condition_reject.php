<?php 
include('config/db.php');

// Start Reject 
if(isset($_POST['reject'])) {
  $id = $_POST['id'];
  $status = $_POST['status'];
  $emp_id = $_POST['emp_id'];
  $t_id = $_POST['t_id'];

  $sql = "UPDATE `status` SET `stat_status`='$status', `stat_datetime` = current_timestamp(), emp_id = $emp_id WHERE stat_id = $id";
  $query = mysqli_query($conn, $sql);

  // check
  $check_transfer_detail_sql = "SELECT * FROM transfer_detail INNER JOIN offices ON transfer_detail.office_id = offices.office_id WHERE t_id = $t_id";
  $check_transfer_detail_query = mysqli_query($conn, $check_transfer_detail_sql);
  while($check_transfer_detail_row = mysqli_fetch_array($check_transfer_detail_query)) {
    $update_sql = "UPDATE `offices` SET `office_qty` = '".$check_transfer_detail_row['office_qty']."' + '".$check_transfer_detail_row['tdel_qty']."' WHERE `office_id` = '".$check_transfer_detail_row['office_id']."'";
    $update_query = mysqli_query($conn, $update_sql);
  }

  // update inventory stock

  if($query) {
    // echo 'success';
    // echo $t_id;
    echo 'success';
  } else {
    echo 'failed';
  }
}
// End Reject 


?>
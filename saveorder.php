<?php 
session_start();
include('config/db.php');
if(isset($_POST['saveorder'])) {
  $type = $_POST['type'];
  $status = $_POST['status'];
  $emp = $_POST['emp'];

  // echo $type . '<br>';
  // echo $status . '<br>';
  // echo $emp . '<br>';

  // Status Query
  $status_sql = "INSERT INTO `status` (stat_status) VALUES ('$status')";
  $status_query = mysqli_query($conn, $status_sql);

  $status_sql_select = "SELECT MAX(stat_id) AS id FROM `status`";
  $status_query_select = mysqli_query($conn, $status_sql_select);
  $status_row_select = mysqli_fetch_array($status_query_select);

  $status_id = $status_row_select['id'];

  // Save Transfer
  $transfer_sql = "INSERT INTO `transfer`(`t_type`, `stat_id`, `emp_id`, `t_datetime`) VALUES ('$type', '$status_id', '$emp', current_timestamp())";
  $transfer_query = mysqli_query($conn, $transfer_sql);

  // GET Max(id) Transfer
  $transfer_sql_max = "SELECT MAX(t_id) AS id FROM `transfer`";
  $transfer_query_max = mysqli_query($conn, $transfer_sql_max);
  $transfer_row_max = mysqli_fetch_array($transfer_query_max);

  $t_id = $transfer_row_max['id'];

  // save on transfer_detail
  foreach($_SESSION['cart'] as $id => $qty) {
    $office_sql = "SELECT * FROM `offices` WHERE `office_id` = '$id'";
    $office_query = mysqli_query($conn, $office_sql);
    $office_row = mysqli_fetch_array($office_query);

    
    $transfer_detail_sql = "INSERT INTO `transfer_detail` (t_id, office_id, tdel_qty) VALUES ('$t_id', '$id', $qty)";
    $transfer_detail_query = mysqli_query($conn, $transfer_detail_sql);


    $stock_sql = "UPDATE `offices` SET `office_qty`= '".$office_row['office_qty']."' - $qty WHERE office_id = $id";
    $stock_query = mysqli_query($conn, $stock_sql);


  }

  if($transfer_detail_query) {
    echo '<script src="js/sweetalert2@11.js"></script>';
    echo '<script src="js/jquery-3.6.3.min.js"></script>';
    echo "<script>
      $(document).ready(function() {
        $('div').hide();
        Swal.fire({
          icon: 'success',
          title: 'คุณได้ทำการเบิกวัสดุสำเร็จ',
          showConfirmButton: false,
          timer: 1500
        }).then((result) => {
          window.location.href = 'history.php';
        });
      });
    </script>";
    foreach($_SESSION['cart'] as $p_id)
		{	
			unset($_SESSION['cart']);
		}
  }
  
}
?>
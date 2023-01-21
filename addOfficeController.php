<?php 
include('config/db.php');
// Start Add Office Suplies Controller 
if(isset($_POST['save'])) {
  $name = $_POST['name'];
  $qty = $_POST['qty'];

  $sql = "INSERT INTO `offices`(`office_name`, `office_qty`) VALUES ('$name', $qty)";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo 'success';
  } else {
    echo 'failed';
  }

}
// End Add Office Suplies Controller 

// Start Update Office Supplier Controller 
if(isset($_POST['edit'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $qty = $_POST['qty'];

  $sql = "UPDATE `offices` SET `office_name`='$name',`office_qty`= '$qty' WHERE office_id = '$id'";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo 'success';
  } else {
    echo 'failed';
  }

}
// End Update Office Supplier Controller 

// Start Delete Office Supplier Controller 
if(isset($_REQUEST['delete'])) {
  $id = $_REQUEST['delete'];
  $sql = "DELETE FROM `offices` WHERE office_id = '$id'";
  $query = mysqli_query($conn, $sql);
  if($query) {
    // header("Location: login.php");
    echo '<script src="js/sweetalert2@11.js"></script>';
    echo '<script src="js/jquery-3.6.3.min.js"></script>';
    // echo '<script>window.location = "login.php"</script>';
    echo "<script>
    $(document).ready(function() {
      $('div').hide();
      Swal.fire({
        icon: 'success',
        title: 'ลบข้อมูลวัสดุสำนักงานสำเร็จ',
        showConfirmButton: false,
        timer: 1500
      }).then((result) => {
        window.location.href = 'offices.php';
      });
    });
    </script>";
  } else {
    // header("Location: login.php");
    echo '<script src="js/sweetalert2@11.js"></script>';
    echo '<script src="js/jquery-3.6.3.min.js"></script>';
    // echo '<script>window.location = "login.php"</script>';
    echo "<script>
    $(document).ready(function() {
      $('div').hide();
      Swal.fire({
        icon: 'error',
        title: 'ลบข้อมูลวัสดุสำนักงานไม่สำเร็จ',
      }).then((result) => {
        window.location.href = 'offices.php';
      });
    });
    </script>";
  }
}
// End Delete Office Supplier Controller 


?>
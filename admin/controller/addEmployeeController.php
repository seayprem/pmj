<?php 
include('../../config/db.php');
if(isset($_POST['add'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $level = $_POST['level'];

  // เริ่ม เพิ่มวัสดุสำนักงาน
  $sql = "INSERT INTO `employees`(`emp_user`, `emp_pass`, `emp_fname`, `emp_lname`, `emp_level`) VALUES ('$username', '$password', '$fname', '$lname', $level)";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo "สำเร็จ";
    header("Location: ../employees.php");
  } else {
    echo "ล้มเหลว";
  }
  // จบ เพิ่มวัสดุสำนักงาน

}
?>
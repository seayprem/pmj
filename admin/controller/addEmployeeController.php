<?php 
include('../../config/db.php');
if(isset($_POST['add'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $level = $_POST['level'];

  // เริ่ม เพิ่มพนักงาน
  $sql = "INSERT INTO `employees`(`emp_user`, `emp_pass`, `emp_fname`, `emp_lname`, `emp_level`) VALUES ('$username', '$password', '$fname', '$lname', $level)";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo "สำเร็จ";
    header("Location: ../employees.php");
  } else {
    echo "ล้มเหลว";
  }
  // จบ เพิ่มพนักงาน

}

// เริ่ม ระบบอัพเดทพนักงาน

if(isset($_POST['update'])) {
  $id = $_POST['id'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $level = $_POST['level'];

  // DEBUG
  // echo $id . "<br>";
  // echo $username . "<br>";
  // echo $password . "<br>";
  // echo $fname . "<br>";
  // echo $lname . "<br>";
  // echo $level . "<br>";

  $sql = "UPDATE employees SET emp_user = '$username', emp_pass = '$password', emp_fname = '$fname', emp_lname = '$lname', emp_level = '$level' WHERE emp_id = '$id'";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo "สำเร็จ";
    header("Location: ../employees.php");
  } else {
    echo "ล้มเหลว";
  }

}

// จบ ระบบอัพเดทพนักงาน

// เริ่ม ลบพนักงาน
if(isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql = "DELETE FROM employees WHERE emp_id = '$id'";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo "สำเร็จ";
    header("Location: ../employees.php");
  } else {
    echo "ล้มเหลว";
  }
}
// จบ ลบพนักงาน

?>
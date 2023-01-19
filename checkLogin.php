<?php 
include_once('config/db.php');

session_start();

if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM `employees` WHERE emp_user = '".$username."' AND emp_pass = '".$password."' ";
  $query = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($query);
  if(mysqli_num_rows($query) > 0) {
    $_SESSION['emp_role'] = $row['emp_role'];
    $_SESSION['emp_fname'] = $row['emp_fname'];
    $_SESSION['emp_lname'] = $row['emp_lname'];
    $_SESSION['emp_id'] = $row['emp_id'];
    echo 'success';
  } else {
    echo 'failed';
  }

}

?>
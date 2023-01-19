<?php 
include('config/db.php');
// Start Add Employee Controller 
if(isset($_POST['save'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $position = $_POST['position'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  // Debug

  // echo $fname . '<br>';
  // echo $lname . '<br>';
  // echo $position . '<br>';
  // echo $username . '<br>';
  // echo $password . '<br>';
  // echo $role . '<br>';

  // Insert into database
  $sql = "INSERT INTO `employees`(`emp_user`, `emp_pass`, `emp_fname`, `emp_lname`, `emp_position`, `emp_role`) VALUES ('$username', '$password', '$fname', '$lname', '$position', '$role')";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo 'success';
  } else {
    echo 'failed';
  }

}
// End Add Employee Controller 

// Start Update Employee Controller 
if(isset($_POST['edit'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $position = $_POST['position'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $id = $_POST['id'];

  $sql = "UPDATE `employees` SET `emp_user`='$username',`emp_pass`='$password',`emp_fname`='$fname',`emp_lname`='$lname',`emp_position`='$position',`emp_role`='$role' WHERE `emp_id` = '$id'";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo 'success';
  } else {
    echo 'failed';
  }

}
// End Update Employee Controller 

// Start Delete Employee Controller 
if(isset($_REQUEST['delete'])) {
  $id = $_REQUEST['delete'];
  $sql = "DELETE FROM `employees` WHERE emp_id = '$id'";
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
        title: 'ลบข้อมูลเจ้าหน้าที่พนักงานสำเร็จ',
        showConfirmButton: false,
        timer: 1500
      }).then((result) => {
        window.location.href = 'employees.php';
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
        title: 'ลบข้อมูลเจ้าหน้าที่พนักงานไม่สำเร็จ',
      }).then((result) => {
        window.location.href = 'employees.php';
      });
    });
    </script>";
  }
}
// End Delete Employee Controller 
?>
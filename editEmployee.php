<?php 
include('config/db.php');
session_start();
// Check Session
if(empty($_SESSION['emp_role'])) {
  // header("Location: login.php");
  echo '<script src="js/sweetalert2@11.js"></script>';
  echo '<script src="js/jquery-3.6.3.min.js"></script>';
  // echo '<script>window.location = "login.php"</script>';
  echo "<script>
  $(document).ready(function() {
    $('div').hide();
    Swal.fire({
      icon: 'error',
      title: 'คุณไม่ได้รับอนุญาตในการเข้าถึงหน้าต่างนี้',
      text: 'กรุณาเข้าสู่ระบบ!',
    }).then((result) => {
      window.location.href = 'login.php';
    });
  });
  </script>";
}
// Check Permission
// if you role == 1
// u can't entry this window
if($_SESSION['emp_role'] == 1) {
   // header("Location: login.php");
   echo '<script src="js/sweetalert2@11.js"></script>';
   echo '<script src="js/jquery-3.6.3.min.js"></script>';
   // echo '<script>window.location = "login.php"</script>';
   echo "<script>
   $(document).ready(function() {
     $('div').hide();
     Swal.fire({
       icon: 'error',
       title: 'คุณไม่มีสิทธิ์ในการเข้าถึงหน้าต่างนี้',
     }).then((result) => {
       window.location.href = 'index.php';
     });
   });
   </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>แก้ไขเจ้าหน้าที่พนักงาน | สํานักงานพัฒนาสังคมและความมั่นคงของมนุษย์ นครราชสีมา</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/fonts.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">

  <style>
    .dataTables_filter input {
      margin-bottom: 1em;
    }
  </style>

</head>
<body>
  
  <div class="main-container d-flex">
    <!-- start navbar  -->
    <div class="sidebar" id="side_nav">
      <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2"></span><span class="text-white">สนง. พมจ.</span></h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i
            class="fa-solid fa-bars-staggered"></i></button>
      </div>

      <!-- Start for menuSidebar  -->
      <?php include('includes/menuSidebar.inc.php'); ?>
      <!-- End for menuSidebar  -->

    </div>

    <!-- end navbar  -->

    <!-- start content -->
    <div class="content">
      <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">

          <div class="d-flex justify-content-between d-md-none d-block">
            <button class="btn px-1 py-0 open-btn me-2"><i class="fa-solid fa-bars-staggered"></i></button>
            <a class="navbar-brand" href="#"><span class="bg-pmj rounded px-2 py-0 text-white">สนง. พมจ.</span></a>
          </div>

          <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars-staggered"></i>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#"></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- end content -->

    <!-- start dashboard content  -->
    <div class="dashboard-content px-3 pt-4">
      <h2 class="fs-5"> แก้ไขเจ้าหน้าที่พนักงาน</h2>
      <hr>

      <!-- Start Data Personal -->
      <?php 
      if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM `employees` WHERE emp_id = '$id'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
      }
      ?>
      <div class="card">
        <h5 class="card-header">ข้อมูลทั่วไป</h5>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">ชื่อจริง / First Name</label>
                    <input type="text" class="form-control" id="fname" value="<?= $row['emp_fname']; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">นามสกุล / Last Name</label>
                    <input type="text" class="form-control" id="lname" value="<?= $row['emp_lname']; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">ตำแหน่งงาน / Position</label>
                    <input type="text" class="form-control" id="position" value="<?= $row['emp_position']; ?>">
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <!-- End Data Personal -->

      <!-- Start Data Users Login  -->
      <div class="card mt-3">
        <h5 class="card-header">ข้อมูลลงชื่อเข้าใช้</h5>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    
                    <label class="form-label">ชื่อผู้ใช้ / Username</label>
                    <input type="text" class="form-control" id="username" value="<?= $row['emp_user']; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">รหัสผ่าน / Password</label>
                    <input type="password" class="form-control" id="password" value="<?= $row['emp_pass']; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">สิทธิ์การเข้าถึงของเว็บไซต์ / Permission Access</label>
                    <select class="form-select" aria-label="Default select example" id="role">
                      <option selected value="<?= $row['emp_role']; ?>">กรุณาเลือกสิทธิ์การเข้าถึงของเว็บไซต์</option>
                      <option value="1">เจ้าหน้าที่พนักงาน</option>
                      <option value="2">ผู้ดูแลระบบ</option>
                    </select>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <!-- End Data Users Login  -->

      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="d-grid gap-2 mx-auto mt-2 mb-2">
                <input type="hidden" id="id" value="<?= $row['emp_id']; ?>">
                <button class="btn btn-success" type="button" id="edit">อัพเดทข้อมูลลงระบบ</button>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-grid gap-2 mx-auto mt-2 mb-2">
              <a href="employees.php" class="btn btn-danger" type="button">ยกเลิก</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>


    <!-- end dashboard content  -->

  </div>

  <script src="js/jquery-3.6.3.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/sweetalert2@11.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/responsive.js"></script>

  <script>
    $(document).ready(function() {

      // Start List Data Table 
      $('#myTable').DataTable();
      // End List Data Table 

      // Start Logout 

      $('#logout').on('click', function(e) {
        e.preventDefault();

        Swal.fire({
          icon: 'success',
          title: 'ออกจากระบบสำเร็จ',
          showConfirmButton: false,
          timer: 1500
        }).then((result) => {
          window.location = 'logout.php';
        })
      })

      // End Logout 

      // Start Edit Employee
      $('#edit').on('click', function(e) {

        // Form Input
        const fname = $('#fname').val();
        const lname = $('#lname').val();
        const position = $('#position').val();
        const username = $('#username').val();
        const password = $('#password').val();
        const role = $('#role').val();
        const id = $('#id').val();

        // Event Clicker
        e.preventDefault();

        // Validation
        if(!fname || !lname || !position || !username || !password) {
          Swal.fire({
            icon: 'error',
            title: 'กรุณากรอกข้อมูลให้ครบทุกช่อง',
          })
        }      

        // Ajax => Server
        $.ajax({
          url: 'addEmployeeController.php',
          method: 'POST',
          data: {
            fname: fname,
            lname: lname,
            position: position,
            username: username,
            password: password,
            role: role,
            id: id,
            edit: 'edit'
          },
          success: function(response) {
            // debug
            // console.log(response);
            if(response === 'success') {
              Swal.fire({
                icon: 'success',
                title: 'อัพเดทข้อมูลเจ้าหน้าที่พนักงานสำเร็จ',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location = 'employees.php';
              })
            } else {
              Swal.fire({
                icon: 'error',
                title: 'อัพเดทข้อมูลเจ้าหน้าที่พนักงานไม่สำเร็จ โปรดลองอีกครั้ง',
              }).then((result) => {
                window.location = 'employees.php';
              })
            }
          }
        })
        

      })
      // End Edit Employee

    })
  </script>

</body>
</html>
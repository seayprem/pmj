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
  <title>เพิ่มวัสดุสำนักงาน | สํานักงานพัฒนาสังคมและความมั่นคงของมนุษย์ นครราชสีมา</title>

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
      <h2 class="fs-5"> แก้ไขข้อมูลวัสดุสำนักงาน</h2>
      <hr>

      <!-- Start Data Personal -->
      <?php 
      if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM `offices` WHERE office_id = '$id'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
      }
      ?>
      <div class="card">
        <h5 class="card-header">ข้อมูลวัสดุสำนักงาน</h5>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">ชื่อวัสดุสำนักงาน / Office Name</label>
                    <input type="text" class="form-control" id="name" value="<?= $row['office_name']; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">จำนวนวัสดุสำนักงาน / Office Quality</label>
                    <input type="number" class="form-control" id="qty"  value="<?= $row['office_qty']; ?>">
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <!-- End Data Personal -->

      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="d-grid gap-2 mx-auto mt-2 mb-2">
                <input type="hidden" id="id" value="<?= $row['office_id']; ?>">
                <button class="btn btn-success" type="button" id="edit">อัพเดทข้อมูลลงระบบ</button>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-grid gap-2 mx-auto mt-2 mb-2">
              <a href="offices.php" class="btn btn-danger" type="button">ยกเลิก</a>
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

      // Start Edit Office Supplier
      $('#edit').on('click', function(e) {
        // form input
        const id = $('#id').val();
        const name = $('#name').val();
        const qty = $('#qty').val();

        // event clicker
        e.preventDefault();

        // Validation
        if(!name || !qty) {
          Swal.fire({
            icon: 'error',
            title: 'กรุณากรอกข้อมูลให้ครบทุกช่อง',
          })
        }

        // Ajax => Server
        $.ajax({
          url: 'addOfficeController.php',
          method: 'POST',
          data: {
            id: id,
            name: name,
            qty: qty,
            edit: 'edit'
          },
          success: function(response) {
            if(response === 'success') {
              Swal.fire({
                icon: 'success',
                title: 'อัพเดทข้อมูลวัสดุสำนักงานสำเร็จ',
                showConfirmButton: false,
                timer: 1500
              }).then((result) => {
                window.location = 'offices.php';
              })
            } else {
              Swal.fire({
                icon: 'error',
                title: 'อัพเดทข้อมูลวัสดุสำนักงานไม่สำเร็จ โปรดลองอีกครั้ง',
              }).then((result) => {
                window.location = 'offices.php';
              })
            }
          }
        })

      })
      // End Edit Office Supplier


    })
  </script>

</body>
</html>
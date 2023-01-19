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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>วัสดุสำนักงาน | สํานักงานพัฒนาสังคมและความมั่นคงของมนุษย์ นครราชสีมา</title>

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
      <h2 class="fs-5"> วัสดุสำนักงาน</h2>
      <hr>
      
      <!-- start add button  -->
      <a href="#" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> เพิ่มข้อมูลวัสดุสำนักงาน</a>
      <!-- end add button  -->

     

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

    })
  </script>

</body>
</html>
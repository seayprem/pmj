<?php 
include('../config/db.php');
session_start();
if(empty($_SESSION['emp_level'])) {
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>รายการเบิกจ่าย</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/fonts.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
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
        <h2 class="fs-5"> ประวัติรายการสำหรับการเบิกวัสดุสำนักงาน</h2>
        <hr>
      </div>


      <!-- start table transfer  -->
      <div class="dashboard-content px-3 pt-4">
        <h2 class="fs-5"> ประวัติเบิกวัสดุสำนักงาน</h2><br>
        <!-- start table  -->
        <div class="table-responsive">

          <table class="table align-middle table-hover" id="myTable">
            <thead class="table-pmj text-white">
              <tr>
                <th class="text-center">ลำดับ</th>
                <th class="text-center">ชื่อสินค้า</th>
                <th class="text-center">ประเภทสินค้า</th>
                <th class="text-center">จำนวนที่เบิก</th>
                <th class="text-center">พนักงานที่เบิก</th>
              </tr>
            </thead>
            <tbody>
              <!-- เริ่ม แสดงรายการวัสดุสำนักงาน -->
              <?php 
              $session_id = $_SESSION['emp_id'];
              $sql = "SELECT * FROM transactions INNER JOIN products ON transactions.product_id = products.product_id INNER JOIN employees ON transactions.emp_id = employees.emp_id INNER JOIN category ON products.cate_id = category.cate_id";
              $query = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_array($query)) {

              
              ?>
              <tr class="text-center">
                <td><?= $row['t_id']; ?></td>
                <td><?= $row['product_name']; ?></td>
                <td><?= $row['cate_name']; ?></td>
                <td><?= $row['t_qty']; ?></td>
                <td><?= $row['emp_fname'] . " " . $row['emp_lname']; ?></td>
              </tr>
              <?php } ?>
              <!-- จบ แสดงรายการวัสดุสำนักงาน -->
            </tbody>
          </table>

        </div>
        <!-- end table  -->
      </div>
      <!-- end table transfer  -->


      <!-- end dashboard content  -->


    </div>

  </div>

  <script src="js/jquery-3.6.3.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/responsive.js"></script>

  <script>
    $(document).ready(function() {
      $("#myTable").DataTable();
    });
  </script>

</body>
</html>
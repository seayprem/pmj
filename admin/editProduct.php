<?php 
session_start();
if(empty($_SESSION['emp_level'])) {
  header("Location: login.php");
}

if($_SESSION['emp_level'] != 2) {
  header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>แก้ไขวัสดุสำนักงาน | ผู้ดูแลระบบ</title>
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

      <!-- Start menu for admin  -->
      <?php include('includes/menuSidebar.inc.php'); ?>
      <!-- end menu for admin  -->
      

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
        <h2 class="fs-5"> แก้ไขวัสดุสำนักงาน</h2>
        <hr>
      </div>


      <!-- start table transfer  -->
      <div class="dashboard-content px-3 pt-4">
        <!-- <h2 class="fs-5"> เพิ่มวัสดุสำนักงาน</h2><br> -->
        <!-- <div class="mb-3">
          <a href="#" class="btn btn-pmj">เพิ่มสินค้า</a>
        </div> -->
        
        <!-- เริ่ม ฟอร์มเพิ่มวัสดุสำนักงาน -->
        
        <form action="controller/addProductController.php" method="POST">
          <?php 
          include('../config/db.php');
          if($_GET['id']) {
            $id = $_GET['id'];
            $edit_sql = "SELECT * FROM products INNER JOIN category ON products.cate_id = category.cate_id WHERE products.product_id = '$id'";
            $edit_query = mysqli_query($conn, $edit_sql);
            $edit_row = mysqli_fetch_array($edit_query);
          }
          
          ?>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">รหัสวัสดุสำนักงาน</label>
                <input type="text" class="form-control" value="<?= $edit_row['product_id']; ?>" disabled required>
              </div>
              <div class="mb-3">
                <input type="hidden" class="form-control" name="id" value="<?= $edit_row['product_id']; ?>">
              </div>
              <div class="mb-3">
                <label class="form-label">ชื่อวัสดุสำนักงาน</label>
                <input type="text" class="form-control" name="name" value="<?= $edit_row['product_name']; ?>" required>
              </div>
              
              
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">จำนวน</label>
                <input type="number" class="form-control" name="qty" value="<?= $edit_row['product_qty']; ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label">ประเภทวัสดุสำนักงาน</label>
                <select class="form-select" name="category" required>
                  <option selected value="<?= $edit_row['cate_id']; ?>"><?= $edit_row['cate_name']; ?></option>
                  <option disabled>กรุณาเลือกประเภทวัสดุสำนักงาน</option>
                  <!-- เริ่ม แสดงเมนูให้เลือก -->
                  <?php 
                  $sql = "SELECT * FROM category ORDER BY cate_id DESC";
                  $query = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?= $row['cate_id']; ?>"><?= $row['cate_name']; ?></option>
                  <?php } ?>
                  <!-- จบ แสดงเมนูให้เลือก -->
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-grid gap-2">
                <button type="submit" name="update" class="btn btn-pmj">บันทึกการแก้ไข</button>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-grid gap-2">
                <a href="index.php" class="btn btn-pmj">ย้อนกลับ</a>
              </div>
            </div>
          </div>
        </form>
          
        <!-- จบ ฟอร์มเพิ่มวัสดุสำนักงาน -->


      <!-- end dashboard content  -->


    </div>

  </div>

  <script src="js/jquery-3.6.3.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/responsive.js"></script>

</body>
</html>
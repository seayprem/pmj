<?php 
include('config/db.php');
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
  <title>หน้าหลัก</title>
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
        <h2 class="fs-5"> รายการสำหรับการเบิกวัสดุสำนักงาน</h2>
        <hr>
      </div>


      <!-- start table transfer  -->
      <div class="dashboard-content px-3 pt-4">
        <h2 class="fs-5"> รายการสินค้าคงเหลือ</h2><br>
        <!-- start table  -->
        <div class="table-responsive">

          <table class="table align-middle table-hover" id="myTable">
            <thead class="table-pmj text-white">
              <tr>
                <th class="text-center">รหัสสินค้า</th>
                <th class="text-center">ชื่อสินค้า</th>
                <th class="text-center">ประเภทสินค้า</th>
                <th class="text-center">จำนวนสินค้าคงเหลือ</th>
                <th class="text-center">เบิกวัสดุ</th>
              </tr>
            </thead>
            <tbody>
              <!-- เริ่ม แสดงรายการวัสดุสำนักงาน -->
              <?php 
              $sql = "SELECT * FROM products INNER JOIN category ON products.cate_id = category.cate_id";
              $query = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_array($query)) {

              
              ?>
              <tr class="text-center">
                <td><?= $row['product_id']; ?></td>
                <td><?= $row['product_name']; ?></td>
                <td><?= $row['cate_name']; ?></td>
                <td><?= $row['product_qty']; ?></td>
                <td>
                  <!-- start ปุ่ม Modal -->
                  <a href="#" class="btn btn-pmj" data-bs-toggle="modal" data-bs-target="#<?= $row['product_id']; ?>">เบิกวัสดุ</a>
  
                  

                  <!-- end ปุ่ม Modal -->

                </td>
              </tr>
              <!-- start form modal  -->
              <div class="modal fade" id="<?= $row['product_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><?= $row['product_name']; ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <!-- Start Form QTY for disbursement -->
                          <form action="controller/disbursementController.php" method="POST">
                            <input type="hidden" name="id" value="<?= $row['product_id']; ?>">
                            <input type="hidden" name="qty_product" value="<?= $row['product_qty']; ?>">
                            <input type="hidden" name="emp_id" value="<?= $_SESSION['emp_id']; ?>">
                            <div class="mb-3">
                              <label class="label">จำนวนที่จะเบิกวัสดุสำนักงาน</label>
                              <input type="number" class="form-control" name="qty" value="1" required>
                            </div>
                          
                          <!-- End Form QTY for disbursement -->
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                          <button type="submit" name="export" class="btn btn-pmj" onclick="return confirm('แน่ใจใช่หรือไม่?');">บันทึก</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- end form modal  -->

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
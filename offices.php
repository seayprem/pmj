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
      <?php 
      if($_SESSION['emp_role'] == 2) {

      
      ?>
      <a href="addOffice.php" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> เพิ่มข้อมูลวัสดุสำนักงาน</a>
      <?php } ?>
      <!-- end add button  -->

     <!-- Start List Offices Supllier -->
     <table class="table" id="myTable">
        <thead>
          <tr>
            <th class="text-center">ลำดับ</th>
            <th class="text-center">ชื่อวัสดุสำนักงาน</th>
            <th class="text-center">จำนวนวัสดุสำนักงาน</th>
            <th class="text-center">จัดการ</th>
          </tr>
        </thead>
        <tbody>
          <!-- Start Show Data Offices -->
          <?php 
          $sql = "SELECT * FROM `offices` ORDER BY office_id DESC";
          $query = mysqli_query($conn, $sql);
          $i = 0;
          while($row = mysqli_fetch_array($query)) {

            $i++;
          ?>
          <tr class="<?php if($row['office_qty'] == 0) { echo 'table-danger'; } ?>">
            <td class="text-center"><?= $i; ?></td>
            <td class="text-center"><?= $row['office_name']; ?></td>
            <td class="text-center"><?= number_format($row['office_qty']); ?></td>
            <td class="text-center">
              <?php 
              if($_SESSION['emp_role'] == 2) {

              
              ?>
              <a href="editOffice.php?id=<?= $row['office_id']; ?>" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
              <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row['office_id']; ?>"><i class="fa-solid fa-trash"></i></a>
              <?php } ?>
              <?php 
              if($_SESSION['emp_role'] == 1 && $row['office_qty'] >= 1) {
              ?>
              <a href="lists.php?id=<?= $row['office_id']; ?>&act=add" class="btn btn-primary">เพิ่มลงรายการ</a>
              <?php } else { ?>
              <a href="#" class="btn btn-primary">ไม่สามารถเบิกได้</a>
              <?php } ?>
            </td>
          </tr>
          <!-- Start Modal Delete Offices  -->
          <!-- Modal -->
          <div class="modal fade" id="deleteModal<?= $row['office_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">คุณต้องการลบ <b><?= $row['office_name']; ?> </b> ใช่หรือไม่?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>หากได้ทำการคลิกที่ปุ่ม <b>ยืนยัน</b> แล้ว ข้อมูลจะถูกลบออกไปถาวร</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                  <a href="addOfficeController.php?delete=<?= $row['office_id']; ?>" class="btn btn-primary">ยืนยัน</a>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <!-- End Show Data Offices -->
        </tbody>
      </table>
     <!-- End List Offices Supllier -->

    </div>


    <br><br><br>
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
<?php 
error_reporting(0);
include('config/db.php');
session_start();
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
  <title>รายการวัสดุสำนักงาน - สํานักงานพัฒนาสังคมและความมั่นคงของมนุษย์ นครราชสีมา</title>

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
      <h2 class="fs-5"> รายการวัสดุสำนักงาน</h2>
      <hr>
      <!-- Start Cart Controller  -->
      <?php 
      $id = $_GET['id'];
      $act = $_GET['act'];

      if($act == 'add' && !empty($id)) {
        if(isset($_SESSION['cart'][$id])) {
          $_SESSION['cart'][$id]++;
          header("Location: lists.php");
        } else {
          $_SESSION['cart'][$id] = 1;
          header("Location: lists.php");
        }
      }

      if($act == 'decres' && !empty($id)) {
        if(isset($_SESSION['cart'][$id])) {
          $_SESSION['cart'][$id]--;
          header("Location: lists.php");
        } else {
          $_SESSION['cart'][$id] = 1;
          header("Location: lists.php");
        }
      }

      if($act == 'remove' && !empty($id)) {
        
        unset($_SESSION['cart'][$id]);
        header("Location: lists.php");
      }

      if($act=='update')
        {
          $amount_array = $_POST['amount'];
          foreach($amount_array as $id=>$amount)
          {
            $_SESSION['cart'][$id]=$amount;
          }
        }


      ?>
      <!-- End Cart Controller  -->
    </div>
    <form id="frmcart" name="frmcart" method="post" action="?act=update">
    <?php 
    if(!empty($_SESSION['cart'])) { ?>
    <div class="container">
        <table class="table table-danger">
          <thead>
            <th class="text-center">ลำดับ</th>
            <th class="text-center">วัสดุสำนักงาน</th>
            <th class="text-center">จำนวน</th>
            <th class="text-center">ลบรายการ</th>
          </thead>
    <?php
      $i = 0;
      foreach($_SESSION['cart'] as $id => $qty) {
        $sql = "SELECT * FROM `offices` WHERE office_id = '$id'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);

        $i++;

      ?>

      
          <tbody>
            <td class="text-center"> <?= $i; ?></td>
            <td class="text-center"> <?= $row['office_name']; ?></td>
            <td class="text-center">
            <form class="row g-3 justify-content-center">
              <!-- <div class="col-auto">
                <a href="lists.php?id=<?= $row['office_id']; ?>&act=decres" id="decres" class="btn btn-primary mb-3">-</a>
              </div> -->
              <div class="col-auto text-center">
                <?php echo "<input type='number' class='form-control' name='amount[$id]' value='$qty' min='1' max='".$row['office_qty']."' style='width: 88px;'/>" ?>
              </div>
            <!-- <div class="col-auto">
              <a href="lists.php?id=<?= $row['office_id']; ?>&act=add" id="incres" class="btn btn-primary mb-3">+</a>
            </div> -->
          </form>

            </td>
            <td class="text-center">
              <a href="lists.php?id=<?= $row['office_id']; ?>&act=remove" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
          </tbody>
        
    <?php   } ?> 
    <h3 class="text-center">ทั้งหมด <?= $i; ?> รายการ</h3>
    </table>
    <input type="submit" name="button" value="ปรับปรุง">
    </form>

    <div class="text-center">
      <a href="offices.php" class="btn btn-pmj">วัสดุสำนักงาน</a>
      <a href="confirm.php" class="btn btn-success">ยืนยัน</a>
      <a href="offices.php" class="btn btn-danger">ยกเลิก</a>
    </div>
      </div>
      
    <?php
  } else { ?>
      <h3 class="text-center">ไม่พบรายการ</h3>
    <?php } ?>
    

    <!-- end dashboard content  -->

  </div>

  <script src="js/jquery-3.6.3.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/sweetalert2@11.js"></script>
  <script src="js/responsive.js"></script>

  <script>
    $(document).ready(function() {

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
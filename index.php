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
// Check Permission
// if you role == 1
// u can't entry this window
if($_SESSION['emp_role'] == 1) {
  header("Location: offices.php");
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
      window.location.href = 'offices.php';
    });
  });
  </script>";
}

$count_transfer_sql = "SELECT COUNT(t_id) AS total FROM transfer";
$count_transfer_query = mysqli_query($conn, $count_transfer_sql);
$count_transfer_result = mysqli_fetch_array($count_transfer_query);

$count_transfer_export_sql = "SELECT COUNT(t_id) AS total FROM transfer WHERE t_type = 1";
$count_transfer_export_query = mysqli_query($conn, $count_transfer_export_sql);
$count_transfer_export_result = mysqli_fetch_array($count_transfer_export_query);

$count_transfer_import_sql = "SELECT COUNT(t_id) AS total FROM transfer WHERE t_type = 2";
$count_transfer_import_query = mysqli_query($conn, $count_transfer_import_sql);
$count_transfer_import_result = mysqli_fetch_array($count_transfer_import_query);

$count_status_pending_sql = "SELECT COUNT(stat_id) AS pending FROM status WHERE stat_status = 1";
$count_status_pending_query = mysqli_query($conn, $count_status_pending_sql);
$count_status_pending_result = mysqli_fetch_array($count_status_pending_query);

$count_status_accept_sql = "SELECT COUNT(stat_id) AS accept FROM status WHERE stat_status = 2";
$count_status_accept_query = mysqli_query($conn, $count_status_accept_sql);
$count_status_accept_result = mysqli_fetch_array($count_status_accept_query);

$count_status_reject_sql = "SELECT COUNT(stat_id) AS reject FROM status WHERE stat_status = 3";
$count_status_reject_query = mysqli_query($conn, $count_status_reject_sql);
$count_status_reject_result = mysqli_fetch_array($count_status_reject_query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สํานักงานพัฒนาสังคมและความมั่นคงของมนุษย์ นครราชสีมา</title>

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
      <h2 class="fs-5"> Dashboard</h2>
      <hr>
      <!-- start count all  -->
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3">
              <div class="card text-white bg-primary mb-3">
                <div class="card-header">จำนวนรายการวัสดุที่ทำรายการทั้งหมด</div>
                  <div class="card-body">
                    <h5 class="card-title">จำนวน <?= number_format($count_transfer_result['total']); ?> รายการ</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
              <div class="card text-white bg-success mb-3">
                <div class="card-header">จำนวนรายการวัสดุที่อนุมัติทั้งหมด</div>
                <div class="card-body">
                  <h5 class="card-title">จำนวน <?= number_format($count_status_accept_result['accept']); ?> รายการ</h5>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card text-white bg-warning mb-3">
                <div class="card-header">จำนวนรายการวัสดุที่รออนุมัติทั้งหมด</div>
                  <div class="card-body">
                    <h5 class="card-title">จำนวน <?= number_format($count_status_pending_result['pending']); ?> รายการ</h5>
                  </div>
                </div>
            </div>
            <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">จำนวนรายการวัสดุที่ปฏิเสธอนุมัติทั้งหมด</div>
                  <div class="card-body">
                    <h5 class="card-title">จำนวน <?= number_format($count_status_reject_result['reject']); ?> รายการ</h5>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end count all  -->
    <hr>

    <!-- start chart  -->
    <canvas id="myChart" height="100"></canvas>
    <!-- end chart  -->


    </div>




    <!-- end dashboard content  -->

  </div>

  <script src="js/jquery-3.6.3.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/sweetalert2@11.js"></script>
  <script src="js/responsive.js"></script>
  <script src="js/chart.min.js"></script>

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

      // start chart 
      const ctx = document.getElementById('myChart');
      Chart.defaults.font.size = 18;
      Chart.defaults.color = "#000";

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['นำเข้า', 'เบิก', 'อนุมัติ', 'ไม่อนุมัติ', 'รออนุมัติ'],
          datasets: [{
            label: 'แสดงข้อมูลทั่วไป',
            data: [<?= $count_transfer_import_result['total']; ?>, <?= $count_transfer_export_result['total']; ?>, <?= $count_status_accept_result['accept']; ?>, <?= $count_status_reject_result['reject']; ?>, <?= $count_status_pending_result['pending']; ?>],
            backgroundColor: [
              'rgb(126, 245, 51)',
              'rgb(230, 55, 11)',
              'rgb(60, 240, 123)',
              'rgb(255, 51, 88)',
              'rgb(219, 255, 18)'
            ],
            borderWidth: 5
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
      // end chart 

    })
  </script>

</body>
</html>
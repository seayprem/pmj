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
  <title>ออกรายงาน | สํานักงานพัฒนาสังคมและความมั่นคงของมนุษย์ นครราชสีมา</title>

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
      <h2 class="fs-5"> ออกรายงาน</h2>
      <hr>
      <!-- START DATE SELECT  -->
      <form action="report.php" method="POST">
      <div class="mb-3">
        <div class="row">
          
          <div class="col-md-3">
            <label class="form-label">เลือกวันที่เริ่มต้น</label>
            <input type="date" name="date_start" class="form-control">
            <label class="form-label">เวลา</label>
            <input type="time" name="time_start" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="form-label">เลือกวันที่สิ้นสุด</label>
              <input type="date" name="date_end" class="form-control">
              <label class="form-label">เวลา</label>
              <input type="time" name="time_end" class="form-control">
          </div>
        </div>
        <button type="submit" class="btn btn-pmj mt-2" id="time_select" name="time_select">ตกลง</button>
      </div>
      </form>
      <!-- END DATE SELECT  -->
      
     <!-- Start List Pending Supllier -->

      
     <table class="table table-hover" id="myTable">
      <thead>
        <th class="text-center">ลำดับ</th>
        <th class="text-center">พนักงานที่ทำรายการ</th>
        <th class="text-center">ประเภทการทำรายการ</th>
        <th class="text-center">สถานะ</th>
        <th class="text-center">เวลาทำรายการ</th>
        <th class="text-center">เวลาอนุมัติ</th>
      </thead>
      <tbody>
          <?php 
          $emp_id = $_SESSION['emp_id'];
          $i = 0;

          

          if(isset($_POST['time_select'])) {
            $date_start = $_POST['date_start'];
            $time_start = $_POST['time_start'];
            $date_end = $_POST['date_end'];
            $time_end = $_POST['time_end'];

            if(empty($date_start) && empty($time_start) && empty($date_end) && empty($time_end)) {
              // $sql = "SELECT * FROM `transfer` INNER JOIN status ON transfer.stat_id = status.stat_id INNER JOIN employees ON transfer.emp_id = employees.emp_id ORDER BY transfer.t_id DESC";
              $sql = "SELECT * FROM `transfer` INNER JOIN status ON transfer.stat_id = status.stat_id INNER JOIN employees ON transfer.emp_id = employees.emp_id WHERE status.stat_status = 4 ORDER BY transfer.t_id DESC";
            } else if(empty($time_start) && empty($time_end)) {
              $sql = "SELECT * FROM `transfer` INNER JOIN status ON transfer.stat_id = status.stat_id INNER JOIN employees ON transfer.emp_id = employees.emp_id WHERE DATE(t_datetime) BETWEEN '$date_start' AND '$date_end'";

            } else {
              $sql = "SELECT * FROM `transfer` INNER JOIN status ON transfer.stat_id = status.stat_id INNER JOIN employees ON transfer.emp_id = employees.emp_id WHERE t_datetime BETWEEN '$date_start $time_start' AND '$date_end $time_end'";
            }

          } else {
            $sql = "SELECT * FROM `transfer` INNER JOIN status ON transfer.stat_id = status.stat_id INNER JOIN employees ON transfer.emp_id = employees.emp_id WHERE status.stat_status = 4 ORDER BY transfer.t_id DESC";
          }

          
          $query = mysqli_query($conn, $sql);



          while($row = mysqli_fetch_array($query)) {

            $i++;

            $sql_detail = "SELECT * FROM transfer_detail INNER JOIN offices ON transfer_detail.office_id = offices.office_id WHERE t_id = '".$row['t_id']."'";
            $query_detail = mysqli_query($conn, $sql_detail);
            
          
          ?>

          

          <tr class="text-center">
            <td><?= $i; ?></td>
            <td><?= $row['emp_fname']; ?> <?= $row['emp_lname']; ?></td>
            <td>
              <?php if($row['t_type'] == 1) {
                echo 'เบิกวัสดุสำนักงาน';
              } else {
                echo 'นำเข้า';
              } ?>
            </td>
            <td>
              <?php if($row['stat_status'] == 2) {
                echo '<h5><span class="badge bg-success">อนุมัติ</span></h5>';
              } else if($row['stat_status'] == 1) {
                echo '<h5><span class="badge bg-warning">รอการอนุมัติ</span></h5>';
              } else {
                echo '<h5><span class="badge bg-danger">ไม่อนุมัติ</span></h5>';
              } ?>
            </td>
            <td><?= DateThai($row['t_datetime']); ?></td>
            <td>
            <?php 
              if($row['stat_datetime'] == $row['t_datetime']) {
                echo 'ยังไม่ระบุ';
              } else {
                echo DateThai($row['stat_datetime']);
              }
              ?>
            </td>
            
          </tr>
          
          <?php } ?>

          

        </tbody>
     </table>
     <!-- start report  -->
     <?php 
     if(!empty($date_start) && !empty($date_end)) {
      
     
     ?>
      <form action="prepareReport.php" method="POST">
        <input type="hidden" name="date_start" value="<?= $date_start; ?>">        
        <input type="hidden" name="date_end" value="<?= $date_end; ?>">        
        <input type="hidden" name="time_start" value="<?= $time_start; ?>">       
        <input type="hidden" name="time_end" value="<?= $time_end; ?>">       
        <input type="submit" name="report" class="btn btn-success" value="ออกรายงาน">
      </form>
     <?php } ?>
     <!-- end report  -->

     <!-- End List Pending Supllier -->

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

      // hidden table


    })
  </script>

</body>
</html>
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
  <title>ประวัติข้อมูลการเบิกวัสดุสำนักงาน | สํานักงานพัฒนาสังคมและความมั่นคงของมนุษย์ นครราชสีมา</title>

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
      <h2 class="fs-5"> รายละเอียดประวัติข้อมูลการเบิกวัสดุสำนักงาน</h2>
      <hr>

      <!-- start show status  -->
      <?php 
      if(isset($_GET['id'])) {

      $ids = $_GET['id'];
      $status_sql = "SELECT * FROM `transfer` INNER JOIN status ON transfer.stat_id = status.stat_id LEFT JOIN employees ON status.emp_id = employees.emp_id WHERE t_id = $ids";
      $status_query = mysqli_query($conn, $status_sql);
      $status_row = mysqli_fetch_array($status_query);
      ?>
      <h2 class="fs-5 text-center">สถานะ: 
        <?php 
        if($status_row['stat_status'] == 1) {
          echo 'รอการอนุมัติ';
        } else if($status_row['stat_status'] == 2) {
          echo 'อนุมัติ';
        } else {
          echo 'ไม่อนุมัติ';
        }
        ?>
      </h2>
      <?php } ?>
      <h2 class="fs-5 text-center"> 
      <?php 
        if($status_row['emp_id'] == 0) {
          echo 'ผู้รับผิดชอบในการอนุมัติ: ยังไม่ได้ระบุ';
        } else {
          echo 'ผู้รับผิดชอบในการอนุมัติ: ' . $status_row['emp_fname'] . ' ' . $status_row['emp_lname'];
        }
      ?>
      </h2>
      <!-- end show status  -->
      
     <!-- Start List tranfer only Supllier -->
     
     <table class="table" id="myTable">
      <thead>
        <th class="text-center">ลำดับ</th>
        <th class="text-center">รายการวัสดุสำนักงาน</th>
        <th class="text-center">จำนวน</th>
      </thead>
      <tbody>
          <?php 
        if(isset($_GET['id'])) {
          $id = $_GET['id'];
          $sql = "SELECT * FROM transfer_detail INNER JOIN offices ON transfer_detail.office_id = offices.office_id WHERE t_id = $id";
          $query = mysqli_query($conn, $sql);
          $i = 0;
          while($row = mysqli_fetch_array($query)) {
            $i++;
         
        ?>
        <tr>
          <td class="text-center"><?= $i; ?></td>
          <td class="text-center"><?= $row['office_name']; ?></td>
          <td class="text-center"><?= $row['tdel_qty']; ?></td>
        </tr>
        <?php  }
        } ?>
      </tbody>
     </table>
     <div class="container">
      <div class="text-center mt-3">
        <input type="hidden" id="status" value="<?= $status_row['stat_id']; ?>">
        <input type="hidden" id="emp" value="<?= $_SESSION['emp_id']; ?>">
        <?php 
        if($status_row['stat_status'] == 1) {

        
        ?>
        <a href="#" class="btn btn-success" id="accept">อนุมัติ</a>
        <a href="#" class="btn btn-danger" id="reject">ไม่อนุมัติ</a>
        <?php } ?>
        <a href="lists_pending.php" class="btn btn-danger">ย้อนกลับ</a>
      </div>
     </div>
     <!-- End List tranfer only Supllier -->

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

      // start accept
      $('#accept').on('click', function(e) {
        // form input
        const status_id = $('#status').val();
        const status = 2 // 1. Pending 2. Accept 3.Reject
        const emp = $('#emp').val();

        // Event Clicker
        e.preventDefault();

        // Ajax

        Swal.fire({
          title: 'คุณแน่ใจใช่แล้วหรือไม่ ที่ต้องการอนุมัติ?',
          showCancelButton: true,
          confirmButtonText: 'ยืนยัน',
          cancelButtonText: 'ยกเลิก',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
              $.ajax({
                url: 'lists_condition.php',
                method: 'POST',
                data: {
                  id: status_id,
                  status: status,
                  emp_id: emp,
                  accept: 'accept'
                },
                success: function(response) {
                  console.log(response);
                  if(response === 'success') {
                    Swal.fire({
                      icon: 'success',
                      title: 'อนุมัติเรียบร้อยแล้ว',
                      showConfirmButton: false,
                      timer: 1500
                    }).then((result) => {
                      window.location = 'lists_pending.php';
                    })
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'อนุมัติไม่สำเร็จ โปรดลองอีกครั้ง',
                    }).then((result) => {
                      window.location = 'lists_pending.php';
                    })
                  }
                }
              })
              }
            })
      })
      // end accept


      // start reject
      $('#reject').on('click', function(e) {
        // form input
        const status_id = $('#status').val();
        const status = 3 // 1. Pending 2. Accept 3.Reject
        const emp = $('#emp').val();

        // Event Clicker
        e.preventDefault();

        // Ajax

        Swal.fire({
          title: 'คุณแน่ใจใช่แล้วหรือไม่ ที่ต้องการไม่อนุมัติ?',
          showCancelButton: true,
          confirmButtonText: 'ยืนยัน',
          cancelButtonText: 'ยกเลิก',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
              $.ajax({
                url: 'lists_condition.php',
                method: 'POST',
                data: {
                  id: status_id,
                  status: status,
                  emp_id: emp,
                  accept: 'reject'
                },
                success: function(response) {
                  console.log(response);
                  if(response === 'success') {
                    Swal.fire({
                      icon: 'success',
                      title: 'ไม่อนุมัติเรียบร้อยแล้ว',
                      showConfirmButton: false,
                      timer: 1500
                    }).then((result) => {
                      window.location = 'lists_pending.php';
                    })
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'ไม่อนุมัติไม่สำเร็จ โปรดลองอีกครั้ง',
                    }).then((result) => {
                      window.location = 'lists_pending.php';
                    })
                  }
                }
              })
              }
            })
      })
      // end accept

    })
  </script>

</body>
</html>
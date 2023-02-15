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
      <h2 class="fs-5"> รายการนำเข้าวัสดุสำนักงาน</h2>
      <hr>
      <!-- Start Cart Controller  -->
      <?php 
      $p_id = $_GET['p_id']; 
      $act = $_GET['act'];
    
      if($act=='add' && !empty($p_id))
      {
        if(isset($_SESSION['cart'][$p_id]))
        {
          $_SESSION['cart'][$p_id]++;
          // header("Location: listsImport.php");
          echo '<script>window.location.href = "listsImport.php"</script>';
        }
        else
        {
          $_SESSION['cart'][$p_id]=1;
          // header("Location: listsImport.php");
          echo '<script>window.location.href = "listsImport.php"</script>';
        }
      }
    
      if($act=='remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
      {
        unset($_SESSION['cart'][$p_id]);
        // header("Location: listsImport.php");
        echo '<script>window.location.href = "listsImport.php"</script>';
      }
    
      if($act=='update')
      {
        $amount_array = $_POST['amount'];
        foreach($amount_array as $p_id=>$amount)
        {
          $_SESSION['cart'][$p_id]=$amount;
          // header("Location: listsImport.php");
          echo '<script>window.location.href = "listsImport.php"</script>';
        }
      }


      ?>
      <!-- End Cart Controller  -->
      <div class="container">

      
      <form id="frmcart" name="frmcart" method="post" action="?act=update">
        <?php if(!empty($_SESSION['cart'])) { ?>
  <table class="table">
    <thead>
      <tr class="text-center">
        <th>ลำดับ</th>
        <th>ชื่อวัสดุสำนักงาน</th>
        <th>จำนวน</th>
        <th>ลบรายการ</th>
      </tr>
    </thead>
    <?php } ?>
<?php
$total=0;
if(!empty($_SESSION['cart']))
{
  $i = 0;
	foreach($_SESSION['cart'] as $p_id=>$qty)
	{
    $i++;
		$sql = "select * from offices where office_id=$p_id";
		$query = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($query);
		echo "<tr class='text-center'>";
		echo "<td>" . $i . "</td>";
		echo "<td>" . $row["office_name"] . "</td>";
		echo "<td><input type='number' name='amount[$p_id]' value='$qty' size='5' min='1' max='999999'/></td>";
		echo "<td align='center'><a href='lists.php?p_id=$p_id&act=remove' class='btn btn-danger'>ลบรายการ</a></td>";
		echo "</tr>";
	}
} else {
  echo '<h3 class="text-center">ไม่พบรายการ</h3>';
}
?>
<?php 
if(!empty($_SESSION['cart'])) {


?>
<tr>
<td><a href="offices.php" class="btn btn-pmj">กลับหน้ารายการวัสดุสำนักงาน</a></td>
<td colspan="4" align="right">
    <input type="submit" name="button" id="button" class="btn btn-secondary" value="ปรับปรุง" />
    <input type="button" name="Submit2" value="ทำการเบิกวัสดุสำนักงาน" class="btn btn-primary" onclick="window.location='confirmImport.php';" />
</td>
</tr>
</table>
</form>
<?php } ?>
</div>
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
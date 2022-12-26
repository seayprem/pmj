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
</head>
<body>
  
  <div class="main-container d-flex">
    <!-- start navbar  -->
    <div class="sidebar" id="side_nav">
      <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
        <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2"><i
              class="fa-solid fa-car-side"></i></span><span class="text-white">สนง. พมจ.</span></h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i
            class="fa-solid fa-bars-staggered"></i></button>
      </div>

      <ul class="list-unstyled px-2">

        <li class=""><a href="index.php" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-house-chimney"></i>
            หน้าหลัก</a></li>
        <hr class="h-color mx-2">

        <!-- <a class="text-decoration-none px-3 py-2 d-block text-secondary"><small>คลังสินค้า</small></a> -->

        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-boxes-stacked"></i> สินค้าคงเหลือ</a>
        </li>
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-arrow-right-arrow-left"></i> รายการเบิกจ่ายสินค้า</a>
        </li>
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-arrow-right-arrow-left"></i> เพิ่มรายการสินค้า</a>
        </li>
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-arrow-right-arrow-left"></i> พนักงาน</a>
        </li>
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-arrow-right-arrow-left"></i> จัดการรายงาน</a>
        </li>
        <hr class="h-color mx-2">
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-arrow-right-arrow-left"></i> ออกจากระบบ</a>
        </li>
      </ul>
      

    </div>
    <!-- end navbar  -->

    <!-- start content -->
    <div class="content">
      <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">

          <div class="d-flex justify-content-between d-md-none d-block">
            <button class="btn px-1 py-0 open-btn me-2"><i class="fa-solid fa-bars-staggered"></i></button>
            <a class="navbar-brand" href="#"><span class="bg-dark rounded px-2 py-0 text-white">SOK</span></a>
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
      </div>


      <!-- start table transfer  -->
      <div class="dashboard-content px-3 pt-4">
        <h2 class="fs-5"> รายการเดินสินค้าทั้งหมด</h2><br>
        <!-- start table  -->
        <div class="table-responsive">

          <table class="table align-middle table-hover" id="myTable">
            <thead class="table-pmj text-white">
              <tr class="text-center">
                <th>ลำดับ</th>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>ประเภทสินค้า</th>
                <th>จำนวนสินค้า</th>
                <th>ประเภทการทำรายการ</th>
                <th>ชื่อคนทำรายการ</th>
                <th>เวลาทำรายการ</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center">
                <td>1</td>
                <td>P0001</td>
                <td>กระดาษ A4</td>
                <td>กระดาษ</td>
                <td>4</td>
                <td>เบิก</td>
                <td>ข้าวโอ๊ต</td>
                <td>26/12/2565</td>
              </tr>
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

  <script>
    $(document).ready(function() {
      $("#myTable").DataTable();
    });
  </script>

</body>
</html>
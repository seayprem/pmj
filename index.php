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
      <!-- end dashboard content  -->


    </div>

  </div>

</body>
</html>
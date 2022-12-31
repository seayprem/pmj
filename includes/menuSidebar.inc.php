<!-- Start menu for admin  -->
<?php 
      if($_SESSION['emp_level'] == 2) {
        header("Location: admin/index.php");
      }
      ?>
      <!-- end menu for admin  -->


       <!-- Start menu for user  -->
       <?php 
      if($_SESSION['emp_level'] == 1) {

      
      ?>
      <ul class="list-unstyled px-2">

        <!-- <li class=""><a href="index.php" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-house-chimney"></i>
            หน้าหลัก</a></li>
        <hr class="h-color mx-2"> -->

        <!-- <a class="text-decoration-none px-3 py-2 d-block text-secondary"><small>คลังสินค้า</small></a> -->

        <li class=""><a href="index.php" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-boxes-stacked"></i> เพิ่มรายการเบิกสินค้า</a>
        </li>
        <li class=""><a href="history.php" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-arrow-right-arrow-left"></i> รายการเบิกจ่ายสินค้า</a>
        </li>
        <li class=""><a href="index.php" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-arrow-right-arrow-left"></i> สินค้าคงเหลือ</a>
        </li>
        <hr class="h-color mx-2">
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-arrow-right-arrow-left"></i> <?= $_SESSION['emp_fname']; ?>  <?= $_SESSION['emp_lname']; ?></a>
        </li>
        <li class=""><a href="logout.php" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-arrow-right-arrow-left"></i> ออกจากระบบ</a>
        </li>
      </ul>
      <?php } ?>
      <!-- end menu for user  -->
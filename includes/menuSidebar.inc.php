<ul class="list-unstyled px-2">
  <!-- Employees  -->
  <?php 
  if($_SESSION['emp_role'] == 1) {

  
  ?>
  <li class=""><a href="offices.php" class="text-decoration-none px-3 py-2 d-block"> วัสดุสำนักงาน</a>
  </li>
  <li class=""><a href="lists.php" class="text-decoration-none px-3 py-2 d-block"> รายการวัสดุสำนักงาน</a>
  </li>
  <li class=""><a href="history.php" class="text-decoration-none px-3 py-2 d-block"> ประวัติการเบิกวัสดุ</a>
  </li>
  <!-- ADMIN  -->
  <?php } else { ?>
  <li class=""><a href="index.php" class="text-decoration-none px-3 py-2 d-block"> Dashboard</a>
  </li>
  <hr class="h-color mx-2">
  <li class=""><a href="offices.php" class="text-decoration-none px-3 py-2 d-block"> วัสดุสำนักงาน</a>
  </li>
  <li class=""><a href="employees.php" class="text-decoration-none px-3 py-2 d-block"> เจ้าหน้าที่พนักงาน</a>
  </li>
  <li class=""><a href="listsImport.php" class="text-decoration-none px-3 py-2 d-block"> นำเข้าวัสดุสำนักงาน</a>
  </li>
  <li class=""><a href="historyImport.php" class="text-decoration-none px-3 py-2 d-block"> ประวัตินำเข้าวัสดุสำนักงาน</a>
  </li>
  <li class=""><a href="lists_pending.php" class="text-decoration-none px-3 py-2 d-block"> รายการวัสดุที่ยังไม่อนุมัติ</a>
  </li>
  <li class=""><a href="lists_accept.php" class="text-decoration-none px-3 py-2 d-block"> รายการวัสดุที่อนุมัติ</a>
  </li>
  <li class=""><a href="lists_reject.php" class="text-decoration-none px-3 py-2 d-block"> รายการวัสดุที่ปฏิเสธ</a>
  </li>
  <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"> ออกรายงาน</a>
  </li>
  <?php } ?>
  <!-- Logout -->
  <hr class="h-color mx-2">
  <li><a href="#" class="text-decoration-none px-3 py-2 d-block">คุณ <?= $_SESSION['emp_fname']; ?> <?= $_SESSION['emp_lname']; ?></a></li>
  <li class=""><a href="#" id="logout" class="text-decoration-none px-3 py-2 d-block"> ออกจากระบบ</a>
  </li>
</ul>
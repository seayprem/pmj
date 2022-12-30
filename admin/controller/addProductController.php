<?php 
include('../../config/db.php');
// เริ่ม ระบบการเพิ่มสำนักงาน
if(isset($_POST['add'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $qty = $_POST['qty'];
  $category = $_POST['category'];

  // เริ่ม เพิ่มวัสดุสำนักงาน
  $sql = "INSERT INTO `products`(`product_id`, `product_name`, `product_qty`, `cate_id`) VALUES ('$id', '$name', '$qty', $category)";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo "สำเร็จ";
    header("Location: ../index.php");
  } else {
    echo "ล้มเหลว";
  }
  // จบ เพิ่มวัสดุสำนักงาน

}
// จบ ระบบการเพิ่มสำนักงาน

// เริ่ม ระบบอัพเดทสำนักงาน



// จบ ระบบอัพเดทสำนักงาน

?>
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

if(isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $qty = $_POST['qty'];
  $category = $_POST['category'];

  // DEBUG
  echo $id . "<br>";
  echo $name . "<br>";
  echo $qty . "<br>";
  echo $category . "<br>";

  $sql = "UPDATE products SET product_name = '$name', product_qty = '$qty', cate_id = $category WHERE product_id = '$id'";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo "สำเร็จ";
    header("Location: ../index.php");
  } else {
    echo "ล้มเหลว";
  }

}

// จบ ระบบอัพเดทสำนักงาน

// เริ่ม ลบวัสดุสำนักงาน
if(isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql = "DELETE FROM products WHERE product_id = '$id'";
  $query = mysqli_query($conn, $sql);
  if($query) {
    echo "สำเร็จ";
    header("Location: ../index.php");
  } else {
    echo "ล้มเหลว";
  }
}
// จบ ลบวัสดุสำนักงาน

?>
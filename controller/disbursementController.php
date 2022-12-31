<?php 
include('../config/db.php');
if(isset($_POST['export'])) {
  $id = $_POST['id'];
  $emp_id = $_POST['emp_id'];
  $qty = $_POST['qty'];
  $qty_product = $_POST['qty_product'];

  // echo $id . "<br>";
  // echo $emp_id . "<br>";
  // echo $qty . "<br>";
  // echo $qty_product . "<br>";


  if($qty_product < $qty) {
    echo "<script>alert('ไม่สามารถเบิกได้ เนื่องจากจำนวนสินค้าไม่เพียงพอ'); window.location.href = '../index.php';</script>";
  } else {
    $sql = "INSERT INTO transactions (t_qty, product_id, emp_id) VALUES ($qty, '$id', $emp_id)";
    $query = mysqli_query($conn, $sql);
    if($query) {
      $sql_update = "UPDATE products SET product_qty = $qty_product - $qty WHERE product_id = '$id'";
      $query_update = mysqli_query($conn, $sql_update);
      if($query_update) {
        header("Location: ../history.php");
      } else {
        echo "failed";
      }
    }
  }

  

}
?>
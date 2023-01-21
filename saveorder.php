<?php 
session_start();
include('config/db.php');
if(isset($_POST['saveorder'])) {
  $type = $_POST['type'];
  $status = $_POST['status'];
  $emp = $_POST['emp'];

  echo $type . '<br>';
  echo $status . '<br>';
  echo $emp . '<br>';
  
}
?>
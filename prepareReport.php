<?php 
error_reporting(0);
require_once('fpdf/fpdf.php');

$conn = mysqli_connect("localhost", "root", "", "projectpmj");
$conn->set_charset("utf8");

function DateThai($strDate) {
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));
  $strHour= date("H",strtotime($strDate));
  $strMinute= date("i",strtotime($strDate));
  $strSeconds= date("s",strtotime($strDate));
  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear, $strHour:$strMinute";

}

if(isset($_POST['report'])) {
  $date_start = $_POST['date_start'];
  $time_start = $_POST['time_start'];
  $date_end = $_POST['date_end'];
  $time_end = $_POST['time_end'];
} else {
  // header("Location: report.php");
}

// $pdf = new FPDF('L', 'mm', 'A4'); // Change แนวตั้ง L = นอน P = ตั้งละมั้ง ลืมหมดละ ไม่ได้เขียนมา 21 วัน
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

$pdf->PageNo();
$pdf->AliasNbPages(); 
$pdf->AliasNbPages('{totalPages}');

$pdf->AddFont('angsa','','angsa.php');
$pdf->AddFont('angsa','B','angsa.php');
$pdf->AddFont('angsa','L','angsa.php');

$pdf->SetFont('angsa', 'L', 14);

// Header 

$pdf->SetFont('angsa', 'L', 18);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'สํานักงานพัฒนาสังคมและความมั่นคงของมนุษย์ นครราชสีมา'), 0, 1, 'C');
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'รายงานสรุปรายการเบิกวัสดุสำนักงาน'), 0, 1, 'C');
$pdf->SetFont('angsa', '', 14);
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'จากวันที่ '.$date_start.' '.$time_start.' ถึง '.$date_end.' '.$time_end.''), 0, 1, 'R');

// Header Content

$pdf->SetFont('angsa', 'B', 14);
// $pdf->SetFont('angsa','B',14);//กำหนด font angsana ตัวหนา ขนาด 14 
$pdf->Cell(12,10, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 1, 0, 'C');
$pdf->Cell(88,10, iconv('UTF-8', 'TIS-620', 'ชื่อพนักงาน'), 1, 0, 'C');
$pdf->Cell(30,10, iconv('UTF-8', 'TIS-620', 'รายการวัสดุ สนง.'), 1, 0, 'C');
$pdf->Cell(30,10, iconv('UTF-8', 'TIS-620', 'จำนวน'), 1, 0, 'C');
$pdf->Cell(30,10, iconv('UTF-8', 'TIS-620', 'สถานะ'), 1, 0, 'C');
$pdf->Cell(40,10, iconv('UTF-8', 'TIS-620', 'ผู้อนุมัติ'), 1, 0, 'C');
$pdf->Cell(40,10, iconv('UTF-8', 'TIS-620', 'วันเวลา'), 1, 1, 'C');

// Controller Content
if(empty($date_start) && empty($time_start) && empty($date_end) && empty($time_end)) {

} else if(empty($time_start) && empty($time_end)) {
  $sql = "SELECT * FROM `transfer` INNER JOIN status ON transfer.stat_id = status.stat_id INNER JOIN employees ON transfer.emp_id = employees.emp_id WHERE DATE(t_datetime) BETWEEN '$date_start' AND '$date_end'";
} else {
  $sql = "SELECT * FROM `transfer` INNER JOIN status ON transfer.stat_id = status.stat_id INNER JOIN employees ON transfer.emp_id = employees.emp_id WHERE t_datetime BETWEEN '$date_start $time_start' AND '$date_end $time_end'";
}


// Content

$msg = '';
$author = '';

$query = mysqli_query($conn, $sql);
$i = 0;
while($row = mysqli_fetch_array($query)) {

  $ids = $row['t_id'];

  $status_sql = "SELECT * FROM `transfer` INNER JOIN status ON transfer.stat_id = status.stat_id LEFT JOIN employees ON status.emp_id = employees.emp_id WHERE t_id = $ids";
  $status_query = mysqli_query($conn, $status_sql);
  $status_row = mysqli_fetch_array($status_query);

  if($row['stat_status'] == 2) {
    $msg = 'อนุมัติ';
    $author = $status_row['emp_fname'] . ' ' . $status_row['emp_lname'];
  } else if($row['stat_status'] == 1) {
    $msg = 'รอการอนุมัติ';
    $author = '-';
  } else {
    $msg = 'ไม่อนุมัติ';
    $author = $status_row['emp_fname'] . ' ' . $status_row['emp_lname'];
  }

  $i++;


$pdf->SetFont('angsa', '', 14);
$pdf->Cell(12,10, iconv('UTF-8', 'TIS-620', $i), 1, 0, 'C');
$pdf->Cell(88,10, iconv('UTF-8', 'TIS-620', $row['emp_fname'] . ' ' . $row['emp_fname']), 1, 0, 'C');
$pdf->Cell(30,10, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'C');
$pdf->Cell(30,10, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'C');
$pdf->Cell(30,10, iconv('UTF-8', 'TIS-620', $msg), 1, 0, 'C');
$pdf->Cell(40,10, iconv('UTF-8', 'TIS-620', $author), 1, 0, 'C');
$pdf->Cell(40,10, iconv('UTF-8', 'TIS-620', DateThai($row['t_datetime'])), 1, 1, 'C');

$sql_detail = "SELECT * FROM transfer_detail INNER JOIN offices ON transfer_detail.office_id = offices.office_id WHERE t_id = $ids";
  $query_detail = mysqli_query($conn, $sql_detail);
  $i_d = 0;
    while($row_detail = mysqli_fetch_array($query_detail)) {
    $i_id++;
  

  $pdf->SetFont('angsa', '', 14);
  $pdf->Cell(12,10, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'C');
  $pdf->Cell(88,10, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'L');
  $pdf->Cell(30,10, iconv('UTF-8', 'TIS-620', $row_detail['office_name']), 1, 0, 'C');
  $pdf->Cell(30,10, iconv('UTF-8', 'TIS-620', $row_detail['tdel_qty']), 1, 0, 'C');
  $pdf->Cell(30,10, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'C');
  $pdf->Cell(40,10, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'C');
  $pdf->Cell(40,10, iconv('UTF-8', 'TIS-620', ''), 1, 1, 'C');

  }

  // detail transfer
  // $pdf->SetFont('angsa', '', 14);
  // $pdf->Cell(12,10, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'C');
  // $pdf->Cell(88,10, iconv('UTF-8', 'TIS-620', 'รายการวัสดุ'), 1, 0, 'C');
  // $pdf->Cell(60,10, iconv('UTF-8', 'TIS-620', 'จำนวน'), 1, 0, 'C');
  // $pdf->Cell(30,10, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'C');
  // $pdf->Cell(40,10, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'C');
  // $pdf->Cell(40,10, iconv('UTF-8', 'TIS-620', ''), 1, 1, 'C');

  
  
}



// footer content
$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'จำนวนรายการเดินวัสดุสำนักงานทั้งหมด : ' . $i), 0, 1, 'L');


// คงเหลือที่ได้ทำการเบิกแต่ละรายการ
$sql_stock = "SELECT * FROM transfer_detail INNER JOIN offices ON transfer_detail.office_id = offices.office_id WHERE t_id = $ids";
$query_stock = mysqli_query($conn, $sql_stock);
while($row_stock = mysqli_fetch_array($query_stock)) {


$pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', 'รายการสินค้าคงเหลือ ณ ปัจจุบัน: ' . $row_stock['office_name'] . ' จำนวน : ' . number_format($row_stock['office_qty'])), 0, 1, 'L');




}

$datesss = date("Y-m-d_h-i-s-a");

$math_random = "pmj".$datesss.".pdf";

$filename = "report/".$math_random."";

// $pdf->OutPut('F', $filename, true);

$pdf->OutPut();

?>
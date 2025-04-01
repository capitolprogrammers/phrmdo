<?php 
include('../assets/conn/etc.php');
$pid = $_GET["payrollid"];
$timelineArray = array();

$data = get_value("SELECT status, print_date, sum(netpay) from payrolltbl WHERE payroll_id = '$pid'"); 

$timeline = get_array("SELECT status, type, datetime from payrolltimeline WHERE payroll_id = '$pid'");
foreach ($timeline as $key => $v) {
    array_push($timelineArray, array('status'=>$v[0], 'type'=>$v[1], 'datetime'=>$v[2]));
}
echo json_encode(["data" => $data[0], "date"=>$data[1], "total"=>$data[2], "timeline"=>$timelineArray]);
?>
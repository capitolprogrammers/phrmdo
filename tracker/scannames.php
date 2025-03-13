<?php 
include('../assets/conn/etc.php');
$pid = $_GET["payrollid"];

// $items = array(
//     array("id" => 1, "name" => "Item 1", "description" => "Description for Item 1"),
//     array("id" => 2, "name" => "Item 2", "description" => "Description for Item 2"),
//     // Add more items as needed
// );

// // Convert the data to JSON and send it as the response
// header('Content-Type: application/json');
// echo json_encode($items);

$items = array();
$r = get_array("SELECT payroll_id as pid, CONCAT(lname, ', ', fname , ' ', mname) as fullname, print_date, datefrom, dateto, status, gross, netpay from payrolltbl LEFT JOIN employeetbl ON employeetbl.employee_id = payrolltbl.employee_id WHERE print_date is not null and payroll_id = '$pid' ORDER BY payrolltbl.id");
foreach ($r as $key => $v) {
    array_push($items, array(
    	'payrollId' => $v["pid"],
    	'fullName' => $v["fullname"],
    	'printDate' => $v["print_date"],
    	'dateFrom' => $v["datefrom"],
    	'dateTo' => $v["dateto"],
    	'status' => $v["status"],
    	'gross' => $v["gross"],
    	'netpay' => $v["netpay"],
    ));
}
echo json_encode($items);
?>
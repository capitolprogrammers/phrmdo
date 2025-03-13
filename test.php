<?php 
include('assets/conn/etc.php');

// $items = array(
//     array("id" => 1, "name" => "Item 1", "description" => "Description for Item 1"),
//     array("id" => 2, "name" => "Item 2", "description" => "Description for Item 2"),
//     // Add more items as needed
// );

// // Convert the data to JSON and send it as the response
// header('Content-Type: application/json');
// echo json_encode($items);

$items = array();
$r = get_array("SELECT payroll_id, CONCAT(lname, ', ', fname , ' ', mname) as fullname, print_date, datefrom, dateto, status from payrolltbl LEFT JOIN employeetbl ON employeetbl.employee_id = payrolltbl.employee_id GROUP BY payrolltbl.payroll_id LIMIT 100");
foreach ($r as $key => $v) {
    array_push($items, array('payrollId' => $v["payroll_id"],'fullName' => $v["fullname"],'printDate' => $v["print_date"],'dateFrom' => $v["datefrom"],'dateTo' => $v["dateto"],'status' => $v["status"]));
}
echo json_encode($items);
?>
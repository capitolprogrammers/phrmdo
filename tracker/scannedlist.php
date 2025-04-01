<?php 
include('../assets/conn/etc.php');
// $items = array(
//     array("id" => 1, "name" => "Item 1", "description" => "Description for Item 1"),
//     array("id" => 2, "name" => "Item 2", "description" => "Description for Item 2"),
//     // Add more items as needed
// );

// // Convert the data to JSON and send it as the response
// header('Content-Type: application/json');
// echo json_encode($items);

$items = array();
$r = get_array("SELECT 
    payrolltbl.payroll_id AS pid,
    CONCAT(lname, ', ', fname, ' ', mname) AS fullname,
    print_date,
    datefrom,
    dateto,
    payrolltimeline.status,
    (SELECT count(*) from payrolltbl WHERE payroll_id = pid) as cnt
FROM
    payrolltbl
        LEFT JOIN
    employeetbl ON employeetbl.employee_id = payrolltbl.employee_id
    INNER JOIN 
    payrolltimeline ON payrolltimeline.payroll_id = payrolltbl.payroll_id
GROUP BY payrolltbl.payroll_id
ORDER BY CONCAT(lname, ', ', fname, ' ', mname) ASC");
foreach ($r as $key => $v) {
    $status = $v["status"];
    if($v["status"] == null){
        $status = '1';
    }
    array_push($items, array('payrollId' => $v["pid"],'fullName' => $v["fullname"],'printDate' => $v["print_date"],'dateFrom' => $v["datefrom"],'dateTo' => $v["dateto"],'status' => $status ,'cnt' => $v[6]));
}
echo json_encode($items);
?>
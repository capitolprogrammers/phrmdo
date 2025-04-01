<?php
session_start();
include('../../assets/conn/etc.php');
$emp_id = p('id');
$jonum = p('jonum');

$date_from = p('date_from');
$date_to = p('date_to');
$designations = p('designations');
$offices = p('offices');
$jo_remarks = p('jo_remarks');
$days = p('days');

$note = p('note');

//regular days = 1
//sat & holiday = 2
//sat & sun & holiday = 3

$datetime = getdatetime();
$user_id = $_SESSION["user_id"];

saveUserLog($emp_id, "ADDED ON $jonum JO RECORD");

qr("INSERT INTO jonamestbl (jo_number, employee_id, office_id,designation_id,contract_start, contract_end, contract_status, days, date_added, added_by, note) VALUES ('$jonum', '$emp_id', '$offices', '$designations', '$date_from', '$date_to', '$jo_remarks', '$days', '$datetime', '$user_id', '$note')");

?>
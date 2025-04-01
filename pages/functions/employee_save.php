<?php
include('../../assets/conn/etc.php');
//$user_id = $_SESSION["user_id"];

$fname = p("fname");
$mname = p("mname");
$lname = p("lname");
$address = p("address");
$phonenum = p("phonenum");
$gender = p("gender");
$birthday = p("birthday");
$c_o = p("c_o");
$note = p("note");

$check = get_value("SELECT count(*) from employeetbl WHERE fname = '$fname' and mname = '$mname' and lname = '$lname'")[0];
if (empty($check) || $check == 0) {
	// insert record
	qr("INSERT INTO employeetbl (fname, mname, lname, address,gender, bday,phonenum, c_o,note) VALUES ('$fname', '$mname', '$lname', '$address', '$gender', '$birthday', '$phonenum', '$c_o', '$note')");
	
	saveUserLog(null, "SAVED EMPLOYEE RECORD. $fname $mname $lname");
	echo 'SUCCESS: Record Saved';

}
else{
	echo 'ERROR: Duplicate Record';
}
?>
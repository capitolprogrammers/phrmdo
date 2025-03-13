<?php
session_start();
include('../../assets/conn/etc.php');
$user_id = $_SESSION["user_id"];
$jono = p('jono');
$date_from = p('date_from');
$date_to = p('date_to');
$fund_id = p('fund_id');
$program = p('program');
$note = p('jo_note');
$datetime = getdatetime();

$monthno = '';
if (strpos($jono, "January")) {
	$monthno = 1;
}
if (strpos($jono, "February")) {
	$monthno = 2;
}
if (strpos($jono, "March")) {
	$monthno = 3;
}
if (strpos($jono, "April")) {
	$monthno = 4;
}
if (strpos($jono, "May")) {
	$monthno = 5;
}
if (strpos($jono, "June")) {
	$monthno = 6;
}
if (strpos($jono, "July")) {
	$monthno = 7;
}
if (strpos($jono, "August")) {
	$monthno = 8;
}
if (strpos($jono, "September")) {
	$monthno = 9;
}
if (strpos($jono, "October")) {
	$monthno = 10;
}
if (strpos($jono, "November")) {
	$monthno = 11;
}
if (strpos($jono, "December")) {
	$monthno = 12;
}
$r = get_value("SELECT count(*) from jotbl WHERE jo_number = '$jono'")[0];
if ($r == 0) {
	qr("INSERT INTO jotbl (jo_number, fund_id, program_id, note, status, date_added, added_by, monthno) VALUES ('$jono', '$fund_id', '$program', '$note', '1' ,'$datetime', '$user_id', '$monthno')");

	saveUserLog($jono, "SAVED JO RECORD.");
	
	echo 'J.O Saved. Please add employees to this J.O Record.';
}
else{
	echo 'Duplicate JO NUMBER. Please refresh the page and create another J.O record OR add 1 on J.O Number example JO #: 1113, new JO #: 1114';
}

?>
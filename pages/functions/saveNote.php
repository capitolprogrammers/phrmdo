<?php
include('../../assets/conn/etc.php');
$joid = p('joid');
$note = p('note');
$print_note = p('print_note');
$co_note = p('co_note');
$datenow = getdatetime();
$r = get_value("SELECT note, printing_note, co_note from jonotestbl WHERE jo_number = '$joid'");


if (empty($r)) {
	saveUserLog($joid, "ADDED NOTE ON JO RECORD $note, $print_note, $co_note");
	qr("INSERT INTO jonotestbl (jo_number, note, printing_note, date_saved, co_note) VALUES ('$joid', '$note', '$print_note', '$datenow', '$co_note')");
}
else{
	saveUserLog($joid, "UPDATED NOTE FROM $r[0], $r[1], $r[2] TO $note, $print_note, $co_note");
	qr("UPDATE jonotestbl SET note = '$note', date_saved = '$datenow', printing_note = '$print_note', co_note = '$co_note' WHERE jo_number = '$joid'");
}

?>
<?php
include('../../assets/conn/etc.php');
$id = p("id");
saveUserLog($id, "UPDATED EMPLOYEE DATA");

$fnameEdit = p('fnameEdit');
$mnameEdit = p('mnameEdit');
$lnameEdit = p('lnameEdit');
$addressEdit = p('addressEdit');
$phonenumEdit = p('phonenumEdit');
$birthdayEdit = p('birthdayEdit');
$genderEdit = p('genderEdit');
$c_oEdit = p('c_oEdit');
$noteEdit = p('noteEdit');


qr("UPDATE employeetbl SET fname = '$fnameEdit', mname = '$mnameEdit', lname = '$lnameEdit', address = '$addressEdit', gender = '$genderEdit', bday = '$birthdayEdit', phonenum = '$phonenumEdit', c_o = '$c_oEdit', note = '$noteEdit' WHERE employee_id = '$id'");
?>
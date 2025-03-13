<?php
session_start();
include('../../assets/conn/etc.php');

$r = get_value("SELECT count(*) from jotbl  INNER JOIN jonotestbl ON jotbl.jo_number = jonotestbl.jo_number WHERE status = 1 and jonotestbl.note like '%REVIEWED%'");
if ($r[0] != 0) {
	echo  $r[0];
}
?>
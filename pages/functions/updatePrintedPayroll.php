<?php
include('../../assets/conn/etc.php');
$id = $_POST["id"];
$datefrom= $_POST["datefrom"];
$dateto= $_POST["dateto"];
$workdays= $_POST["workdays"];
$undertime= $_POST["undertime"];
$pagibig= $_POST["pagibig"];
$sss= $_POST["sss"];
$gross= $_POST["gross"];
$netpay= $_POST["netpay"];

qr("UPDATE payrolltbl SET workdays = '$workdays', undertime = '$undertime', pagibig = '$pagibig', sss = '$sss', gross = '$gross', netpay='$netpay', datefrom = '$datefrom', dateto = '$dateto' WHERE id = '$id'");
?>	
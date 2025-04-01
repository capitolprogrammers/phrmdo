<?php
include('../../assets/conn/etc.php');
$joid = p('joid');

saveUserLog($joid, "TAGGED AS FOR REVIEW.");
qr("UPDATE jotbl set review = '1' WHERE jo_number = '$joid'");
?>
<!-- ALTER TABLE `jorecdbb`.`jotbl` 
ADD COLUMN `review` VARCHAR(45) NULL AFTER `added_by`;
 -->
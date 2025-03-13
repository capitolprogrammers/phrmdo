<?php 
include('../../assets/conn/etc.php');
session_start();
session_destroy();
redirect('../../', 0);
?>
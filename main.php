<?php 
include('header.php');
$page = $_GET["page"];
?>
<div class="content-wrapper">
  <!-- start content -->
  <?php 
  if ($userType == 'admin' && $page == "") {
   $page = "main";
 }
 else if($userType == 'jo' && $page == ""){
   $page = "records";
 }
 else if($userType == 'payroll' && $page == ""){
   $page = "create_payroll";
 }
 else if($userType == 'findes' && $page == ""){
   $page = "payroll_records";
 }
 
 else if($userType == 'payroll_records' && $page == ""){
   $page = "payroll_records";
 }
 else if($userType == 'jo_records' && $page == ""){
   $page = "jo_records_all";
 }

 switch ($page) {

  case 'main':
  include('pages/records/dashboard.php');
  break;

  case 'records':
  include('pages/records/employees.php');
  break;

  case 'create_jos':
  include('pages/records/create_jo.php');
  break;

  case 'showjos':
  include('pages/records/showjos.php');
  break;

  case 'create_payroll':
  include('pages/payroll/createPayroll.php');
  break;

  case 'offices':
  include('pages/records/offices.php');
  break;

  case 'designations':
  include('pages/records/designations.php');
  break;

  case 'programs':
  include('pages/records/programs.php');
  break;

  case 'holidays':
  include('pages/records/holidays.php');
  break;

  case 'fundings':
  include('pages/records/fundings.php');
  break;

  case 'users':
  include('pages/records/users.php');
  break;

  case 'payroll_records':
  include('pages/records/payroll_records.php');
  break;
  

  case 'jo_records_all':
  include('pages/records/searchJO.php');
  break;

  case 'reports':
    include('pages/records/reports.php');
    break;
  




  default:
  //echo '<script> location.replace("pages/samples/error-404.html"); </script>';
  exit();
  break;
}
?>
<!-- end content -->
</div>
<?php 
// offices
// designations
// programs
// holidays
include('footer.php');
?>
<?php 
include('../../assets/conn/etc.php');
session_start();
$user_id = $_SESSION['user_id'];
$for_printing = get_array("SELECT * from payrolltbl WHERE status is null AND user_id = '$user_id'");
?>
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Fullname</th>
      <th>Designation</th>
      <th>Gross</th>
      <th>Netpay</th>
      <th>Payroll Date</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $num = 1;
    foreach ($for_printing as $key => $fp) {
      $employee_id = $fp["employee_id"];
      $jo_id = $fp["jo_id"];
      $fullname = get_value("SELECT CONCAT(lname, ', ', fname, ' ', mname) as fullname from employeetbl WHERE employee_id = '$employee_id'")[0];
      $designation = get_value("SELECT designation_name from designationtbl INNER JOIN jonamestbl ON jonamestbl.designation_id = designationtbl.designation_id WHERE  jonamestbl.id = '$jo_id'")[0];

      $datea = date_create($fp["datefrom"]);
      $dateb = date_create($fp["dateto"]);
      
      $datefrom = date_format($datea, 'M j');
      $dateto = date_format($dateb, 'M j');
      ?>
      <tr onclick="delete_payroll('<?php echo $fp[0]; ?>')">
        <td><?php echo $num; ?></td>
        <td><?php echo $fullname ?></td>
        <td><?php echo $designation ?></td>
        <td><?php echo $fp["gross"] ?></td>
        <td><?php echo $fp["netpay"] ?></td>
        <td><?php echo $datefrom ?> - <?php echo $dateto ?></td>
      </tr>
      <?php
      $num++;
    }
    ?>
  </tbody>
</table>
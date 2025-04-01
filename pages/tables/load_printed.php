<?php 
session_start();
include('../../assets/conn/etc.php');
$user_id = $_SESSION["user_id"];

$name = '';
$from = '';
$from_end = '';
$to = '';
$to_end = '';
$dateqr = '';

if(isset($_POST["name"])){
  $name = $_POST["name"];
}

if(isset($_POST["from"])){
  $from = $_POST["from"];
  
  if ($from != "") {
    $from_arr = explode("-", $from);
    $from_end = $from_arr[0] . '-' . $from_arr[1] . '-' . '31';
  }

}

if(isset($_POST["to"])){
  $to = $_POST["to"];
  if ($to != "") {
    $to_arr = explode("-", $to);
    $to_end = $to_arr[0] . '-' . $to_arr[1] . '-' . '31';
  }
}
if ($from != "" && $to != "") {
  $dateqr = " AND datefrom between '$from' and '$from_end' AND dateto between '$to' and '$to_end'";
}

echo "Filters: <br>" . 'Name : ' . $name . '<br>';
echo 'From : ' . $from . ' to ' . $from_end . '<br>';
echo 'To : ' . $to . ' to ' . $to_end . '<hr>';

// echo "SELECT 
//   payroll_id,
//   fname,
//   mname,
//   lname,
//   designation_name,
//   netpay,
//   jo_number,
//   datefrom,
//   dateto,
//   print_date,
//   payrolltbl.id,
//   users.username,
//   payrolltbl.status as status
//   FROM
//   payrolltbl
//   INNER JOIN
//   jonamestbl ON jonamestbl.id = payrolltbl.jo_id
//   INNER JOIN
//   employeetbl ON employeetbl.employee_id = payrolltbl.employee_id
//   INNER JOIN
//   designationtbl ON designationtbl.designation_id = jonamestbl.designation_id
//   INNER JOIN 
//   users ON users.id = payrolltbl.user_id
//   WHERE status is not null AND fname like '%$name%' AND lname like '%$name%'AND mname like '%$name%'" .  $dateqr;

$payroll = get_array("SELECT 
  payroll_id,
  fname,
  mname,
  lname,
  designation_name,
  netpay,
  jo_number,
  datefrom,
  dateto,
  print_date,
  payrolltbl.id,
  users.username,
  payrolltbl.status as status
  FROM
  payrolltbl
  INNER JOIN
  jonamestbl ON jonamestbl.id = payrolltbl.jo_id
  INNER JOIN
  employeetbl ON employeetbl.employee_id = payrolltbl.employee_id
  INNER JOIN
  designationtbl ON designationtbl.designation_id = jonamestbl.designation_id
  INNER JOIN 
  users ON users.id = payrolltbl.user_id
  WHERE payrolltbl.status is not null AND (fname like '%$name%' OR CONCAT(lname, ' ', fname, ' ', mname) like '%$name%' OR CONCAT(fname, ' ', lname) like '%$name%') $dateqr");
  ?>
  <table class="table table-bordered table-condensed table-hover" id="printed_payroll">
    <thead>
      <th>#</th>
      <th>Fullname</th>
      <th>Designation</th>
      <th>Payroll Date</th>
      <th>Netpay</th>
      <th>Status</th>
      <!-- <th>Action</th> -->
      <th style="display: none;">from</th>
      <th style="display: none;">to</th>
      <th style="display: none;">payroll_id</th>

      <th>Recorded By</th>
    </thead>
    <tbody>
      <?php
      $num=1;
      foreach ($payroll as $key => $p) {
          
       $payroll_id = $p[0];
       $id = $p["id"];
    
       
       $newstats = 'Unknown';
       
       $timeline = get_value("SELECT * from payrolltimeline WHERE payroll_id = '$payroll_id' ORDER BY id desc");

if(!empty($timeline)){
       switch ($timeline[2]) {
         case '1':
         $newstats = 'HR';
         break;

         case '2':
         $newstats = 'Budget';
         break;

         case '3':
         $newstats = 'Accounting';
         break;

         case '4':
         $newstats = 'PTO';
         break;

         case '5':
         $newstats = 'GO';
         break;

         case '6':
         $newstats = 'PA';
         break;

         case '7':
         $newstats = 'HR Register';
         break;

         case '8':
         $newstats = 'PTO(ADA)';
         break;

         default:
         $newstats = '0';
         break;
       }
}

       ?>
       <tr data-toggle="tooltip" title="PRINT DATE: <?php echo $p['print_date'] ?>" onclick="viewPrinted('<?php echo $payroll_id; ?>', '<?php echo $id; ?>')">
         <td><?php echo $num; ?></td>
         <td><?php echo $p["lname"] . ', ' . $p["fname"] . ' ' . $p['mname']; ?></td>
         <td><?php echo $p["designation_name"] ?></td>
         <td><?php echo formatdate($p["datefrom"], 0) . ' - ' . formatdate($p["dateto"], 1); ?></td>
         <td><?php echo number_format($p["netpay"], 2); ?></td>
         <td><div class="badge badge-primary badge-pill" data-toggle="tooltip" title="<?php echo $timeline[3] . " " . $timeline[4]?>"><?php echo $newstats; ?></div></td>
        <!--  <td><button class="btn btn-primary btn-sm mr-1" onclick="view('<?php echo $payroll_id . $p["print_date"] ?>');"><i class="fa fa-eye"></i> VIEW</button><button class="btn btn-info btn-sm" onclick="reprint('<?php echo $payroll_id ?>');"><i class="fa fa-print"></i> REPRINT PAYROLL</button>
          <button class="btn btn-warning btn-sm" onclick="reprint_individual('<?php echo $id ?>');"><i class="fa fa-print"></i> REPRINT(INDIVIDUAL)</button>
        </td> -->
        <td style="display:none"><?php echo $p["datefrom"] ?></td>
        <td style="display:none"><?php echo $p["dateto"] ?></td>
        <td style="display:none"><?php echo $payroll_id . $p["print_date"] ?><br><small><?php echo $p["username"] ?></small></td>
        <td><?php echo $p["username"] ?></td>
      </tr>
      <?php
      $num++;
    }
    ?>
  </tbody>
</table>
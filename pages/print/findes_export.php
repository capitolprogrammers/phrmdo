<?php
include('../../assets/conn/etc.php');
include('../../phpqrcode/qrlib.php'); 

session_start();
$user_id = $_SESSION["user_id"];
$payroll_id = $_GET["payroll_id"];
$tempDir = "../../qr/"; 

$pid = $_GET["payroll_id"];

$codeContents = $pid;

    // we need to generate filename somehow,  
    // with md5 or with database ID used to obtains $codeContents... 
$fileName = $pid . '.png'; 

$pngAbsoluteFilePath = $tempDir.$fileName; 

    // generating 
if (!file_exists($pngAbsoluteFilePath)) { 
	QRcode::png($codeContents, $pngAbsoluteFilePath); 

} else { 

} 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PAYROLL_PRINT</title>
	<!-- Bootstrap CSS (required for Material Design Bootstrap) -->
	<!-- Material Design Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap@4.19.1/dist/css/mdb.min.css" integrity="sha384-p5z5DjkbGSMrAbMHrQ56U1RimAZD0o9xEpjfCcYIVaETqI6UWlBN0kg23NYj1Q2v" crossorigin="anonymous">

	<!-- Bootstrap CSS (required for Material Design Bootstrap) -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-5+5z5K2/JmF43bGhKOLfOuqxW2QXsh4/z4vgMxKt8GVcsWJL/HtS0PpZqg3o0hWocTNYTmcC1ivCNQv7zR78Ww==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Material Design Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/mdbootstrap@4.19.1/dist/js/mdb.min.js" integrity="sha384-xT04TjjJv25NQsN8Rd7LHeJnx+aGv1Qf0J8F9+rlI00Gvy+aHq6xopzJhLyUg/+K" crossorigin="anonymous"></script>

	<!-- jQuery (required for Material Design Bootstrap JS) -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<!-- Popper.js (required for Material Design Bootstrap JS) -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmIzN+OvGpXpN0etV4Q6" crossorigin="anonymous"></script>

	<!-- Bootstrap JS (required for Material Design Bootstrap JS) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-dh4E4uzikDvM8+MyZsiJGdss1OO02B6vG8LamWclR/HjJbjyKr9gZ+8SEZcxE6C2qPGU3zPv5m5J5I1+Qd5q3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


	<!-- Font Awesome -->
	<link
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
	rel="stylesheet"
	/>
	<!-- Google Fonts -->
	<link
	href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
	rel="stylesheet"
	/>
	<!-- MDB -->
	<link
	href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
	rel="stylesheet"
	/>

	<style type="text/css">

@media print 
{
	@page
	{
		size: legal;
		size: landscape;
		margin: 20px;
	}
}
</style>
</head>
<body>
<!-- <h1 class="text-center">PROVINCIAL GOVERNMENT OF CATANDUANES <br>
	GENERAL FUND <br><small>DAILY WAGE PAYROLL</small></h1> -->


	<div class="main main-border">
		<div class="container-fluid">
			<div class="row">

				<div class="col-lg-10 col-sm-10 col-md-10 col-xl-10 col-xxl-10">
					<div class="row">
						<div class="col-lg-12 col-sm-12 col-md-12 col-xl-12 col-xxl-12 x" style="padding:0px!important;height: 600px;">
							<!-- table -->
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>NAMES</th>
										<th>NETPAY</th>
									</tr>
								</thead>
								<tbody>
									<?php 
					    $r= get_array("SELECT employee_id, SUM(netpay) as net from payrolltbl WHERE payroll_id = '$payroll_id' GROUP BY employee_id");
					    foreach($r as $row){
					        	$data = get_value("SELECT CONCAT(lname, ', ', fname) as fullname, mname from employeetbl WHERE employee_id = '$row[0]'");
					        		
										if ($data[1] == null) {
											$minitial = "";
										}
										else{

											$minitial = $data[1] . '.';
										}
					        		$new_name = $data[0] . ' ' . str_replace(". .", ".", str_replace("..",".",$minitial));
					        ?>
					        <tr>
					            <td><?php echo strtoupper($new_name);?></td>
					            <td><?php echo  number_format($row["net"],2, '.', ''); ?></td>
					        </tr>
					        <?php
					    }
					?>
							</tbody>
						</table>
						<!-- end table -->
					</div>
					<!-- <div class="col-lg-12 x">SUBTOTAL</div> -->
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
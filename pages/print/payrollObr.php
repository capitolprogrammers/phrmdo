<?php
include('../../assets/conn/etc.php');
session_start();
$user_id = $_SESSION["user_id"];
$certifier = $_GET["certifier"];
$pos = $_GET["pos"];
$print_office = $_GET["print_office"];
$address = $_GET["address"];
$res_center = $_GET["responsibility_center"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>OBR_PRINT</title>
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
		.row{
/*			border: solid black .5px;*/
padding:0px;
}
.main-border{
	border: solid 1px;

}
.obr-header{
	font-size: 50px;
	font-weight: 500;
	text-align: center;
}
.virac-catanduanes{
	font-size: 40px;
	text-align: center;
}
.x{
	border: solid 1px black;
}
.f{
	font-size: 30px;
}
table.table-bordered,
.table-bordered th,
.table-bordered td {
	border-width: .5px;
}

/* Optional: Set the border style and color */
table.table-bordered,
.table-bordered th,
.table-bordered td {
	border-style: solid;
	border-color: black;
	padding: 5px;
	font-size: 30px;
	text-align: center;
}
.box{
	border: solid black .5px;
	min-width: 40px;
	min-height: 40px;
	width:40px;
	float: left;
	margin-right: 5px;
}
.box-name{
	font-size: 20px;
}
.letter{
	font-size: 30px;
	font-weight: 600;
	margin-bottom: 15px;
}
.letter-name{
	font-size: 30px;
	margin-top:10px;
	font-weight: 800;
	margin-bottom: 15px;
}
.signature, .printed-name, .position{
	font-size: 20px;
	padding:20px;
}
.head-name{
	padding:20px;
	font-size: 30px;
	font-weight: 700;
	text-align: center;
	margin-top:60px;

}
.head-pos{
	text-align: center;
	font-size: 20px;
	font-weight: 500;
	margin-bottom: 6px;
}
.head-description{
	text-align: center;
	font-size: 20px;
}
.payroll_date{
	font-size: 30px;
	text-align: center;
	margin:20px;
	font-weight: 600;
}
.total{
	padding: 20px;
	margin-top:30px;
	font-weight: 600;
}
.total_netpay{
	font-weight: 600;
}
.res_center{
	font-size: 30px;
	margin-top: 50px;
}

</style>
</head>
<body>
	<div class="main main-border" style="margin-top:80px">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-xl-12">
					<div class="obr-header">PROVINCIAL GOVERNMENT OF CATANDUANES</div>
					<div class="virac-catanduanes">Virac, Catanduanes</div>
				</div>
				<div class="col-lg-8 x text-center f  col-md-8">OBLIGATION REQUEST</div>
				<div class="col-lg-4 x f  col-md-4">NO</div>
				<div class="col-lg-4 x f  col-md-4">Payee</div>

				<?php 
				//getpayee
				$payee = get_value("SELECT CONCAT(lname, ', ', fname, ' ', mname) as fullname, jo_id from payrolltbl INNER JOIN employeetbl ON employeetbl.employee_id = payrolltbl.employee_id WHERE payrolltbl.status is null and user_id = '$user_id' ORDER BY payrolltbl.id ASC LIMIT 1");
				$jo_id = $payee[1];

				$acctcode = get_array("SELECT 
					acct_code, SUM(netpay + sss) as np
					FROM
					payrolltbl
					INNER JOIN
					jonamestbl ON jonamestbl.id = payrolltbl.jo_id
					INNER JOIN
					jotbl ON jotbl.jo_number = jonamestbl.jo_number
					WHERE
					payrolltbl.status IS NULL AND user_id = '$user_id'
					GROUP BY acct_code ORDER BY datefrom");


				
				$cnt = get_array("SELECT DISTINCT(employee_id) from payrolltbl WHERE status is null and user_id = '$user_id'");

				//$resCenter = get_value("SELECT ");

				$et_al = '';
				if (count($cnt) > 1) {
					$et_al = ' et al.';
				}
				?>
				<div class="col-lg-8 x f col-md-8"><?php echo str_replace("N/A","",$payee[0]); ?><?php echo $et_al ?></div>
				<div class="col-lg-4 x f col-md-4">Office</div>
				<div class="col-lg-8 x f col-md-8"><?php 
				// $jo_office = get_value("SELECT office_name from officetbl INNER JOIN jotbl ON jotbl.office_id = officetbl.office_id WHERE jo_id = '$jo_id'");
				// echo $jo_office[0];
				echo $print_office;
			?></div>
			<div class="col-lg-4 x f  col-md-4">Address</div>
			<div class="col-lg-8 x f  col-md-8"><?php echo $address ?></div>
		</div>
		<div class="row">
			<div class="col-lg-12  col-md-12" style="padding:0px">
				<table class="table table-bordered">
					<thead>
						<th width="200px">Responsibility Center</th>
						<th width="200px">Particular</th>
						<th width="100px">PPA</th>
						<th width="150px">Account Code</th>
						<th width="150px"></th>
					</thead>
					<tbody>
						<tr  style="height: 800px;">
							<td style="padding-top:5%">
								<div class="res_center">
									<?php echo $res_center ?>
								</div>
							</td>
							<td style="padding-top:5%">
								<div class="res_center">
									Wages for the month of 
								</div>
								<?php 
								$dates = get_array("SELECT datefrom,dateto from payrolltbl WHERE status is null  and user_id = '$user_id' GROUP BY datefrom ORDER BY datefrom");
								foreach ($dates as $key => $value) {
									$datea = date_create($value["datefrom"]);
									$dateb = date_create($value["dateto"]);

									$datefrom = date_format($datea, 'F j');
									$dateto = date_format($dateb, 'j');

									$year = date_format($datea, 'Y');
									?>
									<div class="payroll_date"><?php echo $datefrom . ' - ' . $dateto . ', ' . $year; ?></div>
									<?php
								}
								?>
							</td>
							<td></td>
							<td style="padding-top:5%">
								<div class="res_center" style="margin-top:15px">
									&nbsp
								</div>
								<div class="res_center">
									<?php 
									foreach ($acctcode as $key => $v) {
										echo $v[0] . '<br>';
									}
									?>
								</div>
							</td>
							<td style="padding-top:5%">
								<div class="res_center" style="margin-top:15px">
									&nbsp
								</div>
								<div class="total">
									<?php 
									$total_netpay = 0;
									$totalSSS = 0;
									$list = get_array("SELECT *  from payrolltbl WHERE status is null and user_id = '$user_id' ORDER BY employee_id");
									foreach ($list as $key => $emp) {
										$totalSSS = $totalSSS + $emp["sss"];
										$total_netpay = $total_netpay + number_format($emp["netpay"], 2, '.', '');
									}
									foreach ($acctcode as $key => $v) {
										echo number_format($v[1], 2, '.', '') . '<br>';
									}
									?>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="4">TOTAL</td>
							<td><div class="total_netpay">
								<?php 
								$finalNetpay = $total_netpay + $totalSSS;
								echo number_format($finalNetpay, 2); 
								?>
							</div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-lg-6 mb-2 col-md-6">
				<!-- certified -->
				<div class="letter">A <span class="letter-name">CERTIFIED</span></div>
				<div class="box mt-1"></div><div class="box-name  mt-1">Charges to appropriate/allotment necessary, lawful and under my direct supervision</div>
				<br>  
				<div class="box mt-1"></div><div class="box-name  mt-1">Supporting document valid, proper and legal</div>
			</div>
			<div class="col-lg-6  col-md-6" style="border-left:solid 1px black">
				<!-- b certified -->
				<div class="letter">B <span class="letter-name">CERTIFIED</span></div>

				<div class="box"></div><div class="box-name">Allotment available and obligated for the purpose as indicated above.</div>
			</div>
			<div class="col-lg-12 x col-md-12">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="row">
							<div class="col-lg-4 col-md-4">
								<div class="row">
									<div class="col-lg-12 x f col-md-12">
										<div class="signature">
											Signature
										</div>
									</div>
									<div class="col-lg-12 x f col-md-12">
										<div class="printed-name">
											Printed Name
										</div>
									</div>
									<div class="col-lg-12 x f col-md-12">
										<div class="position">
											Position
										</div>
									</div>
									<div class="col-lg-12 x f col-md-12">
										<div class="position">
											Date
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-8 x col-md-8">
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<div class="head-name">
											<?php echo $certifier ?>
										</div>
										<div class="head-pos">
											<?php echo $pos ?>
										</div>
									</div>
									<div class="col-lg-12 x col-md-12">
										<div class="head-description">Head Requesting Office/Authorized Representative</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-6 col-md-6">
						<div class="row">
							<div class="col-lg-4 col-md-4">
								<div class="row">
									<div class="col-lg-12 x f col-md-12">
										<div class="signature">
											Signature
										</div>
									</div>
									<div class="col-lg-12 x f col-md-12">
										<div class="printed-name">
											Printed Name
										</div>
									</div>
									<div class="col-lg-12 x f col-md-12">
										<div class="position">
											Position
										</div>
									</div>
									<div class="col-lg-12 x f col-md-12">
										<div class="position">
											Date
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-8 x col-md-8">
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<div class="head-name">
											NEÑA V. GUERRERO
										</div>
										<div class="head-pos">
											Provincial Budget Officer
										</div>
									</div>
									<div class="col-lg-12 x col-md-12">
										<div class="head-description">Head Requesting Office/Authorized Representative</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>

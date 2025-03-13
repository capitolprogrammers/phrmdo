<?php 
session_start();
include('../../assets/conn/etc.php');
$id = p("id");
$user_id = $_SESSION["user_id"];
$info = get_value("SELECT * from employeetbl WHERE employee_id = '$id'");

$payroll_id = '';
$p_id = get_value("SELECT payroll_id from payrolltbl WHERE status is null and user_id = '$user_id'")[0];
if (!empty($p_id)) {
	$payroll_id = $p_id;
}
else{
	$payroll_id = md5(uniqid());
}

$sss = get_value("SELECT monthlyContribution from employeedata WHERE employee_id = '$id'")[0];
$mcontribution = 0;
if ($sss != "") {
	$mcontribution = $sss;
}


//echo $payroll_id;
$jos = get_array("SELECT jotbl.jo_number, id from jonamestbl INNER JOIN jotbl ON jotbl.jo_number = jonamestbl.jo_number WHERE employee_id = '$id' and jonamestbl.jo_status = 6 ORDER BY id DESC");
?>
<div class="card">
	<h5 class="card-header">
		<?php echo $info["lname"] . ', ' . $info["fname"] . ' ' . $info['mname'] ?><br><small><?php echo $info["address"] ?></small>
	</h5>
	<div class="card-body">
		<div class="row">

			<div class="col-lg-12 mb-2">
				<div class="form-group">
					<label for="jo_list">Contract:</label>
					<select class="form-control" id="jo_list" onchange="get_rate_payroll()">
						<option rate="" selected>SELECT J.O</option>
						<?php 
						foreach ($jos as $key => $jo) {
							$jono = $jo[0];
							$get_rate = get_value("SELECT rate from designationtbl INNER JOIN jonamestbl ON jonamestbl.designation_id = designationtbl.designation_id WHERE jonamestbl.jo_number = '$jono' and employee_id = '$id'");
							?>
							<option rate="<?php echo $get_rate[0] ?>" jono="<?php echo $jo[1] ?>" payrollid="<?php echo $payroll_id ?>"><?php echo $jo[0] ?></option>
							<?php
						}
						?>
					</select>
				</div> 
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label for="date_from">From:</label>
					<input type="date" class="form-control form-control-lg" id="date_from" value="<?php echo $datelastmonth; ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label for="date_to">To:</label>
					<input type="date" class="form-control form-control-lg" id="date_to" value="<?php echo $lastMonth20th ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label for="workday">Workday:</label>
					<input type="number" class="form-control form-control-lg" id="workday" onkeyup="get_gross()">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label for="rate">Rate:</label>
					<input type="number" class="form-control form-control-lg" id="rate" >
				</div>
			</div>
			<div class="col-lg-6">	
				<div class="form-group">
					<label for="undertime">Undertime:</label>
					<input type="number" class="form-control form-control-lg" id="undertime" onkeyup="get_deduction()">
				</div>
			</div>
			<div class="col-lg-6">	
				<div class="form-group">
					<label for="deduction">Deduction:</label>
					<input type="number" class="form-control form-control-lg" id="deduction" >
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label for="pagibig">Pag-ibig:</label>
					<input type="number" class="form-control form-control-lg" id="pagibig" onkeyup="get_gross()" value="0" >
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label for="sss">SSS:</label>
					<input type="text" class="form-control form-control-lg" id="sss" onkeyup="get_gross()" value="<?php echo $mcontribution ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label for="gross">Gross:</label>
					<input type="number" class="form-control form-control-lg" id="gross">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label for="total">Total:</label>
					<input type="number" class="form-control form-control-lg" id="total" >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">	
				<button class="btn btn-block btn-lg btn-success mt-1" onclick="savePayroll('<?php echo $id ?>')">SAVE</button>
			</div>
		</div>
	</div>
</div>

<?php 
include('../../assets/conn/etc.php');
$pid = $_POST["id"];

$r = get_value("SELECT * from payrolltbl WHERE id = '$pid'");
$emp_id = $r["employee_id"];

?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				<?php echo getData($emp_id, 'name'); ?><br>
				<small>Edit Printed Payroll</small>
			</h5>
			<div class="card-body">
				<form id="myForm" class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label>FROM</label>
							<input type="date" class="form-control" name="datefrom" id="datefrom" value="<?php echo $r["datefrom"] ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>TO</label>
							<input type="date" class="form-control" name="dateto"  id="dateto" value="<?php echo $r["dateto"] ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>WORKDAYS</label>
							<input type="text" class="form-control" name="workdays"  id="workdays"value="<?php echo $r["workdays"] ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>UNDERTIME</label>
							<input type="text" class="form-control" name="undertime"  id="undertime"value="<?php echo $r["undertime"] ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>PAGIBIG</label>
							<input type="text" class="form-control" name="pagibig"  id="pagibig"value="<?php echo $r["pagibig"] ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>SSS</label>
							<input type="text" class="form-control" name="sss"  id="sss"value="<?php echo $r["sss"] ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>GROSS</label>
							<input type="text" class="form-control" name="gross"  id="gross"value="<?php echo $r["gross"] ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>NETPAY</label>
							<input type="text" class="form-control" name="netpay" id="netpay"value="<?php echo $r["netpay"] ?>">
						</div>
					</div>
					<button type="button" class="btn btn-info btn-block" name="updatePrintedPayroll" id="updatePrintedPayroll" onclick="updateprinted('<?php echo $pid ?>')">UPDATE</button>
				</form>
			</div>
		</div>
	</div>
</div>
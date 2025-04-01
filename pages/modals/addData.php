<?php 
include('../../assets/conn/etc.php');
$employeeid = p('employeeid');
$r = get_value("SELECT * from employeedata WHERE employee_id = '$employeeid'");
$SSSNumber = 0;
$bankName = null;
$acctNumber = null;
$MonthlyContribution = null;
$remarks = null;
if(!empty($r)){
	$SSSNumber = $r["SSSNumber"];
	$bankName = $r["bankName"];
	$acctNumber = $r["acctNumber"];
	$MonthlyContribution = $r["monthlyContribution"];
	$remarks = $r["remarks"];
}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				<?php echo getData($employeeid, 'name'); ?><br>
				<small>Add Data</small>
			</h5>
			<div class="card-body">
				<div class="form-group">
				    <label for="SSSNumber">SSS Number</label>
					<input type="text" class="form-control" name="SSSNumber" id="SSSNumber" placeholder="SSS Number" value="<?php echo $SSSNumber; ?>">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="MonthlyContribution" id="MonthlyContribution" placeholder="Monthly Contribution" value="<?php echo $MonthlyContribution; ?>">
				</div>
				<div class="form-group">
					<select class="form-control" id="bankName">
						<?php 
						if ($bankName != "") {
							?>
							<option><?php echo $bankName ?></option>
							<?php
						}
						?>
						<option>-None-</option>
						<option>LBP</option>
						<option>DBP</option>
					</select>
				</div>

				<div class="form-group">
					<input type="text" class="form-control" name="accctNumber" id="acctNumber" placeholder="Account Number" value="<?php echo $acctNumber; ?>">				
				</div>
				<div class="form-group">
					<textarea class="form-control" placeholder="Remarks" name="remarks" id="remarks"><?php echo $remarks ?></textarea>		
				</div>
				<button class="btn btn-info btn-block" id="saveNote" onclick="saveEmpData('<?php echo $employeeid ?>')">SAVE</button>
			</div>
		</div>
	</div>
</div>
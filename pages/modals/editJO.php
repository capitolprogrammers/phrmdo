<?php 
session_start();
include('../../assets/conn/etc.php');
$jonum = p("jonum");
$r = get_value("SELECT acct_code, res_center, program_id, status from jotbl WHERE jo_number = '$jonum'");
$programId = $r[2];

$program = get_value("SELECT program_id, program_name from programtbl WHERE program_id = '$programId'");

$programList = get_array("SELECT program_id, program_name from programtbl");

$arr = array(1,2,3,4,5,6);
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				<?php echo $jonum ?><br>
				<small>Edit JO</small>
			</h5>
			<div class="card-body">
				<div class="form-group">
					<label for="account_code">You can only edit Account Code and Responsibility Center on this JO.</label>
					<input type="text" id="account_code_edit" class="form-control" placeholder="Account Code" value="<?php echo $r[0] ?>">
				</div>
				<div class="form-group">
					<input type="text" id="res_center_edit" class="form-control" placeholder="Responsibility Center" value="<?php echo $r[1] ?>">
				</div>
				<div class="form-group">
					<label for="statusEdit">Status</label>
					<select class="form-control" id="statusEdit" name="statusEdit" <?php if($_SESSION["user_type"] != "admin"){echo 'disabled';} ?>>
						<option value="<?php echo $r["status"] ?>"><?php echo getStatus($r["status"]) ?></option>
						<option value="<?php echo $r["status"] ?>">-------------------</option>
						<?php 
						foreach ($arr as $key => $a) {
							?>
							<option value="<?php echo $a ?>"><?php echo getStatus($a) ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="programEdit">Program</label>
					<select class="form-control" id="programEdit" name="programEdit" <?php if($_SESSION["user_type"] != "admin"){echo 'disabled';} ?>>
						<option value="<?php echo $program[0] ?>"><?php echo $program[1] ?></option>
						<option value="<?php echo $program[0] ?>">-------------------</option>
						<?php 
						foreach ($programList as $key => $p) {
							?>
							<option value="<?php echo $p[0] ?>"><?php echo $p[1] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<button class="btn btn-info btn-block" id="updateJO" onclick="updateJO('<?php echo $jonum ?>')">UPDATE</button>
			</div>
		</div>
	</div>
</div>
</div>
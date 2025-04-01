<?php
session_start();
include('../../assets/conn/etc.php');
$jonameid = p('jonameid');

$emp_id = get_value("SELECT employee_id from jonamestbl WHERE id = '$jonameid'")[0];

$jonum = p("jonum");

$data = get_value("SELECT * from employeetbl WHERE employee_id = '$emp_id'");

$jodata = get_value("SELECT * from jonamestbl WHERE id = '$jonameid'");

$status = get_value("SELECT status from jotbl WHERE jo_number = '$jonum'")[0];

if ($data["address"] == "") {
	$address = "No address record.";
}
else{
	$address = $data["address"];
}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h5><?php echo $data["lname"] . ', ' . $data["fname"] . ' ' . $data["mname"] ?><br><small><?php echo $address ?></small></h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="date_from2">From</label>
							<input type="date" id="date_from2" class="form-control" value="<?php echo $jodata["contract_start"] ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="date_to2">To</label>
							<input type="date" id="date_to2" class="form-control" value="<?php echo $jodata["contract_end"] ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="search_designation">Designation</label>
					<input type="text" class="form-control mb-1" id="search_designation" onkeyup="search_designation()" value="<?php echo getDesignationName($jodata["designation_id"]) ?>">
					<select class="form-control" style="display: none;" id="designations">
						<option value="<?php echo $jodata["designation_id"] ?>"></option>
					</select>
				</div>
				<div class="form-group">
					<label for="search_office">Office</label>
					<input type="text" class="form-control mb-1" id="search_office" onkeyup="search_office()" value="<?php echo getOfficeName($jodata["office_id"]) ?>">
					<select class="form-control" style="display: none;" id="offices">
						<option value="<?php echo $jodata["office_id"] ?>"></option>
					</select>
				</div>
				<div class="form-group">
					<select class="form-control" id="jo_remarks">
						<option value="<?php echo $jodata["contract_status"] ?>"><?php echo getContract($jodata["contract_status"]) ?></option>
						<option value="0">------</option>
						<option value="1">Renewal</option>
						<option value="2">Original</option>
						<option value="3">Re-Employment</option>
					</select>
				</div>
				<div class="form-group">
					<textarea class="form-control" id="noteTxt" placeholder="Please insert note here.."><?php echo $jodata["note"] ?></textarea>
				</div>
				<div class="form-group">
					<select class="form-control" id="daysTxt">
						<option value="<?php echo $jodata["days"] ?>"><?php echo getDays($jodata["days"]) ?></option>
						<option value="0">------</option>
						<option value="1">Regular Days</option>
						<option value="2">Including Saturdays and Holidays</option>
						<option value="3">Including Saturdays, Sundays and Holidays</option>
						<option value="4">Including Saturdays Only</option>
						<option value="5">Including Holidays Only</option>
						<option value="6">Including Saturdays, Sundays and Holidays (22days)</option>
						<option value="7">Including Saturdays, Sundays and Holidays (1 Day off per week)</option>
						<option value="8">Including Saturdays and Holidays (22days)</option>
						<option value="9">Including Saturdays and Sundays</option>
						<option value="10">Fridays, Saturdays and Sundays</option>
							<option value="11">Saturdays and Sundays only</option>
								<option value="12">Including Saturdays, Sundays and Holidays (26days)</option>
					</select>
				</div>
				<?php
				$disabled = ''; 
				if ($_SESSION['user_type'] != "admin" && $status != "1") {
					$disabled = "disabled data toggle='tooltip' title='Only admins have access to edit/delete this data.'";
				}
				?>
				<button type="button" class="btn btn-info btn-block" onclick="updateEmployeeJO('<?php echo $jonameid ?>','<?php echo $jonum ?>')" <?php echo $disabled ?>>UPDATE</button>
				<button type="button" class="btn btn-danger btn-block mt-2" onclick="deleteEmpJO('<?php echo $jonameid ?>','<?php echo $jonum ?>')"<?php echo $disabled ?>>DELETE</button>
			</div>
		</div>
	</div>
</div>

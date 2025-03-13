<?php
include('../../assets/conn/etc.php');
$emp_id = p("id");
$jonum = p("jonum");
$data = get_value("SELECT * from employeetbl WHERE employee_id = '$emp_id'");
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
							<input type="date" id="date_from2" class="form-control">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="date_to2">To</label>
							<input type="date" id="date_to2" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="search_designation">Designation</label>
					<input type="text" class="form-control mb-1" id="search_designation" onkeyup="search_designation()">
					<select class="form-control" style="display: none;" id="designations">
					</select>
				</div>
				<div class="form-group">
					<label for="search_office">Office</label>
					<input type="text" class="form-control mb-1" id="search_office" onkeyup="search_office()">
					<select class="form-control" style="display: none;" id="offices">
					</select>
				</div>
				<div class="form-group">
					<select class="form-control" id="jo_remarks">
						<option value="1">Renewal</option>
						<option value="2">Original</option>
						<option value="3">Re-Employment</option>
					</select>
				</div>
				<div class="form-group">
					<textarea class="form-control" id="noteTxt" placeholder="Please insert note here.."></textarea>
				</div>
				<div class="form-group">
					<select class="form-control" id="daysTxt">
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
				<button type="button" class="btn btn-info btn-block" onclick="saveEmployeeJO('<?php echo $emp_id ?>','<?php echo $jonum ?>')">Save</button>
			</div>
		</div>
	</div>
</div>

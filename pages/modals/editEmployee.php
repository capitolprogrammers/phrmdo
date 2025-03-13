<?php
include('../../assets/conn/etc.php');
$empId = p("id");
$r = get_value("SELECT * from employeetbl  WHERE employee_id = '$empId'");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				<?php echo getData($empId, 'name') ?><br>
				<small>Edit Employee Data</small>
			</h5>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="fnameEdit">Firstname</label>
							<input type="text" class="form-control" id="fnameEdit" placeholder="First Name" value="<?php echo $r["fname"]  ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="mnameEdit">Middlename</label>
							<input type="text" class="form-control" id="mnameEdit" placeholder="Middle Name" value="<?php echo $r["mname"]  ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="lnameEdit">Lastname</label>
							<input type="text" class="form-control" id="lnameEdit" placeholder="Last Name" value="<?php echo $r["lname"]  ?>">
						</div>
					</div>
					<div class="col-lg-7">
						<div class="form-group">
							<label for="lnameEdit">Address</label>
							<input type="text" class="form-control" id="addressEdit" placeholder="Address" value="<?php echo $r["address"]  ?>">
						</div>
					</div>
					<div class="col-lg-5">
						<div class="form-group">
							<label for="lnameEdit">Phone Number</label>
							<input type="text" class="form-control" id="phonenumEdit" placeholder="09123456789" value="<?php echo $r["phonenum"]  ?>">
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group">
							<label for="lname">Birthday</label>
							<input type="date" pattern="\d{2}-\d{2}-\d{4}"  class="form-control" id="birthdayEdit" placeholder="01-01-2023" value="<?php echo $r["bday"]  ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="lname">Gender</label>
							<select class="form-control" id="genderEdit" >

								<?php 
								if ($r["gender"] == "M") {
									?>
									<option value="M">Male</option>
									<option value="F">Female</option>
									<?php
								}
								else{
									?>
									<option value="F">Female</option>
									<option value="M">Male</option>
									<?php
								}
								?>
								
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label for="lname">C/O</label>
							<input type="text" class="form-control" id="c_oEdit" placeholder="C/O"  value="<?php echo $r["c_o"]  ?>">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label for="lname">Note</label>
							<textarea class="form-control" placeholder="Insert Note" id="noteEdit"><?php echo $r["note"]  ?></textarea>
						</div>
					</div>
				</div>
				<button class="btn btn-info btn-block" id="updateEmployee" onclick="updateEmployee('<?php echo $empId ?>')"
				<?php 
				
				 if($_SESSION["user_type"] != "admin"){
				     echo 'disabled';
				 }
				if($_SESSION["user_id"] == "20"){
				     echo 'enabled';
				 }
				 
				?>>UPDATE</button>
			</div>
		</div>
	</div>
</div>
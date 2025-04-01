	<?php 
	include('../../assets/conn/etc.php');
	$id = p('id');
	$r = get_value("SELECT * from employeetbl WHERE employee_id = '$id'");
	$bank = get_value("SELECT bank_name, acct_no from banktbl WHERE employee_id = '$id'");

	if (empty($bank)) {
		$bank_name = "No Data";
		$acctno = "No Data";
	}
	else{
		$acctno = $bank[1];
		$bank_name = $bank[0];
	}
	?>

	<div class="row modal-shits" style="padding:10px">
		<div class="col-lg-12">
			<h5 class="card-title-modal">View Record</h5>
		</div>
		<div class="col-lg-12">
			<div class="employee-photo">
				<img src="assets/images/faces/face1.jpg" class="rounded-circle">
			</div>
		</div>
		<div class="col-lg-12">
			<h5 class="mb-3">Personal Information</h5>
			<div class="name mb-1"><strong>Name . </strong><?php echo $r["lname"] . ", " . $r["fname"] . " " . $r["mname"] ?></div>
			<div class="address mb-2">
				<strong>Address . </strong>
				<address>
					<?php 
					if ($r["address"] =="") {
						echo " No record to show.";
					}
					else{
						echo $r["address"];		
					}
					?>
				</address>
			</div>
			<div class="row">
				<div class="col-lg-6 mb-2">
					<strong>
						Gender . 
					</strong>
					<?php 
					if ($r["gender"] =="") {
						echo " No record to show.";
					}
					else{
						echo $r["gender"];		
					}
					?>
				</div>
				<div class="col-lg-6 mb-2">
					<strong>
						Birthday . 
					</strong>
					<?php 
					if ($r["bday"] =="") {
						echo " No record to show.";
					}
					else{
						echo $r["bday"];		
					}
					?>
				</div>
				<div class="col-lg-6 mb-1">
					<strong>
						Phone Number . 
					</strong>
					<?php 
					if ($r["phonenum"] =="") {
						echo " No record to show.";
					}
					else{
						echo $r["phonenum"];		
					}
					?>
				</div>
				<div class="col-lg-6 mb-1">
					<div>
						<strong>
							Email . 
						</strong>
					</div>
					<?php 
					if ($r["email"] =="") {
						echo " No record to show.";
					}
					else{
						echo $r["email"];		
					}
					?>
				</div>
				<div class="col-lg-12 mt-3">
					<h5>Bank Info</h5>
					<div class="row">
						<div class="col-lg-6">
							<strong>Bank . </strong>
							<div><?php echo $bank_name ?></div>
						</div>
						<div class="col-lg-6">
							<strong>Account # . </strong>
							<div><?php echo $acctno ?></div>
						</div>
					</div>
				</div>	
			</div>
		</div>
		<div class="col-lg-12 mt-3">
			<h5>Personal Data Sheet</h5>
			<div id="accordion">
				<div class="card">
					<div class="card-header" id="headingOne">
						<h5 class="mb-0">
							<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								I. Personal Information
							</button>
						</h5>
					</div>

					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
						<div class="card-body">

						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								II. Family Background
							</button>
						</h5>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
						<div class="card-body">

						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingThree">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								III. Educational Background
							</button>
						</h5>
					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
						<div class="card-body">

						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="heading4">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapseThree">
								IV. Civil Service Eligibility
							</button>
						</h5>
					</div>
					<div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
						<div class="card-body">

						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="heading5">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapseThree">
								V. Work Experience
							</button>
						</h5>
					</div>
					<div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
						<div class="card-body">

						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="heading6">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapseThree">
								VI. Voluntary Works
							</button>
						</h5>
					</div>
					<div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion">
						<div class="card-body">

						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="heading7">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapseThree">
								VII. Learning and Development
							</button>
						</h5>
					</div>
					<div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordion">
						<div class="card-body">

						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="heading8">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapseThree">
								VIII. Other Information
							</button>
						</h5>
					</div>
					<div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion">
						<div class="card-body">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

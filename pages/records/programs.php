<div class="row">
	<div class="col-lg-4">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Add New Program<br><small class="card-description">Please reload para mag take effect.</small></h5>
			</div>
			<div class="card-body">
				<form method="POST">
					<div class="form-group">
						<label for="program_name">Program Name</label>
						<input type="text" id="program_name" name="program_name" class="form-control">
					</div>
					<div class="form-group">
						<label for="office_select">Select Office</label>
						<select class="form-control" id="office_select" name="office_select">
							<option value="GO">Executive</option>
							<option value="SP">Legislative</option>
						</select>
					</div>
					<button type="submit" class="btn btn-info" name="saveProgram">SAVE</button>
				</form>
				<?php 
				if (isset($_POST["saveProgram"])) {
					$program_name = p("program_name");
					$office = $_POST["office_select"];

					$r = get_value("SELECT count(*) from programtbl WHERE program_name = '$program_name'");
					if($r[0] == "0"){
						saveUserLog(null, "CREATED NEW PROGRAM RECORD. $program_name $office");
						qr("INSERT INTO programtbl (program_name, office) VALUES ('$program_name', '$office')");
						?>
						<div class="alert alert-success mt-2">PROGRAM SAVED.</div>
						<script type="text/javascript">location.reload();</script>
						<?php
					}
					else{
						?>
						<div class="alert alert-warning mt-2">DUPLICATE RECORD.</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="card">
			<h5 class="card-header">Programs</h5>

			<div class="card-body">
				<div class="table-responsive" <?php echo responsive(50) ?>>
					<table class="table table-condensed">
						<?php 
						$r = get_array("SELECT * from programtbl");
						?>
						<thead>
							<th>#</th>
							<th>Program Name</th>
							<th>Office</th>
						</thead>
						<tbody>
							<?php 
							$num= 1;
							foreach ($r as $key => $p) {
								$off = '';
								if ($p["office"] == "GO") {
									$off = 'Executive';
								}
								else{
									$off = 'Legislative';
								}
								?>
								<tr onclick="editProgram('<?php echo $p["program_id"] ?>')">
									<td><?php echo $num; ?></td>
									<td><?php echo $p["program_name"]; ?></td>
									<td><?php echo $off ?></td>
								</tr>
								<?php
								$num++;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
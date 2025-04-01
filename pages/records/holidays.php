<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<h5 class="card-header">Users <p class="card-description"> Please change these holiday records every year.
			</p></h5>
			<div class="card-body">
				<form method="POST">
					<div class="form-group">
						<select name="year" class="form-control">
							<option disabled>Select Year</option>
							<option>2023</option>
							<option>2024</option>
							<option>2025</option>
							<option>2026</option>
						</select>
					</div>
					<button class="btn btn-info btn-block mb-5" type="submit" name="submitBtn">GO</button>
				</form>
				<?php 
				$r = get_array("SELECT * from holidaystbl WHERE year = '2023'");
				if (isset($_POST["submitBtn"])) {
					$year = $_POST["year"];
					$r = get_array("SELECT * from holidaystbl WHERE year = '$year'");
				}
				?>
				<div class="table-responsive" style="max-height:65vh">
					<table class="table table-bordered table-hover">
						<thead>
							<th>#</th>
							<th>Month</th>
							<th>Year</th>
							<th>Holidays REGULAR DAYS</th>
							<th>Holidays WEEKENDS</th>
						</thead>
						<tbody>
							<?php 
							$num=1;
							foreach ($r as $key => $v) {
								?>
								<tr>
									<td><?php echo $num ?></td>
									<td><?php echo getMonthName($v["month_no"]); ?></td>
									<td><?php echo $v['year'] ?></td>
									<td>
										<div class="form-group" style="max-width: 200px;">
											<input type="text" class="form-control" onchange="changeHoliday('<?php echo $v["holiday_id"] ?>')" id="month_<?php echo $v['holiday_id'] ?>" value="<?php echo $v["holidays"] ?>">
										</div>
									</td>
									<td>
										<div class="form-group" style="max-width: 200px;">
											<input type="text" class="form-control" onchange="changeHoliday('<?php echo $v["holiday_id"] ?>')" id="month_<?php echo $v['holiday_id'] ?>_weekend" value="<?php echo $v["holidaysweekend"]; ?>">
										</div>
									</td>
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
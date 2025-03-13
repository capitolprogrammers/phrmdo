<?php
include('../../assets/conn/etc.php');
$joid = p('joid');
$r = get_value("SELECT status from jotbl WHERE jo_number = '$joid'")[0];
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h5><?php echo $joid ?></h5>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="account_code">Please input the account code and responsibility center from budget office before we proceed.</label>
					<input type="text" id="account_code" class="form-control" placeholder="Account Code">
				</div>
				<div class="form-group">
					<input type="text" id="res_center" class="form-control" placeholder="Responsibility Center">
				</div>
				<button type="button" class="btn btn-info btn-block" onclick="tagApproved('<?php echo $joid ?>')">Save</button>
			</div>
		</div>
	</div>
</div>

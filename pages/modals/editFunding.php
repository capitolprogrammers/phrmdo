<?php 
include('../../assets/conn/etc.php');
$id = p('id');
$r = get_value("SELECT * from fundingtbl WHERE fund_id = '$id'");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				Edit Funding
			</h5>
			<div class="card-body">
				<div class="form-group">
					<input type="text" id="fundingNameEdit" class="form-control" value="<?php echo $r[1] ?>">
				</div>
				<div class="form-group">
					<input type="text" id="fundingCodeEdit" class="form-control" value="<?php echo $r[2] ?>">
				</div>
				<button class="btn btn-info btn-block" id="updateFunding" onclick="fundingOption('update', '<?php echo $id ?>')">UPDATE</button>
				<button class="btn btn-danger btn-block mt-2" id="deleteFunding" onclick="fundingOption('delete', '<?php echo $id ?>')">DELETE</button>
			</div>
		</div>
	</div>
</div>
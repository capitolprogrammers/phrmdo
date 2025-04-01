<?php 
include('../../assets/conn/etc.php');
$id = p('id');
$r = get_value("SELECT designation_name, rate from designationtbl WHERE designation_id = '$id'");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				<?php echo $r[0] ?><br>
				<small>Edit Designation</small>
			</h5>
			<div class="card-body">
				<div class="form-group">
					<input type="text" id="designationNameEdit" class="form-control" value="<?php echo $r[0] ?>">
				</div>
					<div class="form-group">
					<input type="text" id="designationRateEdit" class="form-control" value="<?php echo $r[1] ?>">
				</div>
				<button class="btn btn-info btn-block" id="updateOffice" onclick="updateDesignation('<?php echo $id ?>')">UPDATE</button>
				<button class="btn btn-danger btn-block mt-2" id="deleteOffice" onclick="deleteDesignation('<?php echo $id ?>')">REMOVE</button>

			</div>
		</div>
	</div>
</div>
<?php 
include('../../assets/conn/etc.php');
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				<?php echo $joid ?><br>
				<small>Add note</small>
			</h5>
			<div class="card-body">
				<div class="form-group">
					<textarea class="form-control" id="note" rows="5"><?php echo $note ?></textarea>
				</div>
				<button class="btn btn-info btn-block" id="saveNote" onclick="saveNote('<?php echo $joid ?>')">SAVE</button>
			</div>
		</div>
	</div>
</div>
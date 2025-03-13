<?php 
include('../../assets/conn/etc.php');
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				Approve Option
			</h5>
			<div class="card-body">
				<div class="col-lg-12 m-1">
					<button class="btn btn-lg btn-info btn-block" onclick="approveSelected()">APPROVE</button>
				</div>
				<div class="col-lg-12 m-1">
					<button class="btn btn-lg btn-success btn-block" onclick="approveSelectedRecommended()">APPROVE(RECOMMENDED FOR APPROVAL)</button>
				</div>
			</div>
		</div>
	</div>
</div>
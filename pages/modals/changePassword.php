<?php 
include('../../assets/conn/etc.php');
$id = $_SESSION["user_id"];
$userData = get_value("SELECT * from users WHERE id = '$id'");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<h5 class="card-header">
				<?php echo $userData["name"] ?><br>
				<small>Change password</small>
			</h5>
			<div class="card-body">
				<div class="form-group">
					<input type="password" id="password1" class="form-control" placeholder="Input password..." required>
				</div>
				<div class="form-group">
					<input type="password" id="password2" class="form-control" placeholder="Please confirm password..." required onkeyup="checkPasswords()">
				</div>
				<p id="message"></p>
				<button class="btn btn-info btn-block" id="changePass" onclick="updatePassword()">CHANGE</button>
			</div>
		</div>
	</div>
</div>
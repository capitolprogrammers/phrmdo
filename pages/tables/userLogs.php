<?php 
include('../../assets/conn/etc.php');
$r = get_array("SELECT * from userlogs INNER JOIN users ON users.id = userlogs.userid ORDER BY userlogs.id DESC LIMIT 10");
foreach ($r as $key => $value) {
  date_default_timezone_set('Asia/Manila');
  $logdate = new DateTime($value["daterecorded"]);
  ?>
  <div class="preview-item border-bottom">
    <div class="preview-thumbnail">
      <img src="assets/images/faces-clipart/pic-3.png" alt="image" class="rounded-circle" />
    </div>
    <div class="preview-item-content d-flex flex-grow">
      <div class="flex-grow">
        <div class="d-flex d-md-block d-xl-flex justify-content-between">
          <h6 class="preview-subject"><?php echo $value["name"] ?></h6>
          <p class="text-muted text-small"><?php echo getPastTime($logdate); ?></p>
        </div>
        <p class="text-muted"><?php echo ucfirst(strtolower($value["event"])) ?>
        <br>
        <small class="text-muted">
          <?php 
          if ($value["dataID"] != "") {
            echo 'DATA ID: ' . $value["dataID"];
          }
          ?>
          . 
          <?php echo $value["ipaddress"] ?>
        </small>
      </p>
    </div>
  </div>
</div>
<?php
}
?>

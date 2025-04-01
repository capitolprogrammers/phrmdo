<li class="nav-item nav-category">
  <span class="nav-link">Navigation</span>
</li>

<?php 
switch ($userType) {
  case 'jo':
  jo();
  break;

  case 'admin':
  admin();
  break;

  case 'payroll':
  payroll();
  break;

  case 'findes':
  findes();
  break;
  
  
  case 'payroll_records':
  payroll_records();
  break;
  
    case 'jo_records':
  jo_records();
  break;
  
  
  default:
    // code...
  break;
}
?>

<?php 
function admin(){
  $r = get_value("SELECT count(*) from jotbl  INNER JOIN jonotestbl ON jotbl.jo_number = jonotestbl.jo_number WHERE status = 1 and jonotestbl.note like '%REVIEWED%'");
  ?>
  <li class="nav-item menu-items">
    <a class="nav-link" href="?page=main">
      <span class="menu-icon">
        <i class="mdi mdi-speedometer"></i>
      </span>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <span class="menu-icon">
        <i class="mdi mdi-account-multiple-outline"></i>
      </span>
      <span class="menu-title">Employees  
        <?php 
        if ($r[0] != 0) {
          ?>
          <span class="badge badge-danger badge-pill" id="notifBadge"><?php echo $r[0]; ?></span>
          <?php
        }
      ?></span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="?page=records">Employee Records</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=showjos">For Approval 
          <?php 
          if ($r[0] != 0) {
            ?>
            <span class="badge badge-danger badge-pill" id="notifBadge2"><?php echo $r[0]; ?></span>
            <?php
          }
          ?>
        </a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=jo_records_all">JO Records</a></li>
      </ul>
    </div>
  </li>
   <li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
      <span class="menu-icon">
        <i class="mdi mdi-cash-usd"></i>
      </span>
      <span class="menu-title">Payroll</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic1">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="?page=create_payroll">Payroll</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=payroll_records">Payroll Records</a></li>
      </ul>
    </div>
  </li>

  
  <li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
      <span class="menu-icon">
        <i class="mdi mdi-settings"></i>
      </span>
      <span class="menu-title">Settings</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic3">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="?page=users">Users</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=offices">Offices</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=designations">Designations</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=programs">Programs</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=holidays">Holidays</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" href="?page=reports">
      <span class="menu-icon">
        <i class="mdi mdi-file"></i>
      </span>
      <span class="menu-title">Reports</span>
    </a>
  </li>
  <?php
}



function jo(){
  ?>
  <li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <span class="menu-icon">
        <i class="mdi mdi-account-multiple-outline"></i>
      </span>
      <span class="menu-title">Employees</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="?page=records">Employee Records</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=create_jos">Create JO</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=jo_records_all">JO Records</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
      <span class="menu-icon">
        <i class="mdi mdi-settings"></i>
      </span>
      <span class="menu-title">Settings</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic3">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="?page=offices">Offices</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=designations">Designations</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=programs">Programs</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=holidays">Holidays</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=fundings">Fundings</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" href="?page=reports">
      <span class="menu-icon">
        <i class="mdi mdi-file"></i>
      </span>
      <span class="menu-title">Reports</span>
    </a>
  </li>
  <?php
}


function payroll(){
  ?>
  <li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <span class="menu-icon">
        <i class="mdi mdi-account-multiple-outline"></i>
      </span>
      <span class="menu-title">Employees</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="?page=records">Employee Records</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=create_jos">J.O Records</a></li>
      </ul>
    </div>
  </li>

  <li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
      <span class="menu-icon">
        <i class="mdi mdi-cash-usd"></i>
      </span>
      <span class="menu-title">Payroll</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic1">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="?page=create_payroll">Payroll</a></li>
        <li class="nav-item"> <a class="nav-link" href="?page=payroll_records">Payroll Records</a></li>
      </ul>
    </div>
  </li>

  <?php
}

function payroll_records(){
  ?>
      <li class="nav-item"> <a class="nav-link" href="?page=jo_records_all">JO Records</a></li>
   <li class="nav-item"> <a class="nav-link" href="?page=payroll_records">Payroll Records</a></li>
  <?php
}

function jo_records(){
  ?>
        <li class="nav-item"> <a class="nav-link" href="?page=jo_records_all">JO Records</a></li>
   <!--<li class="nav-item"> <a class="nav-link" href="?page=payroll_records">Payroll Records</a></li>-->
  <?php
}

function findes(){
  ?>
      <!--<li class="nav-item"> <a class="nav-link" href="?page=jo_records_all">JO Records</a></li>-->
   <li class="nav-item"> <a class="nav-link" href="?page=payroll_records">Payroll Records</a></li>
  <?php
}





?>
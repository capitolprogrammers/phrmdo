<?php 
session_start();
include('assets/conn/etc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>UPDATE JO</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column h-100">
    <div class="main">
        <div class="container p-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h1 class="text-primary mb-2">Change JO Number</h1>
                    <form method="POST">
                        <div class="form-group mb-2">
                            <input class="form-control form-control-lg" name="jo_number" placeholder="Current JO #">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-lg" name="new_jo_number" placeholder="New JO #">
                        </div>
                        <button type="submit" name="updateBtn" class="mt-2 btn btn-primary btn-lg">UPDATE</button>
                    </form>
                    <div>
                     <?php
                     if(isset($_POST["updateBtn"])){
                        $jonum = $_POST["jo_number"];
                        $newjonum = $_POST["new_jo_number"];
                        $r = get_value("SELECT count(*) from jotbl WHERE jo_number = '$jonum'");


                        if ($r[0] == 0) {
                            ?>
                            <div class="alert alert-error text-white mt-2">Error: JO Number not found.</div>
                            <?php
                        }
                        else{
                          $r2 = get_value("SELECT count(*) from jotbl WHERE jo_number = '$newjonum'");
                          if ($r2[0] == 1) {
                             ?>
                             <div class="alert alert-error text-white  mt-2">Error: New JO Number already exist.</div>
                             <?php
                         }
                         else{
                            qr("UPDATE jotbl SET jo_number = '$newjonum' WHERE jo_number = '$jonum'");
                            qr("UPDATE jonamestbl SET jo_number = '$newjonum' WHERE jo_number = '$jonum'");
                            qr("UPDATE jonotestbl SET jo_number = '$newjonum' WHERE jo_number = '$jonum'");
                            qr("UPDATE userlogs SET dataID = '$newjonum'  WHERE dataID = '$jonum'");
                            saveUserLog($newjonum, "UPDATED JO NUMBER \n from: $jonum \n To: $newjonum");
                            ?>
                            <div class="alert alert-success mt-2">Success! <br> JO Number updated from <?php echo $jonum ?> to <?php echo $newjonum ?></div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html> 
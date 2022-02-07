<?php
	session_start();

	if(!isset($_SESSION["username"]) && !isset($_SESSION["password"]))
	{
        header('Location: signin.php');
        exit();
	}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Jquery -->
    <script src="lib/jquery-3.6.0.min.js"></script>
    <script src="lib/jquery.validate.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/9d1d9a82d2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="img/icon.png">

    <title>Account Profile</title>
</head>
<body>
    <div class="container-fluid bg-dark">
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboard.php">
                    <div class="container-fluid">
                        <img class="img-fluid" src="img/bulsu-logo-navbar.png" alt="bulsu-logo">
                    </div>
                </a>

                <div class="d-flex justify-content-end mx-5">
                    <div class="dropdown pb-4 mt-4">
                        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php
                                if ($_COOKIE["password"] == "44gyKdy9") {
                                    echo "uploads/".$_COOKIE["image"];
                                } else {
                                    include "util/getUserImage.php"; getImage();
                                }
                            ?>" alt="user-image" width="60" height="60" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1" style="cursor: pointer"><?php echo $_COOKIE["username"] ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style="cursor: pointer;">
                            <?php
                                if ($_COOKIE["password"] != "44gyKdy9") {
                                    echo "<li><a class='dropdown-item' href='accountProfile.php'>Account Profile</a></li>";
                                }

                                if ($_COOKIE["account_type"] == "administrator") {
                                    echo "<li><a class='dropdown-item' href='viewAllAccounts.php'>View All Accounts</a></li>";
                                }
                            ?>
                            <?php
                                if ($_COOKIE["account_type"] == "administrator") {
                                    echo "<li><div class='dropdown-divider'></div></li>";
                                    echo "<li><a class='dropdown-item' href='confirmSupply.php'>Confirm Supply</a></li>";
                                    echo "<li><a class='dropdown-item' href='confirmEquipment.php'>Confirm Distribution</a></li>";
                                    echo "<li><a class='dropdown-item' href='confirmCondemn.php'>Confirm Condemn</a></li>";
                                    echo "<li><a class='dropdown-item' href='confirmTransfer.php'>Confirm Transfer</a></li>";
                                    echo "<li><div class='dropdown-divider'></div></li>";
                                }
                            ?>
                            <li><a class="dropdown-item" onclick="signOut()">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="row flex-nowrap border-top border-light">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark p-5">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-tachometer-alt fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="viewSupplies.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-box fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">View Supplies</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="distributeEquipment.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-truck-loading fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">Distribute Equipment</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="condemnEquipment.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-trash-alt fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">Condemn Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="transferEquipment.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-exchange-alt fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">Transfer Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="generateReport.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-clipboard-list fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">Generate Report</span>
                        </a>
                    </li>
                    <?php
                        if ($_COOKIE["account_type"] == "administrator") {
                            echo '<li>
                                    <a href="viewDemands.php" class="nav-link px-0 align-middle mb-3">
                                        <i class="fas fa-file-invoice fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">View Demands</span>
                                    </a>
                                </li>';
                        }
                    ?>
                    <li>
                        <a href="viewCondemned.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-archive fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">View Condemned</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col py-3">
            <h1>Account Profile</h1>
            <hr>

            <div class="container shadow-lg p-3 mb-5 bg-body rounded">
                <div class="row">
                    <div class="col-sm-4">
                    <form method="POST" action="accountProfile/toChangePicture.php" name="my_image" enctype="multipart/form-data" id="upload-image">
                        <div class="row">
                            <div class="form-group mb-3">
                                <div class="container d-flex justify-content-center">
                                    <img src="<?php include "util/setUserImage.php"; setImage(); ?>" id="picture" class="img-thumbnail" alt="Profile Picture" style="width: 250px;">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="container d-grid gap-2">
                                    <input type="file" name="my_image" class="form-control" id="my_image" aria-describedby="inputGroupFileAddon04" aria-label="Upload" onchange="preview()" value="">
                                    <button type="submit" name="submit" class="btn btn-primary">Upload This Image</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>

                    <div class="col-sm-8">
                    <form method="POST" action="accountProfile/toEditAccount.php" id="edit-account">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="form-group mb-3">
                                    <input type="text" name="accountId" placeholder="Account Id" class="form-control form-cntrol-sm" id="accountId" value="<?php include "util/getUserId.php"; getAccountId(); ?>" readonly>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <input type="text" name="accountType" placeholder="Account Type" class="form-control form-cntrol-sm" id="accountType" value="<?php include "util/getUserAccountType.php"; getAccountType(); ?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <input type="text" name="fname" placeholder="First Name" class="form-control form-cntrol-sm" id="fname" value="<?php include "util/getUserFname.php"; getFname(); ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <input type="text" name="mname" placeholder="Middle initial" class="form-control form-cntrol-sm" id="mname" value="<?php include "util/getUserMname.php"; getMname(); ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <input type="text" name="lname" placeholder="Last Name" class="form-control form-cntrol-sm" id="lname" value="<?php include "util/getUserLname.php"; getLname(); ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <input type="number" name="contact" placeholder="Contact No." class="form-control form-cntrol-sm" id="contact" value="<?php include "util/getUserContact.php"; getContact(); ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <label class="fs-5" for="birth_date">Birth Date</label>
                                    <input type="date" name="birth_date" placeholder="Birth Date" class="form-control form-cntrol-sm" id="birth_date" value="<?php include "util/getUserBirthDate.php"; getBirthDate(); ?>">
                                </div> 
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <input type="text" name="username" placeholder="Username" class="form-control form-cntrol-sm" id="username" value="<?php include "util/getUserEmail.php"; getEmail(); ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <input type="password" name="password" placeholder="New Password" class="form-control form-cntrol-sm" id="password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <input type="password" name="confirm_password" placeholder="Confirm New Password" class="form-control form-cntrol-sm" id="confirm_password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-3">
                                    <button type="submit" name="submit" class="btn form-control form-control-sm btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="accountProfile/validateEditAccountv3.js"></script>
    <script src="accountProfile/validateChangePicture.js"></script>
    <script src="script/signOut.js"></script>
    <script src="lib/sweetalert.min.js"></script>
    <script>
        function preview() {
            picture.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
    <?php
        if(isset($_SESSION["status"]) && $_SESSION["status"] != "")
        {
        ?>
            <script>
                swal({
                    title: "<?php echo $_SESSION["title"] ?>",
                    text: "<?php echo $_SESSION["text"] ?>",
                    icon: "<?php echo $_SESSION["icon"] ?>",
                    button: "Okay",
                });
            </script>
        <?php
            unset($_SESSION["status"]);
            unset($_SESSION["title"]);
            unset($_SESSION["text"]);
            unset($_SESSION["icon"]);
        }
    ?>

    <style>
        .error {
            color: red;
            padding-top: 5px;
            padding-left: 10px;
        }
    </style>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
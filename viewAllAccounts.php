<?php
	session_start();

	if(!isset($_SESSION["username"]) && !isset($_SESSION["password"]))
	{
        header('Location: index.php');
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

    <!-- Google Captcha Api -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Jquery -->
    <script src="lib/jquery-3.6.0.min.js"></script>
    <script src="lib/jquery.validate.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/9d1d9a82d2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="img/icon.png">

    <title>Dashboard</title>
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
            <h1>View All Accounts</h1>
            <hr>

            <div class="container shadow-lg p-3 mb-5 bg-body rounded">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3"></div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="form-group">
                                    <img src="img/BULSU-LOGO.png" class="rounded mx-auto d-block" alt="bulsu-logo" style="width: 200px;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="search-box input-group mt-4">
                                    <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search an equipment..." aria-label="Search..." aria-describedby="button-addon2">
                                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3"></div>
                    </div>
                </div>

                <div class="container mt-5 table-responsive" style="height: 600px;">
                    <div id="result">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----- Add User Modal ----->
    <!----- Add User Modal ----->
    <!----- Add User Modal ----->
    <div class="modal fade" id="addUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Add User</h2>
                </div>
                <form action="viewAllAccounts/toAddUser.php" id="create-account-form" method="POST" enctype="multipart/form-data" name="my_image">
                    <div class="modal-body m-5">
                        <div class="row">
                            <div class="container d-flex justify-content-center">
                                <div class="row mb-5">
                                    <img src="img/BULSU-LOGO.png" class="rounded mx-auto d-block" alt="Bulsu Logo" style="width: 200px;">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <select name="accountType" id="accountType" class="form-select" aria-label="Default select account type">
                                        <option value="" selected="true" disabled="disabled">Select Account Type</option>
                                        <option value="administrator">Administrator</option>
                                        <option value="office clerk">Office Clerk</option>
                                    </select>
                                </div>

                                <?php
                                    $empId = 0;

                                    $dt = new DateTime();
                                    $getYear = $dt->format("Y");

                                    $randNum = rand(100000,1000000);
                                    $year = $getYear . "-";
                                    $empId = $year . strval($randNum);

                                    $servername='localhost';
                                    $username='u581335818_capstonev5_db';
                                    $password='TBwK?U9i!9r';
                                    $dbname = "u581335818_capstonev5_db";

                                    $con = mysqli_connect($servername, $username, $password, $dbname);

                                    if(!$con){
                                        die('Could not Connect My Sql:' .mysql_error());
                                        exit();
                                    }

                                    $select = "SELECT * FROM user_accounts";
                                    $result = $con->query($select);

                                    if ($result !== false && $result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            if($empId == $row["id"]) {
                                                header("Refresh: 0; url=viewAllAccounts.php");
                                            }
                                        }
                                    }

                                    echo
                                    "<div class='form-group mb-3'>
                                        <input type='text' name='accountId' placeholder='Account Id' class='form-control form-cntrol-sm' id='accountId' readonly value='".$empId."'>
                                    </div>";

                                    $con->close();
                                ?>

                                <div class="form-group mb-3">
                                    <input type="text" name="fname" placeholder="First Name" class="form-control form-cntrol-sm" id="fname">
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" name="mname" placeholder="Middle initial" class="form-control form-cntrol-sm" id="mname">
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" name="lname" placeholder="Last Name" class="form-control form-cntrol-sm" id="lname">
                                </div>

                                <div class="form-group mb-3">
                                    <input type="number" name="contact" placeholder="Contact No." class="form-control form-cntrol-sm" id="contact">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="fs-5" for="birth_date">Birth Date</label>
                                    <input type="date" name="birth_date" placeholder="Birth Date" class="form-control form-cntrol-sm" id="birth_date" value="">
                                </div> 
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <input type="text" name="username" placeholder="Username" class="form-control form-cntrol-sm" id="username">
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" name="password" placeholder="Password" class="form-control form-cntrol-sm" id="password">
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control form-cntrol-sm" id="confirm_password">
                                </div>

                                <div class="form-group mb-3">
                                    <input type="file" name="my_image" class="form-control" id="my_image" aria-describedby="inputGroupFileAddon04" aria-label="Upload" value="">
                                </div>

                                <div class="form-group mb-3">
                                    <div class="d-grid gap-1">
                                        <div class="d-flex justify-content-center">
                                            <div class="g-recaptcha" data-sitekey="6Le028EcAAAAALCrXK13ineo5__Ys1aP8hvNYIwS"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!----- Active Modal ----->
    <!----- Active Modal ----->
    <!----- Active Modal ----->
    <div class="modal fade" id="activeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="staticBackdropLabel">Active</h2>
            </div>
            <form action="viewAllAccounts/toSetActive.php" method="POST">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="container d-flex justify-content-center">
                            <img src="img/warning.png" class="rounded mx-auto d-block" alt="warning" style="width: 250px;">
                        </div>
                    </div>

                    <div class="row">
                        <p class="text-center fs-5">Are you sure you want to set this account to active again?</p>
                    </div>

                    <div class="row p-5">
                        <div class="form-group mb-3">
                            <input type="text" name="activeId" placeholder="Account Id" class="form-control form-cntrol-sm" id="activeId" value="" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" name="activeName" placeholder="Name" class="form-control form-cntrol-sm" id="activeName" value="" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <!----- Block Modal ----->
    <!----- Block Modal ----->
    <!----- Block Modal ----->
    <div class="modal fade" id="blockModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="staticBackdropLabel">Block</h2>
            </div>
            <form action="viewAllAccounts/toSetBlock.php" method="POST">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="container d-flex justify-content-center">
                            <img src="img/warning.png" class="rounded mx-auto d-block" alt="warning" style="width: 250px;">
                        </div>
                    </div>

                    <div class="row">
                        <p class="text-center fs-5">Are you sure you want to block this account, the user will not be able to login.</p>
                    </div>

                    <div class="row p-5">
                        <div class="form-group mb-3">
                            <input type="text" name="blockId" placeholder="Account Id" class="form-control form-cntrol-sm" id="blockId" value="" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" name="blockName" placeholder="Name" class="form-control form-cntrol-sm" id="blockName" value="" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <!----- Change Access Modal ----->
    <!----- Change Access Modal ----->
    <!----- Change Access Modal ----->
    <div class="modal fade" id="changeAccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="staticBackdropLabel">Change Access</h2>
            </div>
            <form action="viewAllAccounts/toChangeAccess.php" method="POST">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="container d-flex justify-content-center">
                            <img src="img/BULSU-LOGO.png" class="rounded mx-auto d-block" alt="warning" style="width: 250px;">
                        </div>
                    </div>

                    <div class="row p-5">
                        <div class="form-group mb-3">
                            <input type="text" name="changeAccessId" placeholder="Account Id" class="form-control form-cntrol-sm" id="changeAccessId" value="" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" name="changeAccessName" placeholder="Name" class="form-control form-cntrol-sm" id="changeAccessName" value="" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="level">Current Level</label>
                            <input type="text" name="level" placeholder="Name" class="form-control form-cntrol-sm" id="level" value="" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <select class="form-select" aria-label="Default select example" id="currentLevel" name="currentLevel">
                                <option value="" selected disabled>Choose Access Level</option>
                                <option value="administrator">Administrator</option>
                                <option value="office clerk">Office Clerk</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <!----- Delete Modal ----->
    <!----- Delete Modal ----->
    <!----- Delete Modal ----->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="staticBackdropLabel">Delete</h2>
            </div>
            <form action="viewAllAccounts/toDelete.php" method="POST">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="container d-flex justify-content-center">
                            <img src="img/warning.png" class="rounded mx-auto d-block" alt="warning" style="width: 250px;">
                        </div>
                    </div>

                    <div class="row">
                        <p class="text-center fs-5" style="color: red;">Are you sure you want to delete this account?</p>
                    </div>

                    <div class="row p-5">
                        <div class="form-group mb-3">
                            <input type="text" name="deleteId" placeholder="Account Id" class="form-control form-cntrol-sm" id="deleteId" value="" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" name="deleteName" placeholder="Name" class="form-control form-cntrol-sm" id="deleteName" value="" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <script src="lib/sweetalert.min.js"></script>
    <script src="script/signOut.js"></script>
    <script src="viewAllAccounts/validateAddUser.js"></script>
    <script src="viewAllAccounts/loadViewAllAccounts.js"></script>

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
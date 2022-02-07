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

    <title>Confirm Equipment</title>
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
                            <li><div class="dropdown-divider"></div></li>
                            <?php
                                if ($_COOKIE["account_type"] == "administrator") {
                                    echo "<li><a class='dropdown-item' href='confirmSupply.php'>Confirm Supply</a></li>";
                                    echo "<li><a class='dropdown-item' href='confirmEquipment.php'>Confirm Distribution</a></li>";
                                    echo "<li><a class='dropdown-item' href='confirmCondemn.php'>Confirm Condemn</a></li>";
                                    echo "<li><a class='dropdown-item' href='confirmTransfer.php'>Confirm Transfer</a></li>";
                                }
                            ?>
                            <li><div class="dropdown-divider"></div></li>
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
            <h1>Confirm Supply</h1>
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
                                    <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
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

            <!-- Confirm Modal -->
            <div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="staticBackdropLabel">Supply Received Confirmation</h2>
                        </div>
                        <form action="confirmSupply/toConfirmDistributeSupply.php" method="POST">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="form-group mb-3">
                                        <img src="img/confirm.png" class="rounded mx-auto d-block" alt="bulsu-logo" style="width: 200px;">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <p class="text-center fs-5">The supply has been successfully distributed, do you want to confirm this?</p>
                                </div>

                                <div class="row mb-3">
                                    <fieldset>
                                        <legend>Supply Details</legend>
                                        <hr>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="supply_id_distribute" id="supply_id_distribute" placeholder="Supply Id" class="form-control form-cntrol-sm" readonly>
                                            </div> 
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="supply_name_distribute" id="supply_name_distribute" placeholder="Supply Name" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="supply_brand_distribute" id="supply_brand_distribute" placeholder="Brand" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="supply_unit_distribute" id="supply_unit_distribute" placeholder="Supply Unit" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <textarea class="form-control" name="supply_description_distribute" id="supply_description_distribute" rows="5" placeholder="Description. . ." readonly></textarea>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <legend>Distribution Details</legend>
                                        <hr>

                                        <div class='row'>
                                            <div class='form-group mb-3'>
                                                <input type='text' name='distribution_no' id='distribution_no' placeholder='Distribution No' class='form-control form-cntrol-sm' readonly>
                                            </div> 
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="distribution_date" class="form-label">Distribution Date</label>
                                                <input type="date" class="form-control" name="distribution_date" id="distribution_date" placeholder="Distribution Date" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="location" id="location" placeholder="Will be receive by..." readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="number" class="form-control" name="distribution_quantity" id="distribution_quantity" aria-describedby="distributeQuantityHelp" placeholder="Enter Quantity to be distributed..." readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="received_by" id="received_by" placeholder="Will be receive by..." readonly>
                                            </div>
                                        </div>
                                    </fieldset>
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

            <!-- Cancel Modal -->
            <div class="modal fade" id="cancelModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="staticBackdropLabel">Supply Cancelation</h2>
                        </div>
                        <form action="confirmSupply/toCancelSupply.php" method="POST">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="form-group mb-3">
                                        <img src="img/warning.png" class="rounded mx-auto d-block" alt="bulsu-logo" style="width: 200px;">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <p class="text-center fs-5" style="color: red;">Are you sure you want to cancel this supply.</p>
                                </div>

                                <div class="row mb-3">
                                    <fieldset>
                                        <legend>Supply Details</legend>
                                        <hr>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="supply_id_cancel" id="supply_id_cancel" placeholder="Supply Id" class="form-control form-cntrol-sm" readonly>
                                            </div> 
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="supply_name_cancel" id="supply_name_cancel" placeholder="Supply Name" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="supply_brand_cancel" id="supply_brand_cancel" placeholder="Brand" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="supply_unit_cancel" id="supply_unit_cancel" placeholder="Supply Unit" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <textarea class="form-control" name="supply_description_cancel" id="supply_description_cancel" rows="5" placeholder="Description. . ." readonly></textarea>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <legend>Distribution Details</legend>
                                        <hr>

                                        <div class='row'>
                                            <div class='form-group mb-3'>
                                                <input type='text' name='distribution_no_cancel' id='distribution_no_cancel' placeholder='Distribution No' class='form-control form-cntrol-sm' readonly>
                                            </div> 
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="distribution_date" class="form-label">Distribution Date</label>
                                                <input type="date" class="form-control" name="distribution_date_cancel" id="distribution_date_cancel" placeholder="Distribution Date" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="location_cancel" id="location_cancel" placeholder="Will be receive by..." readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="number" class="form-control" name="distribution_quantity_cancel" id="distribution_quantity_cancel" aria-describedby="distributeQuantityHelp" placeholder="Enter Quantity to be distributed..." readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="received_by_cancel" id="received_by_cancel" placeholder="Will be receive by..." readonly>
                                            </div>
                                        </div>
                                    </fieldset>
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

        </div>
    </div>

    <script src="confirmSupply/loadPendingSupplyData.js"></script>
    <script src="lib/sweetalert.min.js"></script>
    <script src="script/signOut.js"></script>
    
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

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
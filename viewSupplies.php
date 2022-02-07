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

    <!-- Jquery -->
    <script src="lib/jquery-3.6.0.min.js"></script>
    <script src="lib/jquery.validate.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/9d1d9a82d2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="img/icon.png">

    <title>View Supplies</title>
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
                            <i class="fas fa-box fs-2" style="color: #1c6cab;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: #1c6cab;">View Supplies</span>
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
            <h1>View Supplies</h1>
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
                                    
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSupplyModal">Add Supply</button>
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

            <!-------- Add Supply Modal -------->
            <!-------- Add Supply Modal -------->
            <!-------- Add Supply Modal -------->
            <!-------- Add Supply Modal -------->
            <!-------- Add Supply Modal -------->
            <div class="modal fade" id="addSupplyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="staticBackdropLabel">Add Supply</h2>
                        </div>
                        <form action="viewSupplies/toAddSupply.php" id="add-supply" method="POST">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-2"></div>

                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <img src="img/BULSU-LOGO.png" class="rounded mx-auto d-block" alt="bulsu-logo" style="width: 200px;">
                                            </div>
                                        </div>
                                        
                                        <?php
                                            $valid = true;

                                            $empId = 0;

                                            $code = "SPLY-";
                                            $dt = new DateTime();
                                            $getYear = $dt->format("Y");

                                            $randNum = rand(1000000,10000000);
                                            $year = "-" . $getYear;
                                            $empId = $code . strval($randNum) . $year;

                                            $servername='localhost';
                                            $username='u581335818_capstonev5_db';
                                            $password='TBwK?U9i!9r';
                                            $dbname = "u581335818_capstonev5_db";

                                            $con = mysqli_connect($servername, $username, $password, $dbname);

                                            if(!$con){
                                                die('Could not Connect My Sql:' .mysql_error());
                                                exit();
                                            }

                                            $select = "SELECT * FROM supply_inventory";
                                            $result = mysqli_query($con, $select);

                                            if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    if($empId == $row["id"]) {
                                                        header("Refresh: 0; url=addSupply.php");
                                                    }
                                                }
                                            }

                                            echo
                                            "<div class='row'>
                                                <div class='form-group mb-3'>
                                                    <input type='text' name='supplyId' id='supplyId' placeholder='Supply Id' class='form-control form-cntrol-sm' readonly value='".$empId."'>
                                                </div> 
                                            </div>";
                                        ?>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="supplyName" id="supplyName" aria-describedby="supplyNameHelp" placeholder="Supply Name">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="supplyBrand" id="supplyBrand" aria-describedby="supplyBrandHelp" placeholder="Brand">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="supplyReceiversName" id="supplyReceiversName" aria-describedby="supplyReceiversNameHelp" placeholder="Receiver's Name">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <select class="form-select" aria-label="Supply Unit Select" name="supplyUnit" id="supplyUnit">
                                                    <option value="" disabled="disabled" selected>Choose a unit</option>
                                                    <option value="per bottle">per bottle</option>
                                                    <option value="per rim">per rim</option>
                                                    <option value="per box">per box</option>
                                                    <option value="per sachet">per sachet</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="number" class="form-control" name="supplyQuantity" id="supplyQuantity" aria-describedby="supplyQuantityHelp" placeholder="Quantity">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="supplyDateArrived" class="form-label">Date Arrived</label>
                                                <input type="date" class="form-control" name="supplyDateArrived" id="supplyDateArrived" aria-describedby="supplyDateArrivedHelp" placeholder="Date Arrived">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <textarea class="form-control" name="supplyOtherInfo" id="supplyOtherInfo" rows="5" placeholder="Description. . ."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetSupplyForm()">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-------- Distribute Modal -------->
            <!-------- Distribute Modal -------->
            <!-------- Distribute Modal -------->
            <!-------- Distribute Modal -------->
            <!-------- Distribute Modal -------->
            <div class="modal fade" id="distributeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="staticBackdropLabel">Distribute Supply</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="viewSupplies/toDistributeSupply.php" method="POST" id="distribute-supply">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row-sm-3"></div>

                                <div class="row-sm-6">
                                    <div class="container">
                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <img src="img/BULSU-LOGO.png" class="rounded mx-auto d-block" alt="bulsu-logo" style="width: 200px;">
                                            </div>
                                        </div>
                                    </div>

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
                                                <input type="number" class="form-control" name="supply_quantity_distribute" id="supply_quantity_distribute" placeholder="Quantity" readonly>
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

                                        <?php
                                            $valid = true;

                                            $empId = 0;
            
                                            $code = "SPDT-";
                                            $dt = new DateTime();
                                            $getYear = $dt->format("Y");
            
                                            $randNum = rand(1000000,10000000);
                                            $year = $getYear;
                                            $empId = $code . strval($randNum) . "-" . $year;
            
                                            $servername='localhost';
                                            $username='u581335818_capstonev5_db';
                                            $password='TBwK?U9i!9r';
                                            $dbname = "u581335818_capstonev5_db";
            
                                            $con = mysqli_connect($servername, $username, $password, $dbname);
            
                                            if(!$con){
                                                die('Could not Connect My Sql:' .mysql_error());
                                                exit();
                                            }
            
                                            $select = "SELECT * FROM supply_inventory";
                                            $result = mysqli_query($con, $select);
            
                                            if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    if($empId == $row["id"]) {
                                                        header("Refresh: 0; url=viewSupplies.php");
                                                    }
                                                }
                                            }
    
                                            echo
                                            "<div class='row'>
                                                <div class='form-group mb-3'>
                                                    <input type='text' name='distribution_no' id='distribution_no' placeholder='Distribution No' class='form-control form-cntrol-sm' readonly value='".$empId."'>
                                                </div> 
                                            </div>";
                                        ?>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="distribution_date" class="form-label">Distribution Date</label>
                                                <input type="date" class="form-control" name="distribution_date" id="distribution_date" placeholder="Distribution Date">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <?php include "util/bulsuOffices.php"; distributeSupplyOffices(); ?>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="number" class="form-control" name="distribution_quantity" id="distribution_quantity" aria-describedby="distributeQuantityHelp" placeholder="Enter Quantity to be distributed...">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" class="form-control" name="received_by" id="received_by" placeholder="Will be receive by...">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="row-sm-3"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Done</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-------- Edit Modal -------->
            <!-------- Edit Modal -------->
            <!-------- Edit Modal -------->
            <!-------- Edit Modal -------->
            <!-------- Edit Modal -------->
            <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="staticBackdropLabel">Edit Supply</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="viewSupplies/toEditSupply.php" method="POST" id="edit-supply">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="row-sm-3"></div>

                                    <div class="row-sm-6">
                                        <div class="container">
                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <img src="img/BULSU-LOGO.png" class="rounded mx-auto d-block" alt="bulsu-logo" style="width: 200px;">
                                                </div>
                                            </div>
                                        </div>

                                        <fieldset>
                                            <legend>Supply Details</legend>
                                            <hr>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="text" name="supply_id_edit" id="supply_id_edit" placeholder="Supply Id" class="form-control form-cntrol-sm" readonly>
                                                </div> 
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control" name="supply_name_edit" id="supply_name_edit" placeholder="Supply Name">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control" name="supply_brand_edit" id="supply_brand_edit" placeholder="Brand">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control" name="supply_receivers_name_edit" id="supply_receivers_name_edit" placeholder="Receiver's Name">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control" name="supply_unit_edit" id="supply_unit_edit" placeholder="Supply Unit" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <select class="form-select" aria-label="supply_unit_select" name="supplyUnit" id="supplyUnit" onchange="changeUnit(event)">
                                                        <option value="" disabled="disabled" selected>Choose a unit</option>
                                                        <option value="per bottle">per bottle</option>
                                                        <option value="per rim">per rim</option>
                                                        <option value="per box">per box</option>
                                                        <option value="per sachet">per sachet</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="number" class="form-control" name="supply_quantity_edit" id="supply_quantity_edit" placeholder="Quantity">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <label for="supply_date_arrived_edit" class="form-label">Date Arrived</label>
                                                    <input type="date" class="form-control" name="supply_date_arrived_edit" id="supply_date_arrived_edit" placeholder="Distribution Date">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" name="supply_description_edit" id="supply_description_edit" rows="5" placeholder="Description. . ."></textarea>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="row-sm-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-------- Delete Modal -------->
            <!-------- Delete Modal -------->
            <!-------- Delete Modal -------->
            <!-------- Delete Modal -------->
            <!-------- Delete Modal -------->
            <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="staticBackdropLabel">Delete Supply</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="viewSupplies/toDeleteSupply.php" method="POST">
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="row-sm-3"></div>

                                    <div class="row-sm-6">
                                    <div class="container">
                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <img src="img/BULSU-LOGO.png" class="rounded mx-auto d-block" alt="bulsu-logo" style="width: 200px;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <img src="img/warning.png" class="rounded mx-auto d-block" alt="..." style="width: 150px;">
                                        </div>

                                        <div class="d-flex justify-content-center" style="height: 100px;">
                                            <h3 style="color: red;">Are you sure you want to delete this supply?</h3>
                                        </div>

                                        <fieldset>
                                            <legend>Supply Details</legend>
                                            <hr>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="text" name="supply_id_delete" id="supply_id_delete" placeholder="Supply Id" class="form-control form-cntrol-sm" readonly>
                                                </div> 
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control" name="supply_name_delete" id="supply_name_delete" placeholder="Supply Name" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control" name="supply_brand_delete" id="supply_brand_delete" placeholder="Brand" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control" name="supply_receivers_name_delete" id="supply_receivers_name_delete" placeholder="Receiver's Name" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control" name="supply_unit_delete" id="supply_unit_delete" placeholder="Supply Unit" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="number" class="form-control" name="supply_quantity_delete" id="supply_quantity_delete" placeholder="Quantity" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <label for="supply_date_arrived_delete" class="form-label">Date Arrived</label>
                                                    <input type="date" class="form-control" name="supply_date_arrived_delete" id="supply_date_arrived_delete" placeholder="Distribution Date" readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-3">
                                                    <textarea class="form-control" name="supply_description_delete" id="supply_description_delete" rows="5" placeholder="Description. . ." readonly></textarea>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="row-sm-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="viewSupplies/validateEditSupply.js"></script>
    <script src="viewSupplies/validateDistributeSupply.js"></script>
    <script src="viewSupplies/loadViewSuppliesData.js"></script>
    <script src="lib/sweetalert.min.js"></script>
    <script src="script/signOut.js"></script>
    <script src="viewSupplies/validateAddSupply.js"></script>

    <script>
        function resetSupplyForm() {
            document.getElementById("add-supply").reset();
        }
    </script>

    <script>
        function changeUnit(e){
            document.getElementById("supply_unit_edit").value = e.target.value;
        }
    </script>
    <script>
        function changeUnit(e){
            document.getElementById("supply_unit_edit").value = e.target.value;
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

    <script>
        function resetDistribution() {
            document.getElementById("supply-distribute").reset();
        }
    </script>

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
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

    <title>Distribute Equipment</title>
</head>
<body onload="loadSelectedData()">
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
                            <i class="fas fa-truck-loading fs-2" style="color: #1c6cab;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: #1c6cab;">Distribute Equipment</span>
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
            <h1>Distribute Equipment</h1>
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

                                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#selectedEquipmentModal">Selected Equipment</button>

                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEquipmentModal">Add Equipment</button>
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

        <!-- Selected Equipment Modal -->
        <div class="modal fade" id="selectedEquipmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">Selected Equipment</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container table-responsive">
                            <div style="height: 350px;" class="overflow-scroll">
                                <div id="selected">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="remove()">Remove All</button>
                        <form action="distributeEquipment/toDistributeDistributeEquipment.php" method="POST">
                            <button type="submit" class="btn btn-primary">Distribute</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Equipment Modal -->
        <div class="modal fade" id="addEquipmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="staticBackdropLabel">Add Equipment</h2>
                    </div>
                    <form action="distributeEquipment/toAddEquipment.php" id="add-equipment" method="POST">
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
                                    $empId = 0;

                                    $code = "EQP-";
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

                                    $select = "SELECT * FROM equipment_inventory";
                                    $result = mysqli_query($con, $select);

                                    if($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            if($empId == $row["id"]) {
                                                header("Refresh: 0; url=addEquipment.php");
                                            }
                                        }
                                    }

                                    echo
                                    "<div class='row'>
                                        <div class='form-group mb-3'>
                                            <input type='text' name='equipmentId' id='equipmentId' placeholder='Equipment Id' class='form-control form-cntrol-sm' readonly value='".$empId."'>
                                        </div> 
                                    </div>";
                                ?>

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="equipmentName" id="equipmentName" aria-describedby="equipmentNameHelp" placeholder="Equipment Name">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="equipmentBrand" id="equipmentBrand" aria-describedby="equipmentBrandHelp" placeholder="Brand">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="equipmentReceiversName" id="equipmentReceiversName" aria-describedby="equipmentReceiversNameHelp" placeholder="Receiver's Name">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <input type="number" class="form-control" name="equipmentQuantity" id="equipmentQuantity" aria-describedby="equipmentQuantityHelp" placeholder="Quantity">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <label for="supplyDateArrived" class="form-label">Date Arrived</label>
                                        <input type="date" class="form-control" name="equipmentDateArrived" id="equipmentDateArrived" aria-describedby="equipmentDateArrivedHelp" placeholder="Date Arrived">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <textarea class="form-control" name="equipmentDescription" id="equipmentDescription" rows="5" placeholder="Description. . ."></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetForm()">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Select Modal -->
        <div class="modal fade" id="selectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="staticBackdropLabel">Select Equipment</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="distributeEquipment/toSelectDistributeEquipment.php" method="POST" id="equipment-distribute">
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

                                    <fieldset>
                                        <legend>Equipment Details</legend>
                                        <hr>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="equipment_id_select" id="equipment_id_select" placeholder="Equipment Id" class="form-control form-cntrol-sm" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="equipment_name_select" id="equipment_name_select" placeholder="Equipment Name" class="form-control form-cntrol-sm" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="equipment_brand_select" id="equipment_brand_select" placeholder="Equipment Brand" class="form-control form-cntrol-sm" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="equipment_receivers_name_select" id="equipment_receivers_name_select" placeholder="Receivers Name" class="form-control form-cntrol-sm" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="number" name="equipment_quantity_select" id="equipment_quantity_select" placeholder="Equipment Quantity" class="form-control form-cntrol-sm" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="equipment_date_arrived_edit" class="form-label">Date Arrived</label>
                                                <input type="date" class="form-control" name="equipment_date_arrived_select" id="equipment_date_arrived_select" placeholder="Date Arrived" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <textarea class="form-control" name="equipment_description_select" id="equipment_description_select" rows="5" placeholder="Description. . ." readonly></textarea>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <legend>Distribution Details</legend>
                                        <hr>

                                        <?php
                                            $empId = 0;

                                            $code = "DSTR-";
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

                                            $select = "SELECT * FROM distributed_equipment";
                                            $result = mysqli_query($con, $select);

                                            if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    if($empId == $row["id"]) {
                                                        header("Refresh: 0; url=distributeEquipment.php");
                                                    }
                                                }
                                            }

                                            echo
                                            '<div class="row">
                                                <div class="form-group mb-3">
                                                    <input type="text" name="distribution_no" id="distribution_no" placeholder="Distribution No." class="form-control form-cntrol-sm" value="'.$empId.'" readonly>
                                                </div>
                                            </div>';
                                        ?>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="distribution_date" class="form-label">Distribution Date</label>
                                                <input type="date" class="form-control" name="distribution_date" id="distribution_date" placeholder="Distribution Date" value="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <?php include "util/bulsuOffices.php"; distributeSupplyOffices(); ?>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="number" name="distribution_quantity" id="distribution_quantity" placeholder="Distribution Quantity" class="form-control form-cntrol-sm" value="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="in_charge_to" id="in_charge_to" placeholder="Person will be in charge" class="form-control form-cntrol-sm" value="">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row-sm-3"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="reset()">Close</button>
                        <button type="submit" class="btn btn-primary">Select</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="staticBackdropLabel">Edit Equipment</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="distributeEquipment/toEditDistributeEquipment.php" method="POST" id="edit-distribute">
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

                                    <fieldset>
                                        <legend>Equipment Details</legend>
                                        <hr>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="equipment_id_edit" id="equipment_id_edit" placeholder="Equipment Id" class="form-control form-cntrol-sm" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="equipment_name_edit" id="equipment_name_edit" placeholder="Equipment Name" class="form-control form-cntrol-sm">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="equipment_brand_edit" id="equipment_brand_edit" placeholder="Equipment Brand" class="form-control form-cntrol-sm">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="equipment_receivers_name_edit" id="equipment_receivers_name_edit" placeholder="Receivers Name" class="form-control form-cntrol-sm">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="number" name="equipment_quantity_edit" id="equipment_quantity_edit" placeholder="Equipment Quantity" class="form-control form-cntrol-sm">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="equipment_date_arrived_edit" class="form-label">Date Arrived</label>
                                                <input type="date" class="form-control" name="equipment_date_arrived_edit" id="equipment_date_arrived_edit" placeholder="Date Arrived">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <textarea class="form-control" name="equipment_description_edit" id="equipment_description_edit" rows="5" placeholder="Description. . ."></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row-sm-3"></div>
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

    </div>

    <script src="distributeEquipment/loadEquipmentInventory.js"></script>
    <script src="distributeEquipment/validateSelectDistributeEquipment.js"></script>
    <script src="distributeEquipment/validateEditDistribute.js"></script>
    <script src="distributeEquipment/ajaxLoadSelectedDistributeEquipment.js"></script>
    <script src="distributeEquipment/removeAllSelected.js"></script>
    <script src="lib/sweetalert.min.js"></script>
    <script src="script/signOut.js"></script>
    <script src="distributeEquipment/validateAddEquipment.js"></script>

    <script>
        function resetForm() {
            document.getElementById("add-equipment").reset();
        }
    </script>

    <script>
        function reset(){
            document.getElementById("equipment-distribute").reset;
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
        function resetDistributeEquipment() {
            document.getElementById("equipment-distribute").reset();
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
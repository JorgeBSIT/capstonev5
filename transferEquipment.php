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

    <title>Transfer Equipment</title>
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
                            <i class="fas fa-exchange-alt fs-2" style="color: #1c6cab;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: #1c6cab;">Transfer Equipment</span>
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
            <h1>Transfer Equipment</h1>
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
                        <form action="transferEquipment/toDistributeTransferEquipment.php" method="POST">
                            <button type="submit" class="btn btn-primary">Transfer</button>
                        </form>
                    </div>
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
                    <form action="transferEquipment/toSelectTransferEquipment.php" method="POST" id="transfer-equipment">
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
                                                <input type="text" name="equipment_distribution_no_select" id="equipment_distribution_no_select" placeholder="Equipment Id" class="form-control form-cntrol-sm" readonly>
                                            </div>
                                        </div>

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
                                                <textarea class="form-control" name="equipment_description_select" id="equipment_description_select" rows="5" placeholder="Description. . ." readonly></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="equipment_date_distribution_select" class="form-label">Date Distributed</label>
                                                <input type="date" class="form-control" name="equipment_date_distribution_select" id="equipment_date_distribution_select" placeholder="Date Arrived" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="number" name="equipment_quantity_select" id="equipment_quantity_select" placeholder="Equipment Quantity" class="form-control form-cntrol-sm" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="equipment_in_charge_select" id="equipment_in_charge_select" placeholder="Person In Charge" class="form-control form-cntrol-sm" readonly>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <legend>Transfer Details</legend>
                                        <hr>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <label for="transfer_date" class="form-label">Transfer Date</label>
                                                <input type="date" class="form-control" name="transfer_date" id="transfer_date" placeholder="Transfer Date" value="">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="equipment_location_select" id="equipment_location_select" placeholder="Location" class="form-control form-cntrol-sm" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <select name="location" id="location" class="form-select" aria-label="Default select example" onchange="changeLocationTransfer(event)">
                                                    <option value="" selected="true" disabled="disabled">Select Destination</option> 
                                                    <option value="" disabled="disabled">Executeive Offices</option> 
                                                    <option value="Office of the University President">Office of the University President</option>
                                                    <option value="Office of the Executive Vice President">Office of the Executive Vice President</option>
                                                    <option value="Office of the Vice President for Research, Development, and Extension">Office of the Vice President for Research, Development, and Extension</option>
                                                    <option value="Office of the Vice President for Administration and Finance">Office of the Vice President for Administration and Finance</option>
                                                    <option value="Office of the Vice President for Academic Affairs">Office of the Vice President for Academic Affairs</option>
                                                    <option value="" disabled="disabled">Dean's Office</option> 
                                                    <option value="College of Architecture and Fine Arts">College of Architecture and Fine Arts</option>
                                                    <option value="College of Arts and Letters">College of Arts and Letters</option>
                                                    <option value="College of Business Administration">College of Business Administration</option>
                                                    <option value="College of Communication and Information Technology">College of Communication and Information Technology</option>
                                                    <option value="College of Criminal Justice Education">College of Criminal Justice Education</option>
                                                    <option value="College of Education">College of Education</option>
                                                    <option value="College of Engineering">College of Engineering</option>
                                                    <option value="College of Hospitality and Tourism Management">College of Hospitality and Tourism Management</option>
                                                    <option value="College of Industrial Technology">College of Industrial Technology</option>
                                                    <option value="College of Law">College of Law</option>
                                                    <option value="College of Nursing">College of Nursing</option>
                                                    <option value="College of Science">College of Science</option>
                                                    <option value="College of Social Sciences and Philosophy">College of Social Sciences and Philosophy</option>
                                                    <option value="College of Sports, Exercise and Recreation">College of Sports, Exercise and Recreation</option>
                                                    <option value="Graduate School">Graduate School</option>
                                                    <option value="Laboratory High School">Laboratory High School</option>
                                                    <option value="" disabled="disabled">College Libraries</option> 
                                                    <option value="College of Architecture and Fine Arts Library">College of Architecture and Fine Arts Library</option>
                                                    <option value="College of Arts and Letters Library">College of Arts and Letters Library</option>
                                                    <option value="College of Communication and Information Technology Library">College of Communication and Information Technology Library</option>
                                                    <option value="College of Education Library">College of Education Library</option>
                                                    <option value="College of Engineering Library">College of Engineering Library</option>
                                                    <option value="College of Hospitality and Tourism Management Library">College of Hospitality and Tourism Management Library</option>
                                                    <option value="College of Industrial Technology Library">College of Industrial Technology Library</option>
                                                    <option value="College of Law Library">College of Law Library</option>
                                                    <option value="College of Nursing Library">College of Nursing Library</option>
                                                    <option value="College of Science Library">College of Science Library</option>
                                                    <option value="College of Social Sciences and Philosophy Library">College of Social Sciences and Philosophy Library</option>
                                                    <option value="Graduate School Library">Graduate School Library</option>
                                                    <option value="" disabled="disabled">Bulsu Offices</option> 
                                                    <option value="Accounting">Accounting</option>
                                                    <option value="Admission">Admission</option>
                                                    <option value="Alumni">Alumni</option>
                                                    <option value="Budget Office">Budget Office</option>
                                                    <option value="Cashier">Cashier</option>
                                                    <option value="Center for Bulacan Studies">Center for Bulacan Studies</option>
                                                    <option value="Central Receiving Unit (Operator)">Central Receiving Unit (Operator)</option>
                                                    <option value="Chancellor - Main">Chancellor - Main</option>
                                                    <option value="Chief Admin Officer">Chief Admin Officer</option>
                                                    <option value="Chief Finance Officer">Chief Finance Officer</option>
                                                    <option value="Clinic">Clinic</option>
                                                    <option value="Communications Office">Communications Office</option>
                                                    <option value="Confucius Institute">Confucius Institute</option>
                                                    <option value="Electrical Office">Electrical Office</option>
                                                    <option value="Extension Office">Extension Office</option>
                                                    <option value="Food Testing Lab">Food Testing Lab</option>
                                                    <option value="Gate 1">Gate 1</option>
                                                    <option value="General Services - Facilities Management and Maintenance Office (FMMO)">General Services - Facilities Management and Maintenance Office (FMMO)</option>
                                                    <option value="Guidance Center">Guidance Center</option>
                                                    <option value="Hostel">Hostel</option>
                                                    <option value="Hostel Annex">Hostel Annex</option>
                                                    <option value="Human Resource Management Office (HRMO) - Payroll">Human Resource Management Office (HRMO) - Payroll</option>
                                                    <option value="Management Information System (MIS)">Management Information System (MIS)</option>
                                                    <option value="National Service Training Program (NSTP)">National Service Training Program (NSTP)</option>
                                                    <option value="Planning and Information">Planning and Information</option>
                                                    <option value="Procurement Office (BAC)">Procurement Office (BAC)</option>
                                                    <option value="Project Management Office (PMO)">Project Management Office (PMO)</option>
                                                    <option value="Public Assistance Desk (Admin)">Public Assistance Desk (Admin)</option>
                                                    <option value="Records Office">Records Office</option>
                                                    <option value="Registrar\'s Office">Registrar\'s Office</option>
                                                    <option value="Research Office">Research Office</option>
                                                    <option value="Scholarship Office">Scholarship Office</option>
                                                    <option value="Sports Director - Valencia Hall">Sports Director - Valencia Hall</option>
                                                    <option value="Student Organization">Student Organization</option>
                                                    <option value="Student Publication">Student Publication</option>
                                                    <option value="Supply Office">Supply Office</option>
                                                    <option value="" disabled="disabled">Satellite Campus</option> 
                                                    <option value="Bustos Campus">Bustos Campus</option>
                                                    <option value="Hagonoy Campus">Hagonoy Campus</option>
                                                    <option value="Meneses Campus">Meneses Campus</option>
                                                    <option value="Pulilan Extension">Pulilan Extension</option>
                                                    <option value="Sarmiento Campus">Sarmiento Campus</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-3">
                                                <input type="text" name="new_person_in_charge" id="new_person_in_charge" placeholder="New Person In Charge" class="form-control form-cntrol-sm">
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

    </div>

    <script src="transferEquipment/loadTransferEquipment.js"></script>
    <script src="transferEquipment/removeAllSelectedTransfer.js"></script>
    <script src="transferEquipment/ajaxLoadSelectedTransferEquipment.js"></script>
    <script src="transferEquipment/validateTransferEquipment.js"></script>
    <script src="lib/sweetalert.min.js"></script>
    <script src="script/signOut.js"></script>
    <script>
        function reset(){
            document.getElementById("transfer-equipment").reset;
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
        function changeLocationTransfer(e){
            document.getElementById("equipment_location_select").value = e.target.value;
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
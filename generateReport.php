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

    <title>Generate Report</title>
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
                            <i class="fas fa-tachometer-alt fs-2" style="color: white"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white">Dashboard</span>
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
                            <i class="fas fa-clipboard-list fs-2" style="color: #1c6cab;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: #1c6cab;">Generate Report</span>
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
            <h1>Generate Report</h1>
            <hr>

            <div class="container shadow-lg p-3 mb-5 bg-body rounded">
                <h2>Supply Inventory</h2>
                <hr>

                <div class="container">
                    <div class="row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#weeklySupply" type="button" role="tab" aria-controls="home" aria-selected="true">Weekly</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#monthlySupply" type="button" role="tab" aria-controls="profile" aria-selected="false">Monthly</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#yearlySupply" type="button" role="tab" aria-controls="contact" aria-selected="false">Yearly</button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="weeklySupply" role="tabpanel" aria-labelledby="home-tab">
                        <div style="height: 350px;" class="table-responsive">
                            <table class="table table-striped table-hover mt-4 text-center table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Supply Id</th>
                                        <th scope="col">Supply Name</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Receiver's Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Date Arrived</th>
                                        <th scope="col">Other Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $servername='localhost';
                                        $username='u581335818_capstonev5_db';
                                        $password='TBwK?U9i!9r';
                                        $dbname = "u581335818_capstonev5_db";
                                
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $counter = 1;

                                        $dt = new DateTime(date("Y-m-d"));
                                        $year = $dt->format("Y");

                                        $select = "SELECT * FROM supply_inventory";
                                        $result = mysqli_query($con, $select);

                                        if($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $getDays = intval($row['days']);
                                                $dt = new DateTime($row["date_arrived"]);
                                                $getYear = $dt->format("Y");

                                                if($getDays <= 7 && $getYear == $year) {
                                                    echo "<tr>";
                                                        echo "<th>".$counter++."</th>";
                                                        echo "<td>".$row['id']."</td>";
                                                        echo "<td>".$row['name']."</td>";
                                                        echo "<td>".$row['brand']."</td>";
                                                        echo "<td>".$row['receivers_name']."</td>";
                                                        echo "<td>".$row['quantity']."</td>";
                                                        echo "<td>".$row['date_arrived']."</td>";
                                                        echo "<td>".$row['description']."</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }

                                        mysqli_close($con);
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div style="height: 80px">
                            <a type="button" class="btn btn-success mt-4" href="reports/printWeeklySupply.php" target="_blank">View Weekly Supply</a>
                            <a type="button" class="btn btn-primary mt-4" href="reports/printAllSupply.php" target="_blank">View All Supply</a>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="monthlySupply" role="tabpanel" aria-labelledby="profile-tab">
                        <div style="height: 350px;" class="table-responsive">
                            <table class="table table-striped table-hover mt-4 text-center table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Supply Id</th>
                                        <th scope="col">Supply Name</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Receiver's Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Date Arrived</th>
                                        <th scope="col">Other Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $servername='localhost';
                                        $username='u581335818_capstonev5_db';
                                        $password='TBwK?U9i!9r';
                                        $dbname = "u581335818_capstonev5_db";
                                
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $counter = 1;

                                        $dt = new DateTime(date("Y-m-d"));
                                        $month = $dt->format("m");
                                        $year = $dt->format("Y");

                                        $select = "SELECT * FROM supply_inventory";
                                        $result = mysqli_query($con, $select);

                                        if($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $dt = new DateTime($row["date_arrived"]);
                                                $getMonth = $dt->format("m");
                                                $getYear = $dt->format("Y");

                                                if($getMonth == $month && $getYear == $year) {
                                                    echo "<tr>";
                                                        echo "<th>".$counter++."</th>";
                                                        echo "<td>".$row['id']."</td>";
                                                        echo "<td>".$row['name']."</td>";
                                                        echo "<td>".$row['brand']."</td>";
                                                        echo "<td>".$row['receivers_name']."</td>";
                                                        echo "<td>".$row['quantity']."</td>";
                                                        echo "<td>".$row['date_arrived']."</td>";
                                                        echo "<td>".$row['description']."</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }

                                        mysqli_close($con);
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div style="height: 80px">
                            <a type="button" class="btn btn-success mt-4" href="reports/printMonthlySupply.php" target="_blank">View Monthly Supply</a>
                            <a type="button" class="btn btn-primary mt-4" href="reports/printAllSupply.php" target="_blank">View All Supply</a>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="yearlySupply" role="tabpanel" aria-labelledby="contact-tab">
                        <div style="height: 350px;" class="table-responsive">
                            <table class="table table-striped table-hover mt-4 text-center table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Supply Id</th>
                                        <th scope="col">Supply Name</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Receiver's Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Date Arrived</th>
                                        <th scope="col">Other Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $servername='localhost';
                                        $username='u581335818_capstonev5_db';
                                        $password='TBwK?U9i!9r';
                                        $dbname = "u581335818_capstonev5_db";
                                
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $counter = 1;

                                        $dt = new DateTime(date("Y-m-d"));
                                        $year = $dt->format("Y");

                                        $select = "SELECT * FROM supply_inventory";
                                        $result = mysqli_query($con, $select);

                                        if($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $dt = new DateTime($row["date_arrived"]);
                                                $getYear = $dt->format("Y");

                                                if($getYear == $year) {
                                                    echo "<tr>";
                                                        echo "<th>".$counter++."</th>";
                                                        echo "<td>".$row['id']."</td>";
                                                        echo "<td>".$row['name']."</td>";
                                                        echo "<td>".$row['brand']."</td>";
                                                        echo "<td>".$row['receivers_name']."</td>";
                                                        echo "<td>".$row['quantity']."</td>";
                                                        echo "<td>".$row['date_arrived']."</td>";
                                                        echo "<td>".$row['description']."</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }

                                        mysqli_close($con);
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div style="height: 80px">
                            <a type="button" class="btn btn-success mt-4" href="reports/printYearlySupply.php" target="_blank">View Yearly Supply</a>
                            <a type="button" class="btn btn-primary mt-4" href="reports/printAllSupply.php" target="_blank">View All Supply</a>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <h2>Equipment Inventory</h2>
                    <hr>

                    <div class="container">
                        <div style="height: 350px;" class="table-responsive">
                            <table class="table table-striped table-hover mt-4 text-center table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Equipment Id</th>
                                        <th scope="col">Equipment Name</th>
                                        <th scope="col">Equipment Brand</th>
                                        <th scope="col">Receiver's Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Date Arrived</th>
                                        <th scope="col">Other Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $servername='localhost';
                                        $username='u581335818_capstonev5_db';
                                        $password='TBwK?U9i!9r';
                                        $dbname = "u581335818_capstonev5_db";
                                
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $counter = 1;

                                        $select = "SELECT * FROM equipment_inventory";
                                        $result = mysqli_query($con, $select);

                                        if($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $dt = new DateTime($row["date_arrived"]);
                                                $getYear = $dt->format("Y");

                                                if($getYear == $year) {
                                                    echo "<tr>";
                                                        echo "<th>".$counter++."</th>";
                                                        echo "<td>".$row['id']."</td>";
                                                        echo "<td>".$row['name']."</td>";
                                                        echo "<td>".$row['brand']."</td>";
                                                        echo "<td>".$row['receivers_name']."</td>";
                                                        echo "<td>".$row['quantity']."</td>";
                                                        echo "<td>".$row['date_arrived']."</td>";
                                                        echo "<td>".$row['description']."</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }

                                        mysqli_close($con);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div style="height: 80px">
                        <a type="button" class="btn btn-primary mt-4" href="reports/printAllEquipment.php" target="_blank">View All Equipment</a>
                    </div>
                </div>

                <div class="row mt-3">
                    <h2>Distributed Equipment</h2>
                    <hr>

                    <div class="container">
                        <div style="height: 350px;" class="table-responsive">
                            <table class="table table-striped table-hover mt-4 text-center table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Distribution No</th>
                                        <th scope="col">Equipment Id</th>
                                        <th scope="col">Equipment Name</th>
                                        <th scope="col">Equipment Brand</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Date Distributed</th>
                                        <th scope="col">location</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Person In Charge</th>
                                        <th scope="col">Confirmed By</th>
                                        <th scope="col">Transferred Date</th>
                                        <th scope="col">Previous In Charge</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $servername='localhost';
                                        $username='u581335818_capstonev5_db';
                                        $password='TBwK?U9i!9r';
                                        $dbname = "u581335818_capstonev5_db";
                                
                                        $con = mysqli_connect($servername, $username, $password, $dbname);

                                        $counter = 1;

                                        $select = "SELECT * FROM distributed_equipment";
                                        $result = mysqli_query($con, $select);

                                        if($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                        echo "<th>".$counter++."</th>";
                                                        echo "<td>".$row['distribution_no']."</td>";
                                                        echo "<td>".$row['id']."</td>";
                                                        echo "<td>".$row['name']."</td>";
                                                        echo "<td>".$row['brand']."</td>";
                                                        echo "<td>".$row['description']."</td>";
                                                        echo "<td>".$row['distribution_date']."</td>";
                                                        echo "<td>".$row['location']."</td>";
                                                        echo "<td>".$row['distribution_quantity']."</td>";
                                                        echo "<td>".$row['in_charge']."</td>";
                                                        echo "<td>".$row['confirmed_by']."</td>";
                                                        echo "<td>".$row['transferred_date']."</td>";
                                                        echo "<td>".$row['p_in_charge']."</td>";
                                                    echo "</tr>";
                                            }
                                        }

                                        mysqli_close($con);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div style="height: 80px">
                        <a type="button" class="btn btn-primary mt-4" href="reports/printDistributedEquipment.php" target="_blank">View All Distributed Equipment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="lib/sweetalert.min.js"></script>
    <script src="script/signOut.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
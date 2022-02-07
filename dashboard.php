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
    <?php
        include "php/updateInventory.php";
    ?>

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
                            <i class="fas fa-tachometer-alt fs-2" style="color: #1c6cab;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: #1c6cab;">Dashboard</span>
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
            <h1>Dashboard</h1>
            <hr>

            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 mb-2">
                            <div class="p-3 d-flex justify-content-center" style="background-color: #43b968;">
                                <button style="background-color: #43b968; border-style: none;"><i class="fas fa-box fs-2" style="color: white;"> <span class="text-center fs-2" style="color: white;">High on Supply <p style="font-size: 65px;"><?php include "util/highOnSupply.php"; ?></p></span></i></button>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="p-3 d-flex justify-content-center" style="background-color: #f59345;">
                                <button data-bs-toggle="modal" data-bs-target="#low-on-supply" style="background-color: #f59345; border-style: none;"><i class="fas fa-box fs-2" style="color: white;"> <span class="text-center fs-2" style="color: white;">Low on Supply <p style="font-size: 65px;"><?php include "util/lowOnSupply.php"; ?></p></span></i></button>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="p-3 d-flex justify-content-center" style="background-color: #f44236;">
                                <button data-bs-toggle="modal" data-bs-target="#out-of-supply" style="background-color: #f44236; border-style: none;"></a><i class="fas fa-box fs-2" style="color: white;"> <span class="text-center fs-2" style="color: white;">Out of Supply <p style="font-size: 65px;"><?php include "util/outOfSupply.php"; ?></p></span></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="height: 50px;"></div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="row">
                        <div class="container shadow-lg p-3 mb-5 bg-body rounded">
                            <div class="card chart-container">
                                <canvas id="chart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="container shadow-lg p-3 mb-5 bg-body rounded">
                            <h3>Recently Added Supply</h3>

                            <div style="height: 350px;" class="overflow-scroll">
                                <table class="table table-striped table-hover table-bordered text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Supply Name</th>
                                            <th scope="col">Receiver's Name</th>
                                            <th scope="col">Date Arrived</th>
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
                
                                            $select = "SELECT * FROM supply_inventory";
                                            $result = mysqli_query($con, $select);

                                            $dt = new DateTime(date("Y-m-d"));
                                            $year = $dt->format("Y");
                
                                            if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    $dt = new DateTime($row["date_arrived"]);
                                                    $getYear = $dt->format("Y");
                                                    $days = intval($row["days"]);

                                                    if($days <= 7 && $getYear == $year) {
                                                        echo "<tr>";
                                                            echo "<td>".$row['name']."</td>";
                                                            echo "<td>".$row['receivers_name']."</td>";
                                                            echo "<td>".$row['date_arrived']."</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            }
                
                                            mysqli_close($con);
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-grid gap-1 mt-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recentlyAddedSupply">View Full Details</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="container shadow-lg p-3 mb-5 bg-body rounded">
                        <div class="card chart-container">
                            <canvas id="bar" style="height: 775px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-------------- Out of Supply Modal -------------->
    <!-------------- Out of Supply Modal -------------->
    <!-------------- Out of Supply Modal -------------->
    <div class="modal fade" id="out-of-supply" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Out of Supply</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container table-responsive">
                        <div style="height: 350px;" class="overflow-scroll">
                            <table class="table table-striped table-hover table-bordered text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Supply Id</th>
                                        <th scope="col">Supply Name</th>
                                        <th scope="col">Supply Brand</th>
                                        <th scope="col">Receiver's Name</th>
                                        <th scope="col">Supply Unit</th>
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
            
                                        $select = "SELECT * FROM supply_inventory";
                                        $result = mysqli_query($con, $select);
            
                                        if($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $quantity = intval($row["quantity"]);

                                                if($quantity <= 0) {
                                                    echo "<tr>";
                                                        echo "<th>".$counter++."</th>";
                                                        echo "<td>".$row['id']."</td>";
                                                        echo "<td>".$row['name']."</td>";
                                                        echo "<td>".$row['brand']."</td>";
                                                        echo "<td>".$row['receivers_name']."</td>";
                                                        echo "<td>".$row['unit']."</td>";
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
                </div>
            </div>
        </div>
    </div>

    <!-------------- Low on Supply Modal -------------->
    <!-------------- Low on Supply Modal -------------->
    <!-------------- Low on Supply Modal -------------->
    <div class="modal fade" id="low-on-supply" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Low on Supply</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container table-responsive">
                        <div style="height: 350px;" class="overflow-scroll">
                            <table class="table table-striped table-hover table-bordered text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Supply Id</th>
                                        <th scope="col">Supply Name</th>
                                        <th scope="col">Supply Brand</th>
                                        <th scope="col">Receiver's Name</th>
                                        <th scope="col">Supply Unit</th>
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
            
                                        $select = "SELECT * FROM supply_inventory";
                                        $result = mysqli_query($con, $select);
            
                                        if($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $quantity = intval($row["quantity"]);

                                                if($quantity <= 10) {
                                                    echo "<tr>";
                                                        echo "<th>".$counter++."</th>";
                                                        echo "<td>".$row['id']."</td>";
                                                        echo "<td>".$row['name']."</td>";
                                                        echo "<td>".$row['brand']."</td>";
                                                        echo "<td>".$row['receivers_name']."</td>";
                                                        echo "<td>".$row['unit']."</td>";
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
                </div>
            </div>
        </div>
    </div>

    <!-------------- Recetly Added Supply Modal -------------->
    <!-------------- Recetly Added Supply Modal -------------->
    <!-------------- Recetly Added Supply Modal -------------->
    <div class="modal fade" id="recentlyAddedSupply" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Recently Added Supply</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container table-responsive">
                        <div style="height: 350px;" class="overflow-scroll">
                            <table class="table table-striped table-hover table-bordered text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Supply Id</th>
                                        <th scope="col">Supply Name</th>
                                        <th scope="col">Supply Brand</th>
                                        <th scope="col">Receiver's Name</th>
                                        <th scope="col">Supply Unit</th>
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
            
                                        $select = "SELECT * FROM supply_inventory";
                                        $result = mysqli_query($con, $select);

                                        $dt = new DateTime(date("Y-m-d"));
                                        $year = $dt->format("Y");
            
                                        if($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $dt = new DateTime($row["date_arrived"]);
                                                $getYear = $dt->format("Y");
                                                $days = intval($row["days"]);

                                                if($days <= 7 && $getYear == $year) {
                                                    echo "<tr>";
                                                        echo "<th>".$counter++."</th>";
                                                        echo "<td>".$row['id']."</td>";
                                                        echo "<td>".$row['name']."</td>";
                                                        echo "<td>".$row['brand']."</td>";
                                                        echo "<td>".$row['receivers_name']."</td>";
                                                        echo "<td>".$row['unit']."</td>";
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
                </div>
            </div>
        </div>
    </div>

    <script src="lib/sweetalert.min.js"></script>
    <script src="script/signOut.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <script>
        const ctx = document.getElementById("chart").getContext('2d');
        const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Supply", "Equipment"],
            datasets: [{
            label: 'Inventory',
            data: ["<?php
                //------------------ SUPPLY ------------------//
                //------------------ SUPPLY ------------------//
                //------------------ SUPPLY ------------------//
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $supply = 0;

                $select = "SELECT * FROM supply_inventory";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $supply++;
                    }
                }

                echo $supply;

                mysqli_close($con);
            ?>", "<?php
            //------------------ EQUIPMENT ------------------//
            //------------------ EQUIPMENT ------------------//
            //------------------ EQUIPMENT ------------------//
            $servername='localhost';
            $username='u581335818_capstonev5_db';
            $password='TBwK?U9i!9r';
            $dbname = "u581335818_capstonev5_db";
    
            $con = mysqli_connect($servername, $username, $password, $dbname);

            $equipment = 0;

            $select = "SELECT * FROM equipment_inventory";
            $result = mysqli_query($con, $select);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $equipment++;
                }
            }

            echo $equipment;

            mysqli_close($con);
        ?>"],
            backgroundColor: ["#132e48", "#1c6cab"]
            }]
        },
    });
    </script>
    
    <script>
        const ctxLine = document.getElementById("bar").getContext('2d');
        const myBarChart = new Chart(ctxLine, {
        type: 'bar',
        data: {
            labels: ["Monday", "Tuesday", "Wednesday",
            "Thursday", "Friday", "Saturday", "Sunday"],
            datasets: [{
            label: 'Supply Chart',
            backgroundColor: 'rgba(6, 46, 92, 0.88)',
            borderColor: 'rgba(6, 46, 92, 0.88)',
            data: ["<?php
                //------------------ MONDAY ------------------//
                //------------------ MONDAY ------------------//
                //------------------ MONDAY ------------------//
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $monday = 0;

                $select = "SELECT * FROM supply_inventory";
                $result = mysqli_query($con, $select);

                $dt = new DateTime(date("Y-m-d"));
                $year = $dt->format("Y");

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $dt = new DateTime($row["date_arrived"]);
                        $getDayName = $dt->format("l");
                        $getYear = $dt->format("Y");
                        $days = intval($row["days"]);

                        if($getDayName == "Monday" && $days <= 7 && $year == $getYear) {
                            $monday = $monday + $row["quantity"];
                        }
                    }
                }

                echo $monday;

                mysqli_close($con);
            ?>", "<?php
                //------------------ TUESDAY ------------------//
                //------------------ TUESDAY ------------------//
                //------------------ TUESDAY ------------------//
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $tuesday = 0;

                $select = "SELECT * FROM supply_inventory";
                $result = mysqli_query($con, $select);

                $dt = new DateTime(date("Y-m-d"));
                $year = $dt->format("Y");

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $dt = new DateTime($row["date_arrived"]);
                        $getDayName = $dt->format("l");
                        $getYear = $dt->format("Y");
                        $days = intval($row["days"]);

                        if($getDayName == "Tuesday" && $days <= 7 && $year == $getYear) {
                            $tuesday = $tuesday + $row["quantity"];
                        }
                    }
                }

                echo $tuesday;

                mysqli_close($con);
            ?>", "<?php
                //------------------ WEDNESDAY ------------------//
                //------------------ WEDNESDAY ------------------//
                //------------------ WEDNESDAY ------------------//
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $wednesday = 0;

                $select = "SELECT * FROM supply_inventory";
                $result = mysqli_query($con, $select);

                $dt = new DateTime(date("Y-m-d"));
                $year = $dt->format("Y");

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $dt = new DateTime($row["date_arrived"]);
                        $getDayName = $dt->format("l");
                        $getYear = $dt->format("Y");
                        $days = intval($row["days"]);

                        if($getDayName == "Wednesday" && $days <= 7 && $year == $getYear) {
                            $wednesday = $wednesday + $row["quantity"];
                        }
                    }
                }

                echo $wednesday;

                mysqli_close($con);
            ?>", "<?php
                //------------------ THURSDAY ------------------//
                //------------------ THURSDAY ------------------//
                //------------------ THURSDAY ------------------//
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $thursday = 0;

                $select = "SELECT * FROM supply_inventory";
                $result = mysqli_query($con, $select);

                $dt = new DateTime(date("Y-m-d"));
                $year = $dt->format("Y");

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $dt = new DateTime($row["date_arrived"]);
                        $getDayName = $dt->format("l");
                        $getYear = $dt->format("Y");
                        $days = intval($row["days"]);

                        if($getDayName == "Thursday" && $days <= 7 && $year == $getYear) {
                            $thursday = $thursday + $row["quantity"];
                        }
                    }
                }

                echo $thursday;

                mysqli_close($con);
            ?>", "<?php
                //------------------ FRIDAY ------------------//
                //------------------ FRIDAY ------------------//
                //------------------ FRIDAY ------------------//
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $friday = 0;

                $select = "SELECT * FROM supply_inventory";
                $result = mysqli_query($con, $select);

                $dt = new DateTime(date("Y-m-d"));
                $year = $dt->format("Y");

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $dt = new DateTime($row["date_arrived"]);
                        $getDayName = $dt->format("l");
                        $getYear = $dt->format("Y");
                        $days = intval($row["days"]);

                        if($getDayName == "Friday" && $days <= 7 && $year == $getYear) {
                            $friday = $friday + $row["quantity"];
                        }
                    }
                }

                echo $friday;

                mysqli_close($con);
            ?>", "<?php
                //------------------ SATURDAY ------------------//
                //------------------ SATURDAY ------------------//
                //------------------ SATURDAY ------------------//
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $saturday = 0;

                $select = "SELECT * FROM supply_inventory";
                $result = mysqli_query($con, $select);

                $dt = new DateTime(date("Y-m-d"));
                $year = $dt->format("Y");

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $dt = new DateTime($row["date_arrived"]);
                        $getDayName = $dt->format("l");
                        $getYear = $dt->format("Y");
                        $days = intval($row["days"]);

                        if($getDayName == "Saturday" && $days <= 7 && $year == $getYear) {
                            $saturday = $saturday + $row["quantity"];
                        }
                    }
                }

                echo $saturday;

                mysqli_close($con);
            ?>", "<?php
                //------------------ SUNDAY ------------------//
                //------------------ SUNDAY ------------------//
                //------------------ SUNDAY ------------------//
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $sunday = 0;

                $select = "SELECT * FROM supply_inventory";
                $result = mysqli_query($con, $select);

                $dt = new DateTime(date("Y-m-d"));
                $year = $dt->format("Y");

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $dt = new DateTime($row["date_arrived"]);
                        $getDayName = $dt->format("l");
                        $getYear = $dt->format("Y");
                        $days = intval($row["days"]);

                        if($getDayName == "Sunday" && $days <= 7 && $year == $getYear) {
                            $sunday = $sunday + $row["quantity"];
                        }
                    }
                }

                echo $sunday;

                mysqli_close($con);
            ?>"],
            }]
        },
        options: {
            scales: {
            yAxes: [{
                ticks: {
                beginAtZero: true,
                }
            }]
            }
        },
    });
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
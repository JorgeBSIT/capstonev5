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

    <title>View Demands</title>
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
                            <i class="fas fa-clipboard-list fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">Generate Report</span>
                        </a>
                    </li>
                    <?php
                        if ($_COOKIE["account_type"] == "administrator") {
                            echo '<li>
                                    <a href="viewDemands.php" class="nav-link px-0 align-middle mb-3">
                                        <i class="fas fa-file-invoice fs-2" style="color: #1c6cab;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: #1c6cab;">View Demands</span>
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
            <h1>View Demands</h1>
            <hr>

            <div class="container shadow-lg p-3 mb-5 bg-body rounded">
                <div class="row mb-3">
                    <img src="img/BULSU-LOGO.png" class="rounded mx-auto d-block" alt="bulsu-logo" style="width: 200px;">
                </div>

                <div class="row mb-3">
                    <div class="card chart-container">
                        <canvas id="chart"></canvas>
                    </div>
                </div>

                <div style="height: 50px;"></div>

                <div id="result">
                    <div class="container">
                        <?php 
                            $servername='localhost';
                            $username='u581335818_capstonev5_db';
                            $password='TBwK?U9i!9r';
                            $dbname = "u581335818_capstonev5_db";
                    
                            $con = mysqli_connect($servername, $username, $password, $dbname);
                    
                            if(!$con){
                                die('Could not Connect My Sql:' .mysql_error());
                                exit();
                            }

                            date_default_timezone_set("Asia/Kuala_Lumpur");

                            $arr_name_temp_previous_2 = [];
                            $arr_qty_temp_previous_2 = [];
                            $arr_unit_temp_previous_2 = [];
                            $index = 0;

                            // GET THE CURRENT YEAR DATA FROM distributed_supply TABLE
                            $dt = new DateTime(date("Y-m-d"));
                            $year = $dt->format("Y");
                            $year = $year - 2;

                            $select = "SELECT * FROM distributed_supply ORDER BY name";
                            $result = mysqli_query($con, $select);

                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){
                                    $dt = new DateTime($row["distributed_date"]);
                                    $getCurrentYear = $dt->format("Y");

                                    if($year == $getCurrentYear) {
                                        $arr_name_temp_previous_2[$index] = $row["name"];
                                        $arr_qty_temp_previous_2[$index] = $row["distributed_quantity"];
                                        $arr_unit_temp_previous_2[$index] = $row["unit"];
                                        $index++;
                                    }
                                }
                            }

                            $arr_name_previous_2 = [];
                            $arr_qty_previous_2 = [];
                            $arr_unit_previous_2 = [];

                            // INITIALIZE THE ARRAYS
                            for($i = 0; $i < count($arr_name_temp_previous_2); $i++) {
                                $arr_name_previous_2[$i] = " ";
                                $arr_qty_previous_2[$i] = 0;
                                $arr_unit_previous_2[$i] = " ";
                            }

                            // FILTER THE DATA AND COMBINE ALL NAMES WITH EACH OTHER
                            $occurence = 1;

                            for($i = 0; $i < count($arr_name_temp_previous_2); $i++) {
                                for($j = 0; $j < count($arr_name_temp_previous_2); $j++) {
                                    if($arr_name_temp_previous_2[$i] == $arr_name_previous_2[$j]) {
                                        $occurence++;
                                    }
                                }

                                if($occurence <= 1) {
                                    $arr_name_previous_2[$i] = $arr_name_temp_previous_2[$i];
                                    $arr_unit_previous_2[$i] = $arr_unit_temp_previous_2[$i];
                                }

                                $occurence = 1;
                            }

                            // COMPUTE THE TOTAL OF ALL DIFFERENT SUPPLIES
                            for($i = 0; $i < count($arr_qty_temp_previous_2); $i++) {
                                for($j = 0; $j < count($arr_qty_temp_previous_2); $j++) {
                                    if($arr_name_previous_2[$i] == $arr_name_temp_previous_2[$j]) {
                                        $arr_qty_previous_2[$i] = $arr_qty_previous_2[$i] + $arr_qty_temp_previous_2[$j];
                                    }
                                }
                            }

                            $arr_name_previous_2_final = [];
                            $arr_qty_previous_2_final = [];
                            $arr_unit_previous_2_final = [];
                            $index = 0;

                            // REMOVE THE EMPTY SPACES AND ZEROES
                            for($i = 0; $i < count($arr_name_previous_2); $i++) {
                                if($arr_name_previous_2[$i] != " ") {
                                    $arr_name_previous_2_final[$index] = $arr_name_previous_2[$i];
                                    $arr_qty_previous_2_final[$index] = $arr_qty_previous_2[$i];
                                    $arr_unit_previous_2_final[$index] = $arr_unit_previous_2[$i];
                                    $index++;
                                }
                            }

                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                            $arr_name_temp_previous_1 = [];
                            $arr_qty_temp_previous_1 = [];
                            $arr_unit_temp_previous_1 = [];
                            $index = 0;

                            // GET THE CURRENT YEAR DATA FROM distributed_supply TABLE
                            $dt = new DateTime(date("Y-m-d"));
                            $year = $dt->format("Y");
                            $year = $year - 1;

                            $select = "SELECT * FROM distributed_supply ORDER BY name";
                            $result = mysqli_query($con, $select);

                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){
                                    $dt = new DateTime($row["distributed_date"]);
                                    $getCurrentYear = $dt->format("Y");

                                    if($year == $getCurrentYear) {
                                        $arr_name_temp_previous_1[$index] = $row["name"];
                                        $arr_qty_temp_previous_1[$index] = $row["distributed_quantity"];
                                        $arr_unit_temp_previous_1[$index] = $row["unit"];
                                        $index++;
                                    }
                                }
                            }

                            $arr_name_previous_1 = [];
                            $arr_qty_previous_1 = [];
                            $arr_unit_previous_1 = [];

                            // INITIALIZE THE ARRAYS
                            for($i = 0; $i < count($arr_name_temp_previous_1); $i++) {
                                $arr_name_previous_1[$i] = " ";
                                $arr_qty_previous_1[$i] = 0;
                                $arr_unit_previous_1[$i] = " ";
                            }

                            // FILTER THE DATA AND COMBINE ALL NAMES WITH EACH OTHER
                            $occurence = 1;

                            for($i = 0; $i < count($arr_name_temp_previous_1); $i++) {
                                for($j = 0; $j < count($arr_name_temp_previous_1); $j++) {
                                    if($arr_name_temp_previous_1[$i] == $arr_name_previous_1[$j]) {
                                        $occurence++;
                                    }
                                }

                                if($occurence <= 1) {
                                    $arr_name_previous_1[$i] = $arr_name_temp_previous_1[$i];
                                    $arr_unit_previous_1[$i] = $arr_unit_temp_previous_1[$i];
                                }

                                $occurence = 1;
                            }

                            // COMPUTE THE TOTAL OF ALL DIFFERENT SUPPLIES
                            for($i = 0; $i < count($arr_qty_temp_previous_1); $i++) {
                                for($j = 0; $j < count($arr_qty_temp_previous_1); $j++) {
                                    if($arr_name_previous_1[$i] == $arr_name_temp_previous_1[$j]) {
                                        $arr_qty_previous_1[$i] = $arr_qty_previous_1[$i] + $arr_qty_temp_previous_1[$j];
                                    }
                                }
                            }

                            $arr_name_previous_1_final = [];
                            $arr_qty_previous_1_final = [];
                            $arr_unit_previous_1_final = [];
                            $index = 0;

                            // REMOVE THE EMPTY SPACES AND ZEROES
                            for($i = 0; $i < count($arr_name_previous_1); $i++) {
                                if($arr_name_previous_1[$i] != " ") {
                                    $arr_name_previous_1_final[$index] = $arr_name_previous_1[$i];
                                    $arr_qty_previous_1_final[$index] = $arr_qty_previous_1[$i];
                                    $arr_unit_previous_1_final[$index] = $arr_unit_previous_1[$i];
                                    $index++;
                                }
                            }

                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                            $arr_name_temp_current = [];
                            $arr_qty_temp_current = [];
                            $arr_unit_temp_current = [];
                            $index = 0;

                            // GET THE CURRENT YEAR DATA FROM distributed_supply TABLE
                            $dt = new DateTime(date("Y-m-d"));
                            $year = $dt->format("Y");
                            
                            $select = "SELECT * FROM distributed_supply ORDER BY name";
                            $result = mysqli_query($con, $select);

                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){
                                    $dt = new DateTime($row["distributed_date"]);
                                    $getCurrentYear = $dt->format("Y");

                                    if($year == $getCurrentYear) {
                                        $arr_name_temp_current[$index] = $row["name"];
                                        $arr_qty_temp_current[$index] = $row["distributed_quantity"];
                                        $arr_unit_temp_current[$index] = $row["unit"];
                                        $index++;
                                    }
                                }
                            }

                            $arr_name_current = [];
                            $arr_qty_current = [];
                            $arr_unit_current = [];

                            // INITIALIZE THE ARRAYS
                            for($i = 0; $i < count($arr_name_temp_current); $i++) {
                                $arr_name_current[$i] = " ";
                                $arr_qty_current[$i] = 0;
                                $arr_unit_current[$i] = " ";
                            }

                            // FILTER THE DATA AND COMBINE ALL NAMES WITH EACH OTHER
                            $occurence = 1;

                            for($i = 0; $i < count($arr_name_temp_current); $i++) {
                                for($j = 0; $j < count($arr_name_temp_current); $j++) {
                                    if($arr_name_temp_current[$i] == $arr_name_current[$j]) {
                                        $occurence++;
                                    }
                                }

                                if($occurence <= 1) {
                                    $arr_name_current[$i] = $arr_name_temp_current[$i];
                                    $arr_unit_current[$i] = $arr_unit_temp_current[$i];
                                }

                                $occurence = 1;
                            }

                            // COMPUTE THE TOTAL OF ALL DIFFERENT SUPPLIES
                            for($i = 0; $i < count($arr_qty_temp_current); $i++) {
                                for($j = 0; $j < count($arr_qty_temp_current); $j++) {
                                    if($arr_name_current[$i] == $arr_name_temp_current[$j]) {
                                        $arr_qty_current[$i] = $arr_qty_current[$i] + $arr_qty_temp_current[$j];
                                    }
                                }
                            }

                            $arr_name_current_final = [];
                            $arr_qty_current_final = [];
                            $arr_unit_current_final = [];
                            $index = 0;

                            // REMOVE THE EMPTY SPACES AND ZEROES
                            for($i = 0; $i < count($arr_name_current); $i++) {
                                if($arr_name_current[$i] != " ") {
                                    $arr_name_current_final[$index] = $arr_name_current[$i];
                                    $arr_qty_current_final[$index] = $arr_qty_current[$i];
                                    $arr_unit_current_final[$index] = $arr_unit_current[$i];
                                    $index++;
                                }
                            }

                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                            $arr_name_forecast_temp = [];
                            $arr_qty_forecast_temp = [];
                            $arr_unit_forecast_temp = [];
                            $arr_range = [];

                            for($i = 0; $i < count($arr_name_current_final); $i++) {
                                $arr_range[$i] = 0;
                                $arr_name_forecast_temp[$i] = "";
                                $arr_qty_forecast_temp[$i] = 0;
                                $arr_unit_forecast_temp[$i] = "";
                            }
                        
                            for($i = 0; $i < count($arr_name_current_final); $i++) {
                                for($j = 0; $j < count($arr_name_previous_1_final); $j++) {
                                    if($arr_name_current_final[$i] == $arr_name_previous_1_final[$j]) {
                                        for($k = 0; $k < count($arr_name_previous_2_final); $k++) {
                                            if($arr_name_current_final[$i] == $arr_name_previous_2_final[$k]) {
                                                $arr_name_forecast_temp[$i] =  $arr_name_current_final[$i];
                                                $arr_unit_forecast_temp[$i] =  $arr_unit_current_final[$i];
                        
                                                $arr_qty_forecast_temp[$i] = ($arr_qty_previous_2_final[$k] + $arr_qty_previous_1_final[$j]) / 2;
                                                $arr_qty_forecast_temp[$i] = abs($arr_qty_current_final[$i] - $arr_qty_forecast_temp[$i]) / 2;
                        
                                                if($arr_qty_forecast_temp[$i] <= 99) {
                                                    $arr_qty_forecast_temp[$i] = $arr_qty_forecast_temp[$i] / 10;
                                                    $arr_qty_forecast_temp[$i] = $arr_qty_forecast_temp[$i] / 2;
                                                } else if($arr_qty_forecast_temp[$i] <= 999) {
                                                    $arr_qty_forecast_temp[$i] = $arr_qty_forecast_temp[$i] / 10;
                                                    $arr_qty_forecast_temp[$i] = $arr_qty_forecast_temp[$i] / 100;
                                                    $arr_qty_forecast_temp[$i] = $arr_qty_forecast_temp[$i] / 2;
                                                }
                                
                                                if($arr_qty_forecast_temp[$i] <= 1.0 && $arr_qty_forecast_temp[$i] >= 0.90) {
                                                    $arr_range[$i] = 1.0;
                                                } else if($arr_qty_forecast_temp[$i] <= 0.90 && $arr_qty_forecast_temp[$i] >= 0.80) {
                                                    $arr_range[$i] = 0.9;
                                                } else if($arr_qty_forecast_temp[$i] <= 0.80 && $arr_qty_forecast_temp[$i] >= 0.70) {
                                                    $arr_range[$i] = 0.8;
                                                } else if($arr_qty_forecast_temp[$i] <= 0.70 && $arr_qty_forecast_temp[$i] >= 0.60) {
                                                    $arr_range[$i] = 0.7;
                                                } else if($arr_qty_forecast_temp[$i] <= 0.60 && $arr_qty_forecast_temp[$i] >= 0.50) {
                                                    $arr_range[$i] = 0.6;
                                                } else if($arr_qty_forecast_temp[$i] <= 0.50 && $arr_qty_forecast_temp[$i] >= 0.40) {
                                                    $arr_range[$i] = 0.5;
                                                } else if($arr_qty_forecast_temp[$i] <= 0.40 && $arr_qty_forecast_temp[$i] >= 0.30) {
                                                    $arr_range[$i] = 0.4;
                                                } else if($arr_qty_forecast_temp[$i] <= 0.30 && $arr_qty_forecast_temp[$i] >= 0.20) {
                                                    $arr_range[$i] = 0.3;
                                                } else if($arr_qty_forecast_temp[$i] <= 0.20 && $arr_qty_forecast_temp[$i] >= 0.10) {
                                                    $arr_range[$i] = 0.2;
                                                } else if($arr_qty_forecast_temp[$i] <= 0.10 && $arr_qty_forecast_temp[$i] >= 0.01) {
                                                    $arr_range[$i] = 0.1;
                                                } else {
                                                    $arr_range[$i] = 0;
                                                }
                        
                                                $arr_qty_forecast_temp[$i] = ($arr_range[$i] * $arr_qty_current_final[$i]) + (1 - $arr_range[$i]) * ($arr_qty_previous_1_final[$j] + $arr_qty_previous_2_final[$k]);
                                            }
                                        }
                                    }
                                }
                            }

                            $counter = 1;

                            $dt = new DateTime(date("Y-m-d"));
                            $nextYear = $dt->format("Y");
                            $nextYear = $nextYear + 1;

                            echo "<div class='container d-flex justify-content-center mb-3'><h2 class='text-center'>DEMAND FORECAST FOR YEAR ".$nextYear."</h2></div>";

                            if(count($arr_name_forecast_temp) > 0) {
                                echo "<div class='container'>";
                                    echo "<div style='height: 500px;' class='overflow-scroll'>";
                                    echo "<table class='table table-striped table-hover table-bordered text-center'>";
                                        echo "<thead class='table-dark'>";
                                            echo "<tr>";
                                                echo "<th scope='col'>#</th>";
                                                echo "<th scope='col'>Supply Name</th>";
                                                echo "<th scope='col'>Supply Quantity</th>";
                                                echo "<th scope='col'>Supply Unit</th>";
                                                echo "<th scope='col'>Weight</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                                for($i = 0; $i < count($arr_name_forecast_temp); $i++) {
                                                    if($arr_name_forecast_temp[$i] != "" && $arr_qty_forecast_temp[$i] != 0) {
                                                        echo "<tr>";
                                                            echo "<th>" . $counter++ . "</th>";
                                                            echo "<th>" . $arr_name_forecast_temp[$i] . "</th>";
                                                            echo "<th>" . floor($arr_qty_forecast_temp[$i]) . "</th>";
                                                            echo "<th>" . $arr_unit_forecast_temp[$i] . "</th>";
                                                            echo "<th>" . $arr_range[$i] . "</th>";
                                                        echo "</tr>";
                                                    }
                                                }
                                        echo "</tbody>";
                                    echo "</table>";
                                    echo "</div>";
                                echo "</div>";
                            } else {
                                echo "<div class='container d-flex justify-content-center'>
                                    <p class='fs-2'>No data found or insufficient data to compute the forecasting.</p>
                                </div>";
                            }

                            mysqli_close($con);

                            echo "<div style='height: 100px;'></div>"
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="lib/sweetalert.min.js"></script>
    <script src="script/signOut.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

    <script>
        const ctxLine = document.getElementById("chart").getContext('2d');
        const myLineChart = new Chart(ctxLine, {
        type: 'bar',
        data: {
            labels: ["2020", "2021", "2022",
            "2023", "2024", "2025", "2026", "2027", "2028", "2029", "2030"],
            datasets: [{
            label: 'Supply Demand Chart',
            backgroundColor: 'rgba(6, 46, 92, 0.88)',
            borderColor: 'rgba(6, 46, 92, 0.88)',
            data: ["<?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $year2020 = 0;

                $select = "SELECT * FROM distributed_supply";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $getDate = new DateTime($row['distributed_date']);
                        $getYear = $getDate->format('Y');

                        if($getYear == "2020") {
                            $year2020 = $year2020 + $row['distributed_quantity'];
                        }
                    }
                }

                echo $year2020;

                mysqli_close($con);
            ?>", "<?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $year2021 = 0;

                $select = "SELECT * FROM distributed_supply";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $getDate = new DateTime($row['distributed_date']);
                        $getYear = $getDate->format('Y');

                        if($getYear == "2021") {
                            $year2021 = $year2021 + $row['distributed_quantity'];
                        }
                    }
                }

                echo $year2021;

                mysqli_close($con);
            ?>", "<?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $year2022 = 0;

                $select = "SELECT * FROM distributed_supply";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $getDate = new DateTime($row['distributed_date']);
                        $getYear = $getDate->format('Y');

                        if($getYear == "2022") {
                            $year2022 = $year2022 + $row['distributed_quantity'];
                        }
                    }
                }

                echo $year2022;

                mysqli_close($con);
            ?>", "<?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $year2023 = 0;

                $select = "SELECT * FROM distributed_supply";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $getDate = new DateTime($row['distributed_date']);
                        $getYear = $getDate->format('Y');

                        if($getYear == "2023") {
                            $year2023 = $year2023 + $row['distributed_quantity'];
                        }
                    }
                }

                echo $year2023;

                mysqli_close($con);
            ?>", "<?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $year2024 = 0;

                $select = "SELECT * FROM distributed_supply";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $getDate = new DateTime($row['distributed_date']);
                        $getYear = $getDate->format('Y');

                        if($getYear == "2024") {
                            $year2024 = $year2024 + $row['distributed_quantity'];
                        }
                    }
                }

                echo $year2024;

                mysqli_close($con);
            ?>", "<?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $year2025 = 0;

                $select = "SELECT * FROM distributed_supply";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $getDate = new DateTime($row['distributed_date']);
                        $getYear = $getDate->format('Y');

                        if($getYear == "2025") {
                            $year2025 = $year2025 + $row['distributed_quantity'];
                        }
                    }
                }

                echo $year2025;

                mysqli_close($con);
            ?>", "<?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $year2026 = 0;

                $select = "SELECT * FROM distributed_supply";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $getDate = new DateTime($row['distributed_date']);
                        $getYear = $getDate->format('Y');

                        if($getYear == "2026") {
                            $year2026 = $year2026 + $row['distributed_quantity'];
                        }
                    }
                }

                echo $year2026;

                mysqli_close($con);
            ?>", "<?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $year2027 = 0;

                $select = "SELECT * FROM distributed_supply";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $getDate = new DateTime($row['distributed_date']);
                        $getYear = $getDate->format('Y');

                        if($getYear == "2027") {
                            $year2027 = $year2027 + $row['distributed_quantity'];
                        }
                    }
                }

                echo $year2027;

                mysqli_close($con);
            ?>", "<?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $year2028 = 0;

                $select = "SELECT * FROM distributed_supply";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $getDate = new DateTime($row['distributed_date']);
                        $getYear = $getDate->format('Y');

                        if($getYear == "2028") {
                            $year2028 = $year2028 + $row['distributed_quantity'];
                        }
                    }
                }

                echo $year2028;

                mysqli_close($con);
            ?>", "<?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $year2029 = 0;

                $select = "SELECT * FROM distributed_supply";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $getDate = new DateTime($row['distributed_date']);
                        $getYear = $getDate->format('Y');

                        if($getYear == "2029") {
                            $year2029 = $year2029 + $row['distributed_quantity'];
                        }
                    }
                }

                echo $year2029;

                mysqli_close($con);
            ?>", "<?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $year2030 = 0;

                $select = "SELECT * FROM distributed_supply";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $getDate = new DateTime($row['distributed_date']);
                        $getYear = $getDate->format('Y');

                        if($getYear == "2030") {
                            $year2030 = $year2030 + $row['distributed_quantity'];
                        }
                    }
                }

                echo $year2030;

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

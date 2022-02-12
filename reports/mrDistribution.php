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

    <!-- Jquery -->
    <script src="lib/jquery-3.6.0.min.js"></script>
    <script src="lib/jquery.validate.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/9d1d9a82d2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="img/icon.png">

    <title>Memorandum Receipt</title>
</head>
<body>
    <div>
        <button type="button" class="btn btn-dark" onclick="printReport()"><i class="fas fa-print"></i> print</button>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="container d-flex justify-content-center">
                <img src="../img/BULSU-LOGO.png" class="rounded" alt="..." style="width: 150px;">
            </div>
        </div>

        <div class="row">
            <div class="container d-flex justify-content-center">
                <h1 class="mt-4 fs-3">Bulacan State University Supply Office</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-1"></div>

            <div class="col-sm-10 d-flex justify-content-center">
                <h2 class="fs-5 text-center mt-3">MEMORANDUM RECEIPT</h2>
            </div>

            <div class="col-sm-1"></div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-1"></div>

            <div class="col-sm-10 d-flex justify-content-center">
                <h2 class="fs-5 text-center">PHYSICAL INVENTORY FOR PROPERTY, PLANT, AND EQUIPMENT MEMORANDUM RECEIPT</h2>
            </div>

            <div class="col-sm-1"></div>
        </div>

        <div class="row">
            <div class="col-sm-1"></div>

            <div class="col-sm-10 d-flex justify-content-center">
                <?php
                    $dt = new DateTime();
                    $year1 = $dt->format("Y");
                    $temp = $dt->format("Y");
                    $year2 = $temp - 1;

                    echo "<h3 class='fs-5'>S.Y ".$year2." - ".$year1.""; echo"</h3>";
                ?>
            </div>

            <div class="col-sm-1"></div>
        </div>

        <div class="row">
            <p class="fw-bolder">Person In Charge: <span class="fw-normal">
                <?php
                    $servername='localhost';
                    $username='u581335818_capstonev5_db';
                    $password='TBwK?U9i!9r';
                    $dbname = "u581335818_capstonev5_db";
                
                    $con = mysqli_connect($servername, $username, $password, $dbname);

                    $personInCharge = "";

                    $select = "SELECT * FROM cart_distribute_equipment";
                    $result = mysqli_query($con, $select);

                    if(mysqli_num_rows($result) > 0) {
                        while($row = $result->fetch_assoc()) {
                            $personInCharge = $row['in_charge'];
                        }
                    }

                    echo ucwords($personInCharge);
                ?>
            </span></p>
        </div>

        <div class="row">
            <p class="fw-bolder">Date: <span class="fw-normal">
                <?php
                    $servername='localhost';
                    $username='u581335818_capstonev5_db';
                    $password='TBwK?U9i!9r';
                    $dbname = "u581335818_capstonev5_db";
                
                    $con = mysqli_connect($servername, $username, $password, $dbname);

                    $personInCharge = "";

                    $select = "SELECT * FROM cart_distribute_equipment";
                    $result = mysqli_query($con, $select);

                    if(mysqli_num_rows($result) > 0) {
                        while($row = $result->fetch_assoc()) {
                            $date = $row['distribution_date'];
                        }
                    }

                    echo ucwords($date);
                ?>
            </span></p>
        </div>

        <div class="row">
            <div class="container-fluid">
                <table class="table table-striped table-hover mt-4 text-center table-bordered border-dark">
                    <thead class="table-secondary border-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Equipement Id</th>
                            <th scope="col">Equipement Name</th>
                            <th scope="col">Equipement Brand</th>
                            <th scope="col">Distribution Quantity</th>
                            <th scope="col">Distribution Date</th>
                            <th scope="col">Location</th>
                            <th scope="col">Description</th>
                            <th scope="col">Person in charge</th>
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

                            $select = "SELECT * FROM cart_distribute_equipment";
                            $result = mysqli_query($con, $select);

                            $id = [];
                            $name = [];
                            $brand = [];
                            $distribution_quantity = [];
                            $distribution_date = [];
                            $location = [];
                            $description = [];
                            $in_charge = [];
                            $index = 0;

                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $id[$index] = $row["id"];
                                    $name[$index] = $row["name"];
                                    $brand[$index] = $row["brand"];
                                    $distribution_quantity[$index] = $row["distribution_quantity"];
                                    $distribution_date[$index] = $row["distribution_date"];
                                    $location[$index] = $row["location"];
                                    $description[$index] = $row["description"];
                                    $in_charge[$index] = $row["in_charge"];

                                    echo "<tr>";
                                        echo "<th>".$counter++."</th>";
                                        echo "<td>".$id[$index]."</td>";
                                        echo "<td>".$name[$index]."</td>";
                                        echo "<td>".$brand[$index]."</td>";
                                        echo "<td>".$distribution_quantity[$index]."</td>";
                                        echo "<td>".$distribution_date[$index]."</td>";
                                        echo "<td>".$location[$index]."</td>";
                                        echo "<td>".$description[$index]."</td>";
                                        echo "<td>".$in_charge[$index]."</td>";
                                    echo "</tr>";

                                    $index++;
                                }
                            }

                            $delete = "DELETE FROM cart_distribute_equipment";
                            $result = mysqli_query($con, $delete);

                            mysqli_close($con);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row d-flex justify-content-between">
            <div class="col-md-3">
                <p class="fw-bolder">Prepared By:</span></p>
                <p class="fw-bolder fst-italic text-decoration-underline"><span class="fw-normal"><?php
                    $fullName = "____" . strtoupper($_COOKIE['lname']) . ", " . ucwords(strtolower($_COOKIE["fname"])) . " " . strtoupper($_COOKIE["mname"]) . "." . "____";

                    echo $fullName;
                ?></span></p>
                <p class="fw-normal"><span>Property Custodian</span></p>
            </div>

            <div class="col-md-3">
                <p class="fw-bolder">Noted By:</span></p>
                <p class="fw-bolder fst-italic text-decoration-underline"><span class="fw-normal"><?php
                    $servername='localhost';
                    $username='u581335818_capstonev5_db';
                    $password='TBwK?U9i!9r';
                    $dbname = "u581335818_capstonev5_db";
            
                    $con = mysqli_connect($servername, $username, $password, $dbname);

                    $fname = "";
                    $mname = "";
                    $lname = "";

                    $select = "SELECT * FROM user_accounts";
                    $result = mysqli_query($con, $select);

                    if($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            if($row["account_type"] == "administrator") {
                                $fname = $row["fname"];
                                $mname = $row["mname"];
                                $lname = $row["lname"];
                            }
                        }
                    }

                    $fullName = "____" . strtoupper($lname) . ", " . ucwords(strtolower($fname)) . " " . strtoupper($mname) . "." . "____";

                    echo $fullName;

                    mysqli_close($con);
                ?></span></p>
                <p class="fw-normal"><span>Supply Office Head</span></p>
            </div>
        </div>
    </div>

    <script>
        function printReport(){
            window.print();
        }
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
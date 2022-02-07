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

    <title>Supply Inventory Report</title>
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

        <hr>

        <div class="row">
            <div class="col-sm-1"></div>

            <div class="col-sm-10 d-flex justify-content-center">
                <h2 class="fs-5">Supply Weekly Inventory Report</h2>
            </div>

            <div class="col-sm-1"></div>
        </div>

        <div class="row">
            <p class="fw-bolder">Date: <span class="fw-normal"><?php
                date_default_timezone_set("Asia/Kuala_Lumpur");

                $dt = new DateTime(date('Y-m-d'));
                $date = $dt->format('Y-m-d');

                echo $date;
            ?></span></p>

            <p class="fw-bolder">Time: <span class="fw-normal"><?php
                date_default_timezone_set("Asia/Kuala_Lumpur");

                $dt = new DateTime(date('h:i:s a'));
                $time = $dt->format('h:i:s a');

                echo $time;
            ?></span></p>

            <p class="fw-bolder">Total Equipment: <span class="fw-normal"><?php
                $servername='localhost';
                $username='u581335818_capstonev5_db';
                $password='TBwK?U9i!9r';
                $dbname = "u581335818_capstonev5_db";
        
                $con = mysqli_connect($servername, $username, $password, $dbname);

                $counter = 0;

                $select = "SELECT * FROM supply_inventory";
                $result = mysqli_query($con, $select);

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $counter++;
                    }
                }

                echo $counter;

                mysqli_close($con);
            ?></span></p>

            <p class="fw-bolder">Printed By: <span class="fw-normal"><?php
                $fullName = strtoupper($_COOKIE['lname']) . ", " . ucwords(strtolower($_COOKIE["fname"])) . " " . strtoupper($_COOKIE["mname"]) . ".";

                echo $fullName;
            ?></span></p>

            <p class="fw-bolder">Employee ID: <span class="fw-normal"><?php
                $employeeId = $_COOKIE["id"];

                echo $employeeId;
            ?></span></p>
        </div>

        <div class="row">
            <div class="container-fluid">
                <table class="table table-striped table-hover mt-4 text-center table-bordered border-dark">
                    <thead class="table-secondary border-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Supply Id</th>
                            <th scope="col">Supply Name</th>
                            <th scope="col">Supply Brand</th>
                            <th scope="col">Receiver's Name</th>
                            <th scope="col">Supply Unit</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Date Arrived</th>
                            <th scope="col">Description</th>
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
                                    $getDays = intval($row["days"]);
                                    $dt = new DateTime($row["date_arrived"]);
                                    $getYear = $dt->format("Y");

                                    if($getDays <= 7 && $year == $getYear) {
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

    <script>
        function printReport(){
            window.print();
        }
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
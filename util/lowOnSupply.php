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

    $lowOnSupply = 0;

    $select = "SELECT * FROM supply_inventory";
    $result = mysqli_query($con, $select);

    $dt = new DateTime(date("Y-m-d"));
    $year = $dt->format("Y");

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $dt = new DateTime($row["date_arrived"]);
            $getYear = $dt->format("Y");
            $getQty = intval($row["quantity"]);

            if($getQty <= 10) {
                $lowOnSupply++;
            }
        }
    }

    echo $lowOnSupply;

    mysqli_close($con);
?>
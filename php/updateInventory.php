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

    $dt = new DateTime(date("Y-m-d"));
    $strDate = $dt->format("Y-m-d");
    $arr_id = [];
    $arr_days = [];
    $counter = 0;

    $select = "SELECT * FROM supply_inventory";
    $result = mysqli_query($con, $select);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["current"] != $strDate) {
                $arr_id[$counter] = $row["id"];
                $arr_days[$counter] = $row["days"];
                $counter++;
            }
        }
    }

    $count = mysqli_num_rows($result);

    for($i = 0; $i < count($arr_id); $i++) {
        $new_day = 0;
        
        $id = $arr_id[$i];
        $new_day = $arr_days[$i] + 1;

        $update = "UPDATE supply_inventory SET days='$new_day', current='$strDate' WHERE id='$id'";
        $result = mysqli_query($con, $update);
    }

    mysqli_close($con);
?>

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

    $dt = new DateTime(date("Y-m-d"));
    $strDate = $dt->format("Y-m-d");
    $arr_id = [];
    $arr_days = [];
    $counter = 0;

    $select = "SELECT * FROM equipment_inventory";
    $result = mysqli_query($con, $select);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["current"] != $strDate) {
                $arr_id[$counter] = $row["id"];
                $arr_days[$counter] = $row["days"];
                $counter++;
            }
        }
    }

    $count = mysqli_num_rows($result);

    for($i = 0; $i < count($arr_id); $i++) {
        $new_day = 0;

        $id = $arr_id[$i];
        $new_day = $arr_days[$i] + 1;

        $update = "UPDATE equipment_inventory SET days='$new_day', current='$strDate' WHERE id='$id'";
        $result = mysqli_query($con, $update);
    }

    mysqli_close($con); 
?>

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

    $dt = new DateTime(date("Y-m-d"));
    $strDate = $dt->format("Y-m-d");
    $arr_id = [];
    $arr_dayss = [];
    $counter = 0;

    $select = "SELECT * FROM distributed_supply";
    $result = mysqli_query($con, $select);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["current"] != $strDate) {
                $arr_id[$counter] = $row["id"];
                $arr_dayss[$counter] = $row["days"];
                $counter++;
            }
        }
    }

    $count = mysqli_num_rows($result);

    for($i = 0; $i < count($arr_id); $i++) {
        $new_day = 0;

        $id = $arr_id[$i];
        $new_day = $arr_dayss[$i] + 1;

        $update = "UPDATE distributed_supply SET days='$new_day', current='$strDate' WHERE id='$id'";
        $result = mysqli_query($con, $update);
    }

    mysqli_close($con); 
?>

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

    $dt = new DateTime(date("Y-m-d"));
    $strDate = $dt->format("Y-m-d");
    $arr_id = [];
    $arr_days = [];
    $counter = 0;

    $select = "SELECT * FROM distributed_equipment";
    $result = mysqli_query($con, $select);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["current"] != $strDate) {
                $arr_id[$counter] = $row["id"];
                $arr_days[$counter] = $row["days"];
                $counter++;
            }
        }
    }

    $count = mysqli_num_rows($result);

    for($i = 0; $i < count($arr_id); $i++) {
        $new_day = 0;

        $id = $arr_id[$i];
        $new_day = $arr_days[$i] + 1;

        $update = "UPDATE distributed_equipment SET days='$new_day', current='$strDate' WHERE id='$id'";
        $result = mysqli_query($con, $update);
    }

    mysqli_close($con); 
?>
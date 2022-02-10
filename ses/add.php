<?php
    include "../php/connect.php";

    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $qty = $_POST['qty'];
    $color = [];

    for($i = 0; $i < sizeof($id); $i++) {
        $select = "SELECT * FROM test_tbl";
        $result = mysqli_query($con, $select);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                if($id[$i] == $row["id"]) {
                    $color[$i] = $row["color"];
                }
            }
        }

        echo $id[$i] . " - " . $name[$i] . " - " . $quantity[$i] . " - " . $qty[$i] . " - " . $color[$i] . "<br>";
    }

    $validQty = false;

    for($i = 0; $i < sizeof($id); $i++) {
        if($qty[$i] > 0 && $qty[$i] <= $quantity[$i]) {
            $validQty = true;
        }
    }

    print_r($validQty);

    if($validQty) {
        for($i = 0; $i < sizeof($id); $i++) {
            $insert = "INSERT INTO test_tbl1 (id, name, quantity, color) VALUES ('$id[$i]', '$name[$i]', '$qty[$i]', '$color[$i]')";
            $result = mysqli_query($con, $insert);
        }
    }
?>
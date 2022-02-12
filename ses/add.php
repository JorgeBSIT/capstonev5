<?php
    include "../php/connect.php";

    session_start();

    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $qty = $_POST['qty'];
    $okay = $_POST["okay"];
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

    $validQty = true;
    $invalidQty = "";

    for($i = 0; $i < sizeof($id); $i++) {
        if($qty[$i] <= 0 || $qty[$i] > $quantity[$i]) {
            $validQty = false;
            break;
        }
    }

    for($i = 0; $i < sizeof($id); $i++) {
        if($qty[$i] <= 0 || $qty[$i] > $quantity[$i]) {
            $validQty = false;
            $invalidQty = $name[$i] . " ";
        }
    }

    if($validQty) {
        for($i = 0; $i < sizeof($id); $i++) {
            $insert = "INSERT INTO test_tbl1 (id, name, quantity, color) VALUES ('$id[$i]', '$name[$i]', '$qty[$i]', '$color[$i]')";
            $result = mysqli_query($con, $insert);
        }

        if (false === $result) {
            $_SESSION["status"] = "failed";
            $_SESSION["title"] = "Distribution Failed";
            $_SESSION["text"] = "Something went wrong please try again.";
            $_SESSION["icon"] = "error";
        } else {
            $_SESSION["status"] = "success";
            $_SESSION["title"] = "Distribution Successfully";
            $_SESSION["text"] = "You have successfully distributed the supply";
            $_SESSION["icon"] = "success";
        }
    } else {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Distribution Failed";
        $_SESSION["text"] = "Invalid distribution quantity, please check the quantity of the supplies.";
        $_SESSION["icon"] = "error";
    }
?>
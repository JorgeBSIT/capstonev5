<?php
    include "../php/connect.php";

    session_start();

    $id = $_POST["id"];
    $quantity_in = $_POST["quantity"];
    $quantity_out = $_POST["distribution_quantity"];

    $invalidQty = false;

    for($i = 0; $i < count($id); $i++) {
        if($quantity_out[$i] <= 0 || $quantity_out[$i] > $quantity_in[$i] || $quantity_out[$i] == "") {
            $invalidQty = true;
            break;
        }
    }

    if($invalidQty != false) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Distribution Failed";
        $_SESSION["text"] = "The amount you want to distribute is invalid, please try again.";
        $_SESSION["icon"] = "error";
    } else {
        $valid = true;

        $empId = 0;

        $code = "SPDT-";
        $dt = new DateTime();
        $getYear = $dt->format("Y");

        $randNum = rand(1000000,10000000);
        $year = $getYear;
        $empId = $code . strval($randNum) . "-" . $year;

        $distribution_no = [];

        for($i = 0; $i < count($id); $i++) {
            $distribution_no[$i] = $empId;
        }

        $id = $_POST["id"];
        $name = $_POST["name"];
        $brand = $_POST["brand"];
        $unit = $_POST["unit"];
        $description = $_POST["description"];
        $distributed_date = $_POST["distributed_date"];
        $location = $_POST["location"];
        $distributed_quantity = $_POST["distribution_quantity"];
        $received_by = $_POST["received_by"];

        for($i = 0; $i < count($id); $i++) {
            $insert = "INSERT INTO cart_supply (distribution_no, id, name, brand, unit, description, distributed_date, location, distributed_quantity, received_by) VALUES ('$distribution_no[$i]', '$id[$i]', '$name[$i]', '$brand[$i]', '$unit[$i]', '$description[$i]', '$distributed_date[$i]', '$location[$i]', '$distributed_quantity[$i]', '$received_by[$i]')";
            $result = mysqli_query($con, $insert);

            if($result === false) {
                break;
            }
        }

        if(false === $result) {
            $_SESSION["status"] = "failed";
            $_SESSION["title"] = "Distribution Failed";
            $_SESSION["text"] = "Something went wrong, please try again.";
            $_SESSION["icon"] = "error";
        } else {
            $_SESSION["status"] = "success";
            $_SESSION["title"] = "Distributed Successfully";
            $_SESSION["text"] = "You have successfully distributed the supply.";
            $_SESSION["icon"] = "success";
        }
    }

    mysqli_close($con);
?>
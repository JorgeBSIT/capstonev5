<?php
    include "../php/connect.php";

    session_start();

    $id = $_POST["supply_id_distribute"];
    $quantity_in = $_POST["supply_quantity_distribute"];
    $quantity_out = $_POST["distribution_quantity"];

    if($quantity_out > $quantity_in || $quantity_out <= 0) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Distribution Failed";
        $_SESSION["text"] = "The amount you want to distribute is invalid, please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../viewSupplies.php");
    } else {
        $new_quantity = $quantity_in - $quantity_out;

        $update ="UPDATE supply_inventory SET quantity='$new_quantity' WHERE id='$id'";
        $result = mysqli_query($con, $update);

        $distribution_no = $_POST["distribution_no"];
        $id = $_POST["supply_id_distribute"];
        $name = $_POST["supply_name_distribute"];
        $brand = $_POST["supply_brand_distribute"];
        $unit = $_POST["supply_unit_distribute"];
        $description = $_POST["supply_description_distribute"];
        $distributed_date = $_POST["distribution_date"];
        $location = $_POST["location"];
        $distributed_quantity = $_POST["distribution_quantity"];
        $received_by = $_POST["received_by"];
        // $days = "1";

        // $dt = new DateTime();
        // $date = $dt->format("Y-m-d");

        $insert = "INSERT INTO pending_supply (distribution_no, id, name, brand, unit, description, distributed_date, location, distributed_quantity, received_by) VALUES ('$distribution_no', '$id', '$name', '$brand', '$unit', '$description', '$distributed_date', '$location', '$distributed_quantity', '$received_by')";
        $result = mysqli_query($con, $insert);

        if(false === $result) {
            $_SESSION["status"] = "failed";
            $_SESSION["title"] = "Distribution Failed";
            $_SESSION["text"] = "Something went wrong, please try again.";
            $_SESSION["icon"] = "error";

            header("Location: ../viewSupplies.php");
        } else {
            $_SESSION["status"] = "success";
            $_SESSION["title"] = "Distributed Successfully";
            $_SESSION["text"] = "You have successfully distributed the supply.";
            $_SESSION["icon"] = "success";

            header("Location: ../viewSupplies.php");
        }
    }

    mysqli_close($con);
?>
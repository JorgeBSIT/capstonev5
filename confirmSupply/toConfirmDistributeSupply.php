<?php
    include "../php/connect.php";

    session_start();

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
    $days = "1";

    $dt = new DateTime();
    $date = $dt->format("Y-m-d");

    $insert = "INSERT INTO distributed_supply (distribution_no, id, name, brand, unit, description, distributed_date, location, distributed_quantity, received_by, days, current) VALUES ('$distribution_no', '$id', '$name', '$brand', '$unit', '$description', '$distributed_date', '$location', '$distributed_quantity', '$received_by', '$days', '$date')";
    $result = mysqli_query($con, $insert);

    $delete = "DELETE FROM pending_supply WHERE distribution_no='$distribution_no'";
    $result1 = mysqli_query($con, $delete);

    if(false === $result1) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Confirm Failed";
        $_SESSION["text"] = "Something went wrong, please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../confirmSupply.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Confirmed Successfully";
        $_SESSION["text"] = "You have successfully confirmed the supply.";
        $_SESSION["icon"] = "success";

        header("Location: ../confirmSupply.php");
    }

    mysqli_close($con);
?>
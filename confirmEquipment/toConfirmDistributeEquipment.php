<?php
    include "../php/connect.php";

    session_start();

    $distribution_no = $_POST["distribution_no"];
    $id = $_POST["equipment_id"];
    $name = $_POST["equipment_name"];
    $brand = $_POST["equipment_brand"];
    $description = $_POST["equipment_description"];
    $distribution_date = $_POST["distribution_date"];
    $location = $_POST["location"];
    $distribution_quantity = $_POST["distribution_quantity"];
    $in_charge = $_POST["in_charge"];
    $confirmed_by = $_COOKIE["fname"] . " " . $_COOKIE["mname"] . " " . $_COOKIE["lname"];
    $days = "1";

    $dt = new DateTime();
    $date = $dt->format("Y-m-d");

    $insert = "INSERT INTO distributed_equipment (distribution_no, id, name, brand, description, distribution_date, location, distribution_quantity, in_charge, transferred_date, p_in_charge, confirmed_by, transfer_confirmed_by, days, current) VALUES ('$distribution_no', '$id', '$name', '$brand', '$description', '$distribution_date', '$location', '$distribution_quantity', '$in_charge', 'none', 'none', '$confirmed_by', 'none', '$days', '$date')";
    $result = mysqli_query($con, $insert);

    $delete = "DELETE FROM pending_equipment WHERE distribution_no='$distribution_no'";
    $result1 = mysqli_query($con, $delete);

    if(false === $result1) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Confirm Failed";
        $_SESSION["text"] = "Something went wrong, please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../confirmEquipment.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Confirmed Successfully";
        $_SESSION["text"] = "You have successfully confirmed the equipment.";
        $_SESSION["icon"] = "success";

        header("Location: ../confirmEquipment.php");
    }

    mysqli_close($con);
?>
<?php 
    include "../php/connect.php";

    session_start();

    $equipmentId = trim($_POST["equipmentId"]);
    $equipmentName = trim(strtolower($_POST["equipmentName"]));
    $equipmentBrand = trim(strtolower($_POST["equipmentBrand"]));
    $equipmentReceiversName = trim(strtolower($_POST["equipmentReceiversName"]));
    $equipmentQuantity = trim($_POST["equipmentQuantity"]);
    $equipmentDateArrived = trim($_POST["equipmentDateArrived"]);
    $equipmentDescription = trim(strtolower($_POST["equipmentDescription"]));
    $days = "1";

    $dt = new DateTime();
    $date = $dt->format("Y-m-d");

    if ($equipmentDescription == null) {
        $equipmentDescription = "no description";
    }

    $insert = "INSERT INTO equipment_inventory (id, name, brand, receivers_name, quantity, date_arrived, description, days, current) VALUES ('$equipmentId', '$equipmentName', '$equipmentBrand', '$equipmentReceiversName', '$equipmentQuantity', '$equipmentDateArrived', '$equipmentDescription', '$days', '$date')";
    $result = mysqli_query($con, $insert);

    if (false === $result) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Add Failed";
        $_SESSION["text"] = "Please try again.";
        $_SESSION["icon"] = "error";

        header('Location: ../distributeEquipment.php');
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Added Successfully";
        $_SESSION["text"] = "You have successfully added the supply.";
        $_SESSION["icon"] = "success";

        header('Location: ../distributeEquipment.php');
    }

    mysqli_close($con);
?>
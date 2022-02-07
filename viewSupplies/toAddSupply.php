<?php
    include "../php/connect.php";

    session_start();

    $supplyId = trim($_POST["supplyId"]);
    $supplyName = trim(strtolower($_POST["supplyName"]));
    $supplyBrand = trim(strtolower($_POST["supplyBrand"]));
    $supplyReceiversName = trim(strtolower($_POST["supplyReceiversName"]));
    $supplyUnit = trim(strtolower($_POST["supplyUnit"]));
    $supplyQuantity = trim($_POST["supplyQuantity"]);
    $supplyDateArrived = trim($_POST["supplyDateArrived"]);
    $supplyOtherInfo = trim($_POST["supplyOtherInfo"]);
    $days = "1";

    $dt = new DateTime();
    $date = $dt->format("Y-m-d");

    if ($supplyOtherInfo == null) {
        $supplyOtherInfo = "no description";
    }

    $insert = "INSERT INTO supply_inventory (id, name, brand, receivers_name, unit, quantity, date_arrived, description, days, current) VALUES ('$supplyId', '$supplyName', '$supplyBrand', '$supplyReceiversName', '$supplyUnit', '$supplyQuantity', '$supplyDateArrived', '$supplyOtherInfo', '$days', '$date')";
    $result = mysqli_query($con, $insert);

    if (false === $result) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Add Failed";
        $_SESSION["text"] = "Please try again.";
        $_SESSION["icon"] = "error";

        header('Location: ../viewSupplies.php');
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Added Successfully";
        $_SESSION["text"] = "You have successfully added the supply.";
        $_SESSION["icon"] = "success";

        header('Location: ../viewSupplies.php');
    }

    mysqli_close($con);
?>
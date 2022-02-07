<?php
    include "../php/connect.php";

    session_start();

    $condemn_no = $_POST["condemn_no"];
    $distribution_no = $_POST["distribution_no"];
    $id = $_POST["id"];
    $name = $_POST["name"];
    $brand = $_POST["brand"];
    $description = $_POST["description"];
    $date_distributed = $_POST["date_distributed"];
    $location = $_POST["location"];
    $in_charge = $_POST["in_charge"];
    $condemn_date = $_POST["condemn_date"];
    $condemn_quantity = $_POST["condemn_quantity"];
    $confirmed_by = $_COOKIE["fname"] . " " . $_COOKIE["mname"] . " " . $_COOKIE["lname"];
    $status = $_POST["status"];
    
    $insert = "INSERT INTO condemned_equipment (condemn_no, distribution_no, id, name, brand, description, date_distributed, location, in_charge, condemn_date, condemn_quantity, confirmed_by, status) VALUES ('$condemn_no', '$distribution_no', '$id', '$name', '$brand', '$description', '$date_distributed', '$location', '$in_charge', '$condemn_date', '$condemn_quantity', '$confirmed_by', '$status')";
    $result = mysqli_query($con, $insert);

    $delete = "DELETE FROM pending_condemn WHERE condemn_no='$condemn_no'";
    $result1 = mysqli_query($con, $delete);

    if(false === $result1) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Confirm Failed";
        $_SESSION["text"] = "Something went wrong, please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../confirmCondemn.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Confirmed Successfully";
        $_SESSION["text"] = "You have successfully confirmed the equipment.";
        $_SESSION["icon"] = "success";

        header("Location: ../confirmCondemn.php");
    }

    mysqli_close($con);
?>
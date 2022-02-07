<?php
    include "../php/connect.php";

    session_start();

    $distribution_no = $_POST["distribution_no"];
    $new_in_charge = $_POST["in_charge"];
    $prev_in_charge = $_POST["p_in_charge"];
    $trans_date = $_POST["transferred_date"];
    $confirmed_by = $_COOKIE["fname"] . " " . $_COOKIE["mname"] . " " . $_COOKIE["lname"];

    $update = "UPDATE distributed_equipment SET in_charge='$new_in_charge', transferred_date='$trans_date', p_in_charge='$prev_in_charge', transfer_confirmed_by='$confirmed_by' WHERE distribution_no='$distribution_no'";
    $result = mysqli_query($con, $update);

    $delete = "DELETE FROM pending_transfer WHERE distribution_no='$distribution_no'";
    $result = mysqli_query($con, $delete);

    if(false === $result) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Confirm Failed";
        $_SESSION["text"] = "Something went wrong, please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../confirmTransfer.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Confirmed Successfully";
        $_SESSION["text"] = "You have successfully confirmed the equipment transfer.";
        $_SESSION["icon"] = "success";

        header("Location: ../confirmTransfer.php");
    }

    mysqli_close($con);
?>
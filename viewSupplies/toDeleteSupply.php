<?php
    include "../php/connect.php";

    session_start();

    $id = $_POST["supply_id_delete"];

    $delete = "DELETE FROM supply_inventory WHERE id='$id'";
    $result = mysqli_query($con, $delete);

    if(false === $result) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Delete Failed";
        $_SESSION["text"] = "Something went wrong, please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../viewSupplies.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Deleted Successfully";
        $_SESSION["text"] = "You have successfully deleted the supply.";
        $_SESSION["icon"] = "success";

        header("Location: ../viewSupplies.php");
    }

    mysqli_close($con);
?>
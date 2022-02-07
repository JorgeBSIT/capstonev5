<?php
    include "../php/connect.php";

    session_start();

    $supplyId = $_POST["supply_id_cancel"];
    $nowQty = $_POST["distribution_quantity_cancel"];
    $oldQty;

    $select = "SELECT * FROM supply_inventory WHERE id='$supplyId'";
    $result = mysqli_query($con, $select);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $oldQty = $row["quantity"];
        }
    }

    $backQty = $oldQty + $nowQty;

    $update = "UPDATE supply_inventory SET quantity='$backQty' WHERE id='$supplyId'";
    $result = mysqli_query($con, $update);

    $delete = "DELETE FROM pending_supply WHERE id='$supplyId'";
    $result1 = mysqli_query($con, $delete);

    if (false === $result1) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Cancel Failed";
        $_SESSION["text"] = "Please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../confirmSupply.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Cancelled Successfully";
        $_SESSION["text"] = "You have successfully canlled the supply.";
        $_SESSION["icon"] = "success";

        header("Location: ../confirmSupply.php");
    }

    mysqli_query($con);
?>
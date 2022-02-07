<?php
    include "../php/connect.php";

    session_start();

    $id = $_POST["supply_id_edit"];
    $name = $_POST["supply_name_edit"];
    $brand = $_POST["supply_brand_edit"];
    $receivers_name = $_POST["supply_receivers_name_edit"];
    $unit = $_POST["supply_unit_edit"];
    $quantity = intval($_POST["supply_quantity_edit"]);
    $date_arrived = $_POST["supply_date_arrived_edit"];
    $description = $_POST["supply_description_edit"];

    $update = "UPDATE supply_inventory SET name='$name', brand='$brand', receivers_name='$receivers_name', unit='$unit', quantity='$quantity', date_arrived='$date_arrived', description='$description' WHERE id='$id'"; 
    $result = mysqli_query($con, $update);
    
    if(false === $result) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Edit Failed";
        $_SESSION["text"] = "Something went wrong, please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../viewSupplies.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Edited Successfully";
        $_SESSION["text"] = "You have successfully edited the supply.";
        $_SESSION["icon"] = "success";

        header("Location: ../viewSupplies.php");
    }

    mysqli_close($con);
?>
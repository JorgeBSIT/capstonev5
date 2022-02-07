<?php
    include "../php/connect.php";

    session_start();

    $equipment_id_edit = strtolower($_POST["equipment_id_edit"]);
    $equipment_name_edit = strtolower($_POST["equipment_name_edit"]);
    $equipment_brand_edit = strtolower($_POST["equipment_brand_edit"]);
    $equipment_receivers_name_edit = strtolower($_POST["equipment_receivers_name_edit"]);
    $equipment_quantity_edit = $_POST["equipment_quantity_edit"];
    $equipment_date_arrived_edit = $_POST["equipment_date_arrived_edit"];
    $equipment_description_edit = strtolower($_POST["equipment_description_edit"]);

    $update = "UPDATE equipment_inventory SET name='$equipment_name_edit', brand='$equipment_brand_edit', receivers_name='$equipment_receivers_name_edit', quantity='$equipment_quantity_edit', date_arrived='$equipment_date_arrived_edit', description='$equipment_description_edit' WHERE id='$equipment_id_edit'";
    $result = mysqli_query($con, $update);

    if(false === $result) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Edit Failed";
        $_SESSION["text"] = "Something went wrong, please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../distributeEquipment.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Edited Successfully";
        $_SESSION["text"] = "You have successfully edited the supply.";
        $_SESSION["icon"] = "success";

        header("Location: ../distributeEquipment.php");
    }

    mysqli_close($con);
?>
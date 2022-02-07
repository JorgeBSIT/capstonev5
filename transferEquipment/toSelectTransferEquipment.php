<?php
    include "../php/connect.php";

    session_start();

    $same_name = true;
    $getName = $_POST["equipment_in_charge_select"];
    $getNewName = $_POST["new_person_in_charge"];

    $select = "SELECT * FROM cart_transfer_equipment";
    $result = mysqli_query($con, $select);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($getName != $row["in_charge"] || $getNewName != $row["p_in_charge"]) {
                $same_name = false;
            }
        }
    }

    $same_equipment = true;
    $getEquipmentName = $_POST["equipment_name_select"];

    $select = "SELECT * FROM cart_transfer_equipment";
    $result = mysqli_query($con, $select);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($getEquipmentName == $row["name"]) {
                $same_equipment = false;
            }
        }
    }

    if($same_equipment){
        if($same_name) {
            $distribution_no = $_POST["equipment_distribution_no_select"];
            $id = $_POST["equipment_id_select"];
            $name = $_POST["equipment_name_select"];
            $brand = $_POST["equipment_brand_select"];
            $description = $_POST["equipment_description_select"];
            $distribution_date = $_POST["equipment_date_distribution_select"];
            $distribution_quantity = $_POST["equipment_quantity_select"];
            $in_charge = $_POST["equipment_in_charge_select"];
            $transferred_date = $_POST["transfer_date"];
            $location = $_POST["equipment_location_select"];
            $p_in_charge = $_POST["new_person_in_charge"];

            $insert = "INSERT INTO cart_transfer_equipment (distribution_no, id, name, brand, description, distribution_date, location, distribution_quantity, in_charge, transferred_date, p_in_charge) VALUES ('$distribution_no', '$id', '$name', '$brand', '$description', '$distribution_date', '$location', '$distribution_quantity', '$in_charge', '$transferred_date', '$p_in_charge')";
            $result = mysqli_query($con, $insert);

            if (false === $result) {
                $_SESSION["status"] = "failed";
                $_SESSION["title"] = "Add Failed";
                $_SESSION["text"] = "Please try again.";
                $_SESSION["icon"] = "error";

                header('Location: ../transferEquipment.php');
            } else {
                $_SESSION["status"] = "success";
                $_SESSION["title"] = "Added Successfully";
                $_SESSION["text"] = "You have successfully added the supply.";
                $_SESSION["icon"] = "success";

                header('Location: ../transferEquipment.php');
            } 
        } else {
            $_SESSION["status"] = "failed";
            $_SESSION["title"] = "Select Error";
            $_SESSION["text"] = "Please make sure the name in charge is the same.";
            $_SESSION["icon"] = "error";

            header('Location: ../transferEquipment.php');
        }
    } else {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Select Error";
        $_SESSION["text"] = "The equipment has been added please choose another.";
        $_SESSION["icon"] = "error";

        header('Location: ../transferEquipment.php');
    }

    mysqli_close($con);
?>
<?php
    include "../php/connect.php";

    session_start();

    $same_name = true;
    $getName = $_POST["in_charge_to"];
    $ids = [];
    $index = 0;

    $select = "SELECT * FROM cart_distribute_equipment";
    $result = mysqli_query($con, $select);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($getName != $row["in_charge"]) {
                $same_name = false;
            }

            $ids[$index] = $row["id"];
            $index++;
        }
    }

    $sameId = true;
    $getId = $_POST["equipment_id_select"];

    for($i = 0; $i < count($ids); $i++) {
        if($getId == $ids[$i]){
            $sameId = false;
        }
    }

    if($sameId) {
        if($same_name) {
            $equipment_quantity_select = $_POST["equipment_quantity_select"];
            $distribution_quantity = $_POST["distribution_quantity"];

            if($equipment_quantity_select >= $distribution_quantity && $distribution_quantity > 0) {
                $equipment_id_select = $_POST["equipment_id_select"];
                $equipment_name_select = strtolower($_POST["equipment_name_select"]);
                $equipment_brand_select = strtolower($_POST["equipment_brand_select"]);
                $equipment_receivers_name_select = strtolower($_POST["equipment_receivers_name_select"]);
                $equipment_quantity_select = $_POST["equipment_quantity_select"];
                $equipment_date_arrived_select = strtolower($_POST["equipment_date_arrived_select"]);
                $equipment_description_select = strtolower($_POST["equipment_description_select"]);
                $distribution_no = $_POST["distribution_no"];
                $distribution_date = strtolower($_POST["distribution_date"]);
                $location = strtolower($_POST["location"]);
                $distribution_quantity = $_POST["distribution_quantity"];
                $in_charge_to = strtolower(trim($_POST["in_charge_to"]));

                $insert = "INSERT INTO cart_distribute_equipment (distribution_no, id, name, brand, receivers_name, quantity, date_arrived, description, distribution_date, location, distribution_quantity, in_charge) VALUES ('$distribution_no', '$equipment_id_select', '$equipment_name_select', '$equipment_brand_select', '$equipment_receivers_name_select', '$equipment_quantity_select', '$equipment_date_arrived_select', '$equipment_description_select', '$distribution_date', '$location', '$distribution_quantity', '$in_charge_to')";
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
            } else {
                $_SESSION["status"] = "failed";
                $_SESSION["title"] = "Select Error";
                $_SESSION["text"] = "Please enter invalid quantity amount.";
                $_SESSION["icon"] = "error";

                header('Location: ../distributeEquipment.php');
            }
        } else {
            $_SESSION["status"] = "failed";
            $_SESSION["title"] = "Select Error";
            $_SESSION["text"] = "Please make sure the name in charge is the same.";
            $_SESSION["icon"] = "error";

            header('Location: ../distributeEquipment.php');
        }
    } else {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Select Error";
        $_SESSION["text"] = "This equipment has been added.";
        $_SESSION["icon"] = "error";

        header('Location: ../distributeEquipment.php');
    }

    mysqli_close($con);
?>
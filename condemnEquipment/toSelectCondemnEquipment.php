<?php
    include "../php/connect.php";

    session_start();

    $same_name = true;
    $getName = $_POST["equipment_in_charge_select"];
    $ids = [];
    $index = 0;

    $select = "SELECT * FROM cart_condemn_equipment";
    $result = mysqli_query($con, $select);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($getName != $row["in_charge"]) {
                $same_name = false;
            }

            $ids[$index] = $row["distribution_no"];
            $index++;
        }
    }

    $sameId = true;
    $getId = $_POST["equipment_distribution_no_select"];

    for($i = 0; $i < count($ids); $i++) {
        if($getId == $ids[$i]){
            $sameId = false;
        }
    }

    if($sameId) {
        if($same_name) {
            $equipment_quantity_select = $_POST["equipment_quantity_select"];
            $condem_quantity = $_POST["condem_quantity"];

            if($equipment_quantity_select >= $condem_quantity && $condem_quantity > 0) {
                $condemn_no = $_POST["condemn_no"];
                $distribution_no = $_POST["equipment_distribution_no_select"];
                $id = $_POST["equipment_id_select"];
                $name = $_POST["equipment_name_select"];
                $brand = $_POST["equipment_brand_select"];
                $description = $_POST["equipment_description_select"];
                $date_distributed = $_POST["equipment_date_distribution_select"];
                $location = $_POST["equipment_location_select"];
                $in_charge = $_POST["equipment_in_charge_select"];
                $condemn_date = $_POST["condemn_date"];
                $condemn_quantity = $_POST["condem_quantity"];
                $condemn_status = $_POST["condemn_status"];

                $insert = "INSERT INTO cart_condemn_equipment (condemn_no, distribution_no, id, name, brand, description, date_distributed, location, in_charge, condemn_date, condemn_quantity, status) VALUES ('$condemn_no', '$distribution_no', '$id', '$name', '$brand', '$description', '$date_distributed', '$location', '$in_charge', '$condemn_date', '$condemn_quantity', '$condemn_status')";
                $result = mysqli_query($con, $insert);

                if (false === $result) {
                    $_SESSION["status"] = "failed";
                    $_SESSION["title"] = "Add Failed";
                    $_SESSION["text"] = "Please try again.";
                    $_SESSION["icon"] = "error";

                    header('Location: ../condemnEquipment.php');
                } else {
                    $_SESSION["status"] = "success";
                    $_SESSION["title"] = "Added Successfully";
                    $_SESSION["text"] = "You have successfully added the supply.";
                    $_SESSION["icon"] = "success";

                    header('Location: ../condemnEquipment.php');
                }
            } else {
                $_SESSION["status"] = "failed";
                $_SESSION["title"] = "Select Error";
                $_SESSION["text"] = "Please enter invalid quantity amount.";
                $_SESSION["icon"] = "error";

                header('Location: ../condemnEquipment.php');
            }
        } else {
            $_SESSION["status"] = "failed";
            $_SESSION["title"] = "Select Error";
            $_SESSION["text"] = "Please make sure the name in charge is the same.";
            $_SESSION["icon"] = "error";

            header('Location: ../condemnEquipment.php');
        }
    } else {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Select Error";
        $_SESSION["text"] = "This equipment has been added.";
        $_SESSION["icon"] = "error";

        header('Location: ../condemnEquipment.php');
    }

    mysqli_close($con);
?>
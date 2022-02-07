<?php
    include "../php/connect.php";

    session_start();

    $select = "SELECT * FROM cart_condemn_equipment";
    $result = mysqli_query($con, $select);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        }
    }

    $count = mysqli_num_rows($result);

    if($count <= 0) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Condemn Failed";
        $_SESSION["text"] = "No data to condemn.";
        $_SESSION["icon"] = "error";

        header("Location: ../condemnEquipment.php");
    } else {
        $condemn_no = [];
        $distribution_no = [];
        $id = [];
        $name = [];
        $brand = [];
        $description = [];
        $date_distributed = [];
        $location = [];
        $in_charge = [];
        $condemn_date = [];
        $condemn_quantity = [];
        $status = [];

        $index = 0;

        $select = "SELECT * FROM cart_condemn_equipment";
        $result = mysqli_query($con, $select);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $condemn_no[$index] = $row["condemn_no"];
                $distribution_no[$index] = $row["distribution_no"];
                $id[$index] = $row["id"];
                $name[$index] = $row["name"];
                $brand[$index] = $row["brand"];
                $description[$index] = $row["description"];
                $date_distributed[$index] = $row["date_distributed"];
                $location[$index] = $row["location"];
                $in_charge[$index] = $row["in_charge"];
                $condemn_date[$index] = $row["condemn_date"];
                $condemn_quantity[$index] = $row["condemn_quantity"];
                $status[$index] = $row["status"];
                $index++;
            }
        }

        $equipment_id = [];
        $equipment_quantity = [];
        $index = 0;

        $select = "SELECT * FROM distributed_equipment";
        $result = mysqli_query($con, $select);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $equipment_id[$index] = $row["distribution_no"];
                $equipment_quantity[$index] = $row["distribution_quantity"];
                $index++;
            }
        }

        for($i = 0; $i < count($distribution_no); $i++) {
            for($j = 0; $j < count($equipment_id); $j++) {
                if($distribution_no[$i] == $equipment_id[$j]) {
                    $theId = $equipment_id[$j];
                    $new_quantity = $equipment_quantity[$j] - $condemn_quantity[$i];

                    $update = "UPDATE distributed_equipment SET distribution_quantity='$new_quantity' WHERE distribution_no='$theId'";
                    $result = mysqli_query($con, $update);
                }
            }
        }

        for($i = 0; $i < count($distribution_no); $i++) {
            $insert = "INSERT INTO pending_condemn (condemn_no, distribution_no, id, name, brand, description, date_distributed, location, in_charge, condemn_date, condemn_quantity, status) VALUES ('$condemn_no[$i]', '$distribution_no[$i]', '$id[$i]', '$name[$i]', '$brand[$i]', '$description[$i]', '$date_distributed[$i]', '$location[$i]', '$in_charge[$i]', '$condemn_date[$i]', '$condemn_quantity[$i]', '$status[$i]')";
            $result = mysqli_query($con, $insert);
        }

        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Condemned Successfully";
        $_SESSION["text"] = "You have successfully distributed the supply.";
        $_SESSION["icon"] = "success";

        header("Location: ../reports/condemnReceipt.php");
    }

    mysqli_close($con);
?>
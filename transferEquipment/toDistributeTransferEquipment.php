<?php
    include "../php/connect.php";

    session_start();

    $select = "SELECT * FROM cart_transfer_equipment";
    $result = mysqli_query($con, $select);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        }
    }

    $count = mysqli_num_rows($result);

    if($count <= 0) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Transfer Failed";
        $_SESSION["text"] = "No data to distribute.";
        $_SESSION["icon"] = "error";

        header("Location: ../transferEquipment.php");
    } else {
        $distribution_no = [];
        $id = [];
        $name = [];
        $brand = [];
        $description = [];
        $distribution_date = [];
        $location = [];
        $distribution_quantity = [];
        $in_charge = [];
        $transferred_date = [];
        $p_in_charge = [];

        $index = 0;

        $select = "SELECT * FROM cart_transfer_equipment";
        $result = mysqli_query($con, $select);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $distribution_no[$index] = $row["distribution_no"];
                $id[$index] = $row["id"];
                $name[$index] = $row["name"];
                $brand[$index] = $row["brand"];
                $description[$index] = $row["description"];
                $distribution_date[$index] = $row["distribution_date"];
                $location[$index] = $row["location"];
                $distribution_quantity[$index] = $row["distribution_quantity"];
                $in_charge[$index] = $row["in_charge"];
                $transferred_date[$index] = $row["transferred_date"];
                $p_in_charge[$index] = $row["p_in_charge"];
                $index++;
            }
        }

        for($i = 0; $i < count($distribution_no); $i++) {
            $new_in_charge = $p_in_charge[$i];
            $prev_in_charge = $in_charge[$i];
            $date = $transferred_date[$i];
            $no = $distribution_no[$i];

            // $update = "UPDATE distributed_equipment SET in_charge='$new_in_charge', transferred_date='$date', p_in_charge='$prev_in_charge' WHERE distribution_no='$no'";
            // $result = mysqli_query($con, $update);

            $insert = "INSERT INTO pending_transfer (distribution_no, id, name, brand, description, distribution_date, location, distribution_quantity, in_charge, transferred_date, p_in_charge) VALUES ('$no', '$id[$i]', '$name[$i]', '$brand[$i]', '$description[$i]', '$distribution_date[$i]', '$location[$i]', '$distribution_quantity[$i]', '$new_in_charge', '$date', '$prev_in_charge')";
            $result = mysqli_query($con, $insert);
        }

        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Transferred Successfully";
        $_SESSION["text"] = "You have successfully distributed the supply.";
        $_SESSION["icon"] = "success";

        header('Location: ../reports/transferReceipt.php');
    }

    mysqli_close($con);
?>
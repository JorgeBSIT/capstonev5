<?php
    include "../php/connect.php";

    require '../mail/PHPMailer.php';
    require '../mail/SMTP.php';
    require '../mail/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    session_start();

    $select = "SELECT * FROM cart_distribute_equipment";
    $result = mysqli_query($con, $select);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        }
    }

    $count = mysqli_num_rows($result);

    if($count <= 0) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Distribution Failed";
        $_SESSION["text"] = "No data to distribute.";
        $_SESSION["icon"] = "error";

        header("Location: ../distributeEquipment.php");
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
        $transferred_date = "none";
        $p_in_charge = "none";
        $days = "1";

        $dt = new DateTime();
        $date = $dt->format("Y-m-d");

        $index = 0;

        $select = "SELECT * FROM cart_distribute_equipment";
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
                $index++;
            }
        }

        $equipment_id = [];
        $equipment_quantity = [];
        $index = 0;

        $select = "SELECT * FROM equipment_inventory";
        $result = mysqli_query($con, $select);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $equipment_id[$index] = $row["id"];
                $equipment_quantity[$index] = $row["quantity"];
                $index++;
            }
        }

        for($i = 0; $i < count($id); $i++) {
            for($j = 0; $j < count($equipment_id); $j++) {
                if($id[$i] == $equipment_id[$j]) {
                    $theId = $equipment_id[$j];
                    $new_quantity = $equipment_quantity[$j] - $distribution_quantity[$i];

                    $update = "UPDATE equipment_inventory SET quantity='$new_quantity' WHERE id='$theId'";
                    $result = mysqli_query($con, $update);
                }
            }
        }

        for($i = 0; $i < count($id); $i++) {
            $insert = "INSERT INTO pending_equipment (distribution_no, id, name, brand, description, distribution_date, location, distribution_quantity, in_charge, transferred_date, p_in_charge) VALUES ('$distribution_no[$i]', '$id[$i]', '$name[$i]', '$brand[$i]', '$description[$i]', '$distribution_date[$i]', '$location[$i]', '$distribution_quantity[$i]', '$in_charge[$i]', '$transferred_date', '$p_in_charge')";
            $result = mysqli_query($con, $insert);
        }    
        
        try {
            $mail = new PHPMailer();
    
            $mail->isSMTP(); // disable whne hosting
    
            $mail->Host = "smtp.gmail.com";
    
            $mail->SMTPAuth = true;
    
            $mail->SMTPSecure = "tls";
    
            $mail->Port = 587;
    
            $mail->Username = "officesupply922@gmail.com";
            $mail->Password = "BSIT4B2022";
    
            $mail->Subject = "Test Mail";
    
            $mail->setFrom("miraishe24@gmail.com");
            $mail->isHTML(true);
    
            $total_id = "";

            for($i = 0; $i < count($distribution_no); $i++){
                $total_id .= $distribution_no[$i] . ", ";
            }

            $mail->Body = "
                <h1>Your package is arriving</h1>
                <p>Greetings from Supply Office!</p>
                <p>this email is sent to inform you that your package " .$total_id. " from Supply Office is arriving soon.</p>
            ";
    
            $mail->addAddress("miraishe24@gmail.com");

            $mail->send();
        } catch (Exception $e) {
            $_SESSION["status"] = "failed";
            $_SESSION["title"] = "Fatal Error";
            $_SESSION["text"] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $_SESSION["icon"] = "error";

            header('Location: ../distributeEquipment.php');
        }
    
        $mail->smtpClose();

        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Distributed Successfully";
        $_SESSION["text"] = "You have successfully distributed the supply.";
        $_SESSION["icon"] = "success";

        header('Location: ../reports/mrDistribution.php');
    }

    mysqli_close($con);
?>
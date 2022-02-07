<?php
    include '../php/connect.php';

    session_start();

    if(isset($_POST['submit']) && isset($_FILES['my_image'])) {
        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];

        if ($img_size > 5242880) {
            $_SESSION["status"] = "failed";
            $_SESSION["title"] = "Image Error";
            $_SESSION["text"] = "Image is too big, please select another picture.";
            $_SESSION["icon"] = "error";

            header("Location: ../accountProfile.php");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;

                $id = $_COOKIE['id'];

                $update = "UPDATE user_accounts SET image='$new_img_name' WHERE id='$id'";
                $result = mysqli_query($con, $update);

                $img_upload_path = '../uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                if(false === $result){
                    $_SESSION["status"] = "failed";
                    $_SESSION["title"] = "Upload Failed";
                    $_SESSION["text"] = "Please try again.";
                    $_SESSION["icon"] = "error";

                    header('Location: ../accountProfile.php');
                } else{
                    $_SESSION["status"] = "success";
                    $_SESSION["title"] = "Uploaded Successfully";
                    $_SESSION["text"] = "You have successfully updated your account.";
                    $_SESSION["icon"] = "success";

                    header('Location: ../accountProfile.php');
                }
            }else {
                $_SESSION["status"] = "failed";
                $_SESSION["title"] = "Image Error";
                $_SESSION["text"] = "Invalid image type, please choose jpg, jpeg, or png only.";
                $_SESSION["icon"] = "error";

                header("Location: ../accountProfile.php");
            }
        }
    } else {
        header("Location: ../accountProfile.php");
    }

    mysqli_close($con);
?>
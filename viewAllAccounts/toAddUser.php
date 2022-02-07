<?php
    include "../php/connect.php";

    session_start();

    $secret = "6Le028EcAAAAABiqM0vVTghbPZZDAUabzVgijm7F";
    $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $_POST["g-recaptcha-response"]);
    $responseData = json_decode($verifyResponse);

    if ($_POST["g-recaptcha-response"] != "" && isset($_POST["submit"]) && isset($_FILES["my_image"])) {
        if ($responseData->success) {

            $username = trim($_POST["username"]);
            $username_no_match = true;

            $select = "SELECT username FROM user_accounts";
            $result = $con->query($select);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($row["username"] == $username) {
                        $username_no_match = false;
                    }
                }
            }

            if($username_no_match) {
                $accountType = trim(strtolower($_POST["accountType"]));
                $accountId = trim($_POST["accountId"]);
                $fname = trim(strtolower($_POST["fname"]));
                $mname = trim(strtolower($_POST["mname"]));
                $lname = trim(strtolower($_POST["lname"]));
                $contact = trim($_POST["contact"]);
                $birth_date = $_POST["birth_date"];
                $password = trim(sha1($_POST["password"]));
                $username = trim($_POST["username"]);

                $img_name = $_FILES["my_image"]["name"];
                $img_size = $_FILES["my_image"]["size"];
                $tmp_name = $_FILES["my_image"]["tmp_name"];
                $error = $_FILES["my_image"]["error"];

                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if ($img_size > 5242880) {
                    $_SESSION["status"] = "failed";
                    $_SESSION["title"] = "Image Error";
                    $_SESSION["text"] = "Image is too big, please select another picture.";
                    $_SESSION["icon"] = "error";

                    header("Location: ../viewAllAccounts.php");
                } else { 
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
        
                    $allowed_exs = array("jpg", "jpeg", "png"); 

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                        $img_upload_path = "../uploads/".$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $insert = "INSERT INTO user_accounts (id, account_type, fname, mname, lname, contact, birth_date, username, password, image, status) VALUES ('$accountId', '$accountType', '$fname', '$mname', '$lname', '$contact', '$birth_date', '$username', '$password', '$new_img_name', 'active')";
                        $result = mysqli_query($con, $insert);

                        if(false === $result){
                            $_SESSION["status"] = "failed";
                            $_SESSION["title"] = "Register Failed";
                            $_SESSION["text"] = "Please try again.";
                            $_SESSION["icon"] = "error";

                            header("Location: ../viewAllAccounts.php");
                        } else{
                            $_SESSION["status"] = "success";
                            $_SESSION["title"] = "Registered Successfully";
                            $_SESSION["text"] = "You have successfully created a new account.";
                            $_SESSION["icon"] = "success";

                            header("Location: ../viewAllAccounts.php");
                        }
                    }else {
                        $_SESSION["status"] = "failed";
                        $_SESSION["title"] = "Image Error";
                        $_SESSION["text"] = "Invalid image type, please choose jpg, jpeg, or png only.";
                        $_SESSION["icon"] = "error";

                        header("Location: ../viewAllAccounts.php");
                    }
                }
            } else {
                $_SESSION["status"] = "failed";
                $_SESSION["title"] = "Register Failed";
                $_SESSION["text"] = "The username you entered is already exist, please try another.";
                $_SESSION["icon"] = "error";
        
                header("Location: ../viewAllAccounts.php");
            }
        }
    } else {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Captcha Failed";
        $_SESSION["text"] = "Invalid captcha, please try again.";
        $_SESSION["icon"] = "warning";

        header("Location: ../viewAllAccounts.php");
    }

    mysqli_close($con);
?>
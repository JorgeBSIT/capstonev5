<?php
    include "../php/connect.php";

    session_start();

    $id = $_POST["changeAccessId"];
    $changeAccountType = $_POST["currentLevel"];

    $update = "UPDATE user_accounts SET account_type='$changeAccountType' WHERE id='$id'";
    $result = mysqli_query($con, $update);

    if (false == $result) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Change Access Failed";
        $_SESSION["text"] = "Please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../viewAllAccounts.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Change Access Successfully";
        $_SESSION["text"] = "You have successfully change the account level.";
        $_SESSION["icon"] = "success";

        header("Location: ../viewAllAccounts.php");
    }
?>
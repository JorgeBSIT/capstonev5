<?php
    include "../php/connect.php";

    session_start();

    $id = $_POST["activeId"];

    $update = "UPDATE user_accounts SET status='active' WHERE id='$id'";
    $result = mysqli_query($con, $update);

    if (false == $result) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Activation Failed";
        $_SESSION["text"] = "Please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../viewAllAccounts.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Activated Successfully";
        $_SESSION["text"] = "You have successfully activated the account.";
        $_SESSION["icon"] = "success";

        header("Location: ../viewAllAccounts.php");
    }
?>
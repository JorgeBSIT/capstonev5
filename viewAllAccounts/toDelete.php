<?php
    include "../php/connect.php";

    session_start();

    $id = $_POST["deleteId"];

    $delete = "DELETE FROM user_accounts WHERE id='$id'";
    $result = mysqli_query($con, $delete);

    if (false == $result) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Delete Failed";
        $_SESSION["text"] = "Please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../viewAllAccounts.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Deleted Successfully";
        $_SESSION["text"] = "You have successfully deleted the account level.";
        $_SESSION["icon"] = "success";

        header("Location: ../viewAllAccounts.php");
    }
?>
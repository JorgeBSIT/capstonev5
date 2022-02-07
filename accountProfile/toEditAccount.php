<?php
    include '../php/connect.php';

    session_start();

    $accountId = $_POST["accountId"];
    $accountType = trim($_POST["accountType"]);
    $fname = trim(strtolower($_POST["fname"]));
    $mname = trim(strtolower($_POST["mname"]));
    $lname = trim(strtolower($_POST["lname"]));
    $contact = trim($_POST["contact"]);
    $birth_date = $_POST["birth_date"];
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if ($password == null) {
        $update = "UPDATE user_accounts SET account_type='$accountType', fname='$fname', mname='$mname', lname='$lname', contact='$contact', birth_date='$birth_date', username='$username' WHERE id='$_COOKIE[id]'";
        $result = mysqli_query($con, $update);

        // setcookie("fname", $fname, time() + (86400 * 30), "/", "", 0);
        // setcookie("lname", $lname, time() + (86400 * 30), "/", "", 0);
        // setcookie("mname", $mname, time() + (86400 * 30), "/", "", 0);
        // setcookie("username", $username, time() + (86400 * 30), "/", "", 0);
        // setcookie("password", $password, time() + (86400 * 30), "/", "", 0);

    } else {
        $password = sha1($_POST['password']);

        $update = "UPDATE user_accounts SET account_type='$accountType', fname='$fname', mname='$mname', lname='$lname', contact='$contact', birth_date='$birth_date', username='$username', password='$password' WHERE id='$_COOKIE[id]'";
        $result = mysqli_query($con, $update);
    }

    if (false === $result) {
        $_SESSION["status"] = "failed";
        $_SESSION["title"] = "Edit Failed";
        $_SESSION["text"] = "Please try again.";
        $_SESSION["icon"] = "error";

        header("Location: ../accountProfile.php");
    } else {
        $_SESSION["status"] = "success";
        $_SESSION["title"] = "Edited Successfully";
        $_SESSION["text"] = "You have successfully edited your account.";
        $_SESSION["icon"] = "success";

        header("Refresh: 0; url=../accountProfile.php");
    }

    mysqli_close($con);
?>
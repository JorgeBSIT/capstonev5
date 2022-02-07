<?php
    include "../php/connect.php";

    session_start();

    $no_admin = true;

    $select = "SELECT * FROM user_accounts";
    $result = $con->query($select);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["account_type"] == "administrator") {
                $no_admin = false;
            }
        }
    }

    if($no_admin) {
        if ($_POST["username"] == "super_admin" && $_POST["password"] == "44gyKdy9") {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
    
            setcookie("account_type", "administrator", time() + (86400 * 30), "/", "", 0);
            setcookie("id", "0", time() + (86400 * 30), "/", "", 0);
            setcookie("fname", "super", time() + (86400 * 30), "/", "", 0);
            setcookie("lname", "", time() + (86400 * 30), "/", "", 0);
            setcookie("mname", "admin", time() + (86400 * 30), "/", "", 0);
            setcookie("image", "super.jpg", time() + (86400 * 30), "/", "", 0);
            setcookie("username", $_SESSION["username"], time() + (86400 * 30), "/", "", 0);
            setcookie("password", $_SESSION["password"], time() + (86400 * 30), "/", "", 0);
    
            header("Location: ../dashboard.php");
        } else {
            $_SESSION["status"] = "failed";
            $_SESSION["title"] = "Login Failed";
            $_SESSION["text"] = "Invalid Username or Password, please try again.";
            $_SESSION["icon"] = "error";

            header("Location: ../index.php");
        }
    } else {
        if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {
            header("Location: ../dashboard.php");
        }

        $username = $_POST["username"];
        $password = sha1($_POST["password"]);
        $id;
        $fname;
        $mname;
        $lname;
        $image;

        $found = false;

        $select = "SELECT * FROM user_accounts WHERE username='$username' AND password='$password'";
        $result = $con->query($select);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $account_type = $row["account_type"];
                $id = $row["id"];
                $fname = $row["fname"];
                $lname = $row["lname"];
                $mname = $row["mname"];
                $image = $row["image"];
                $status = $row["status"];

                $found = true;
            }
        }

        if ($status == "block") {
            $_SESSION["status"] = "failed";
            $_SESSION["title"] = "Login Failed";
            $_SESSION["text"] = "This account has been ban, please contact your administartor.";
            $_SESSION["icon"] = "error";

            header("Location: ../index.php");
        } else if($found) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;

            setcookie("account_type", $account_type, time() + (86400 * 30), "/", "", 0);
            setcookie("id", $id, time() + (86400 * 30), "/", "", 0);
            setcookie("fname", $fname, time() + (86400 * 30), "/", "", 0);
            setcookie("lname", $lname, time() + (86400 * 30), "/", "", 0);
            setcookie("mname", $mname, time() + (86400 * 30), "/", "", 0);
            setcookie("image", $image, time() + (86400 * 30), "/", "", 0);
            setcookie("username", $_SESSION["username"], time() + (86400 * 30), "/", "", 0);
            setcookie("password", $_SESSION["password"], time() + (86400 * 30), "/", "", 0);

            header("Location: ../dashboard.php");
        } else {
            $_SESSION["status"] = "failed";
            $_SESSION["title"] = "Login Failed";
            $_SESSION["text"] = "Invalid Username or Password, please try again.";
            $_SESSION["icon"] = "error";

            header("Location: ../index.php");
        }
    }

    mysqli_close($con);
?>
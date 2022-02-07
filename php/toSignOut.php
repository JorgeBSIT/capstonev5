<?php
	session_start();
	session_unset();
	session_destroy();

    setcookie("account_type", "", time()- 60, "/", "", 0);
	setcookie("id", "", time()- 60, "/", "", 0);
	setcookie("fname", "", time()- 60, "/", "", 0);
    setcookie("mname", "", time()- 60, "/", "", 0);
	setcookie("lname", "", time()- 60, "/", "", 0);
    setcookie("image", "", time()- 60, "/", "", 0);
    setcookie("username", "", time()- 60, "/","", 0);
    setcookie("password", "", time()- 60, "/","", 0);
    
	header('Location: ../index.php');
?>
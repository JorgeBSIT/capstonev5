<?php
    function getAccountId() {
        $servername='localhost';
        $username='u581335818_capstonev5_db';
        $password='TBwK?U9i!9r';
        $dbname = "u581335818_capstonev5_db";

        $con = mysqli_connect($servername, $username, $password, $dbname);

        if(!$con){
            die('Could not Connect My Sql:' .mysql_error());
            exit();
        }

        $data = $_COOKIE["id"];
        $id = "";

        $select = "SELECT * FROM user_accounts WHERE id='$data'";
        $result = mysqli_query($con, $select);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
            }
        }

        echo $id;

        mysqli_close($con);
    }
?>
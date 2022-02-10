<?php
    header('Content-Type: application/json');

    include "../php/connect.php";

    $select = "SELECT * FROM test_tbl";
    $result = mysqli_query($con, $select);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

    mysqli_close($con);

    echo json_encode($data);
?>
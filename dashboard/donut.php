<?php
    header('Content-Type: application/json');

    include "../php/connect.php";

    $select = "SELECT name, SUM(distributed_quantity) AS Total FROM distributed_supply GROUP BY name";
    $result = mysqli_query($con, $select);

    $data = array();
    foreach ($result as $row) {
        $data[] = array(
            'name' => $row["name"],
            'total' => $row["Total"],
            'color' => '#' . rand(100000, 999999) . ''
        );
    }

    mysqli_close($con);

    echo json_encode($data);
?>
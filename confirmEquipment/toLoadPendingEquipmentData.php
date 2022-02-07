<?php
    $connect = mysqli_connect("localhost", "u581335818_capstonev5_db", "TBwK?U9i!9r", "u581335818_capstonev5_db");
    $output = '';

    if(isset($_POST["query"])) {
        $search = mysqli_real_escape_string($connect, $_POST["query"]);
        $query = "
        SELECT * FROM pending_equipment 
        WHERE distribution_no LIKE '%".$search."%'
        OR id LIKE '%".$search."%' 
        OR name LIKE '%".$search."%' 
        OR brand LIKE '%".$search."%' 
        OR distribution_date LIKE '%".$search."%'
        OR location LIKE '%".$search."%'
        OR distribution_quantity LIKE '%".$search."%'
        OR in_charge LIKE '%".$search."%'
        ";
    } else {
        $query = "
        SELECT * FROM pending_equipment ORDER BY name
        ";
    }

    $counter = 1;

    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) > 0) {
        $output .= '
            <div style="height: 500px;" class="overflow-scroll">
            <table class="table table-striped table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Distribution No</th>
                        <th scope="col">Equipment Id</th>
                        <th scope="col">Equipment Name</th>
                        <th scope="col">Equipment Brand</th>
                        <th scope="col">Description</th>
                        <th scope="col">Distributed Date</th>
                        <th scope="col">Location</th>
                        <th scope="col">Distributed Quantity</th>
                        <th scope="col">Person In Charge</th>
                        <th scope="col"></th>
                    </tr>
                </thead>';
                while($row = mysqli_fetch_array($result)) {
                $output .= '
                    <tr>
                        <th>'.$counter++.'</th>
                        <td class="distribution_no">'.$row["distribution_no"].'</td>
                        <td class="id">'.$row["id"].'</td>
                        <td class="name">'.$row["name"].'</td>
                        <td class="brand">'.$row["brand"].'</td>
                        <td class="description">'.$row["description"].'</td>
                        <td class="distribution_date">'.$row["distribution_date"].'</td>
                        <td class="location">'.$row["location"].'</td>
                        <td class="distribution_quantity">'.$row["distribution_quantity"].'</td>
                        <td class="in_charge">'.$row["in_charge"].'</td>
                        <td><button type="button" class="btnConfirm" data-bs-toggle="modal" data-bs-target="#confirmModal" style="background-color: green; color: white; border: none; border-radius: 2px; padding: 10px;">Confirm</button></td>';
                }
        echo $output;
    } else {
        echo "<div class='container d-flex justify-content-center'>
            <p class='fs-2'>Data Not Found.</p>
        </div>";
    }

    echo "<script src='confirmEquipment/getConfirmEquipmentData.js'></script>";
?>
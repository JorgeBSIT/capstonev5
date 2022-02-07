<?php
    $connect = mysqli_connect("localhost", "u581335818_capstonev5_db", "TBwK?U9i!9r", "u581335818_capstonev5_db");
    $output = '';

    if(isset($_POST["query"])) {
        $search = mysqli_real_escape_string($connect, $_POST["query"]);
        $query = "
        SELECT * FROM condemned_equipment 
        WHERE condemn_no LIKE '%".$search."%'
        OR distribution_no LIKE '%".$search."%' 
        OR id LIKE '%".$search."%' 
        OR name LIKE '%".$search."%' 
        OR brand LIKE '%".$search."%'
        OR date_distributed LIKE '%".$search."%'
        OR location LIKE '%".$search."%'
        OR in_charge LIKE '%".$search."%'
        OR condemn_date LIKE '%".$search."%'
        OR condemn_quantity LIKE '%".$search."%'
        OR confirmed_by LIKE '%".$search."%'
        OR status LIKE '%".$search."%'
        ";
    } else {
        $query = "
        SELECT * FROM condemned_equipment ORDER BY name
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
                    <th scope="col">Condemn No</th>
                    <th scope="col">Distribution No</th>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date Distributed</th>
                    <th scope="col">Location</th>
                    <th scope="col">In Charge</th>
                    <th scope="col">Condemned Date</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Confirmed By</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>';
            while($row = mysqli_fetch_array($result)) {
                $output .= '
                <tr>
                    <th>'.$counter++.'</th>
                    <td class="condemn_no">'.$row["condemn_no"].'</td>
                    <td class="distribution_no">'.$row["distribution_no"].'</td>
                    <td class="id">'.$row["id"].'</td>
                    <td class="name">'.$row["name"].'</td>
                    <td class="brand">'.$row["brand"].'</td>
                    <td class="description">'.$row["description"].'</td>
                    <td class="date_distributed">'.$row["date_distributed"].'</td>
                    <td class="location">'.$row["location"].'</td>
                    <td class="in_charge">'.$row["in_charge"].'</td>
                    <td class="condemn_date">'.$row["condemn_date"].'</td>
                    <td class="condemn_quantity">'.$row["condemn_quantity"].'</td>
                    <td class="confirmed_by">'.$row["confirmed_by"].'</td>
                    <td class="status">'.$row["status"].'</td>
                </tr>';
        }
        echo $output;
    } else {
        echo "<div class='container d-flex justify-content-center'>
            <p class='fs-2'>Data Not Found.</p>
        </div>";
    }
?>
<?php
    $servername='localhost';
    $username='u581335818_capstonev5_db';
	$password='TBwK?U9i!9r';
	$dbname = "u581335818_capstonev5_db";

    $output = '';

    $con = mysqli_connect($servername, $username, $password, $dbname);

    $counter = 1;

    $select = "SELECT * FROM cart_transfer_equipment";
    $result = mysqli_query($con, $select);

    if(mysqli_num_rows($result) > 0) {
        $output .= '
            <table class="table table-striped table-hover table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Distribution No</th>
                        <th scope="col">Equipment Id</th>
                        <th scope="col">Equipment Name</th>
                        <th scope="col">Equipment Brand</th>
                        <th scope="col">Description</th>
                        <th scope="col">Distribution Date</th>
                        <th scope="col">Location</th>
                        <th scope="col">Distribution Quantity</th>
                        <th scope="col">Previous in charge</th>
                        <th scope="col">Transfer Date</th>
                        <th scope="col">New in charge</th>
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
                        <td class="transferred_date">'.$row["transferred_date"].'</td>
                        <td class="p_in_charge">'.$row["p_in_charge"].'</td>';
            }
        echo $output;
    }

    mysqli_close($con);
?>
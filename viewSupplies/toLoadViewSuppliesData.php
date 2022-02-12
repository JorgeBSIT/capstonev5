<?php
    $connect = mysqli_connect("localhost", "u581335818_capstonev5_db", "TBwK?U9i!9r", "u581335818_capstonev5_db");
    $output = '';

    if(isset($_POST["query"])) {
        $search = mysqli_real_escape_string($connect, $_POST["query"]);
        $query = "
        SELECT * FROM supply_inventory 
        WHERE name LIKE '%".$search."%'
        OR id LIKE '%".$search."%' 
        OR brand LIKE '%".$search."%' 
        OR receivers_name LIKE '%".$search."%' 
        OR date_arrived LIKE '%".$search."%'
        ";
    } else {
        $query = "
        SELECT * FROM supply_inventory ORDER BY name
        ";
    }

    $counter = 1;

    $result = mysqli_query($connect, $query);

    if($_COOKIE["account_type"] == "administrator") {
        if(mysqli_num_rows($result) > 0) {
            $output .= '
                <div style="height: 500px;" class="overflow-scroll">
                <table class="table table-striped table-hover table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Supply Id</th>
                            <th scope="col">Supply Name</th>
                            <th scope="col">Supply Brand</th>
                            <th scope="col">Receiver\'s Name</th>
                            <th scope="col">Supply Unit</th>
                            <th scope="col">Supply Quantity</th>
                            <th scope="col">Date Arrived</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>';
                    while($row = mysqli_fetch_array($result)) {
                        if($row['quantity'] > 0) {
                            $output .= '
                            <tr>
                                <th>'.$counter++.'</th>
                                <td class="id">'.$row["id"].'</td>
                                <td class="name">'.$row["name"].'</td>
                                <td class="brand">'.$row["brand"].'</td>
                                <td class="receivers_name">'.$row["receivers_name"].'</td>
                                <td class="unit">'.$row["unit"].'</td>
                                <td class="quantity">'.$row["quantity"].'</td>
                                <td class="date_arrived">'.$row["date_arrived"].'</td>
                                <td class="description">'.$row["description"].'</td>

                                <td><button type="button" class="btnSelect" style="background-color: green; color: white; border: none; border-radius: 2px; padding: 10px;">Select</button></td>

                                <td><button type="button" class="btnEdit" data-bs-toggle="modal" data-bs-target="#editModal" style="background-color: #ff7a05; color: white; border: none; border-radius: 2px; padding: 10px;">Edit</button></td>

                                <td><button type="button" class="btnDelete" data-bs-toggle="modal" data-bs-target="#deleteModal" style="background-color: #b50505; color: white; border: none; border-radius: 2px; padding: 10px;">Delete</button></td>
                            </tr>';
                        }
                    }
            echo $output;
        } else {
            echo "<div class='container d-flex justify-content-center'>
                <p class='fs-2'>Data Not Found.</p>
            </div>";
        }
    } else {
        if(mysqli_num_rows($result) > 0) {
            $output .= '
                <div style="height: 500px;" class="overflow-scroll">
                <table class="table table-striped table-hover table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Supply Id</th>
                            <th scope="col">Supply Name</th>
                            <th scope="col">Supply Brand</th>
                            <th scope="col">Receiver\'s Name</th>
                            <th scope="col">Supply Unit</th>
                            <th scope="col">Supply Quantity</th>
                            <th scope="col">Date Arrived</th>
                            <th scope="col">Description</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>';
                    while($row = mysqli_fetch_array($result)) {
                        if($row['quantity'] > 0) {
                            $output .= '
                            <tr>
                                <th>'.$counter++.'</th>
                                <td class="id">'.$row["id"].'</td>
                                <td class="name">'.$row["name"].'</td>
                                <td class="brand">'.$row["brand"].'</td>
                                <td class="receivers_name">'.$row["receivers_name"].'</td>
                                <td class="unit">'.$row["unit"].'</td>
                                <td class="quantity">'.$row["quantity"].'</td>
                                <td class="date_arrived">'.$row["date_arrived"].'</td>
                                <td class="description">'.$row["description"].'</td>
                                <td><button type="button" class="btnSelect" style="background-color: green; color: white; border: none; border-radius: 2px; padding: 10px;">Select</button></td>
                            </tr>';
                        }
                    }
            echo $output;
        } else {
            echo "<div class='container d-flex justify-content-center'>
                <p class='fs-2'>Data Not Found.</p>
            </div>";
        }
    }

    echo "<script src='viewSupplies/edit.js'></script>";
    echo "<script src='viewSupplies/delete.js'></script>";
?>
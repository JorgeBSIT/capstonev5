<?php
    $connect = mysqli_connect("localhost", "u581335818_capstonev5_db", "TBwK?U9i!9r", "u581335818_capstonev5_db");
    $output = '';
    
    if(isset($_POST["query"])) {
        $search = mysqli_real_escape_string($connect, $_POST["query"]);
        $query = "
        SELECT * FROM user_accounts 
        WHERE id LIKE '%".$search."%'
        OR account_type LIKE '%".$search."%' 
        OR fname LIKE '%".$search."%'
        OR lname LIKE '%".$search."%'
        ";
    } else {
        $query = "SELECT * FROM user_accounts ORDER BY fname";
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
                    <th scope="col">Profile Picture</th>
                    <th scope="col">Id</th>
                    <th scope="col">Account Type</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>';
            while($row = mysqli_fetch_array($result)) {
                $output .= '
                    <tr>
                        <th>'.$counter++.'</th>
                        <td class="image">
                            <div class="container d-flex justify-content-center">
                                <img src="uploads/'.$row["image"].'" id="picture" class="img-thumbnail" alt="Profile Picture" style="width: 250px;">
                            </div>
                        </td>
                        <td class="id">'.$row["id"].'</td>
                        <td class="account_type">'.$row["account_type"].'</td>
                        <td class="fname">'.$row["fname"].'</td>
                        <td class="lname">'.$row["lname"].'</td>';
                if($row["status"] == "active") {
                    $output .= '
                        <td><button type="button" class="btnActive" data-bs-toggle="modal" data-bs-target="#activeModal" style="background-color: gray; color: white; border: none; border-radius: 2px; padding: 10px; width: 150px;" disabled>Active</button></td>

                        <td><button type="button" class="btnBlock" data-bs-toggle="modal" data-bs-target="#blockModal" style="background-color: #d45320; color: white; border: none; border-radius: 2px; padding: 10px; width: 150px;">Block</button></td>

                        <td><button type="button" class="btnChangeAccess" data-bs-toggle="modal" data-bs-target="#changeAccessModal" style="background-color: #0e0b9e; color: white; border: none; border-radius: 2px; padding: 10px; width: 150px;">Change Access</button></td>

                        <td><button type="button" class="btnDelete" data-bs-toggle="modal" data-bs-target="#deleteModal" style="background-color: red; color: white; border: none; border-radius: 2px; padding: 10px; width: 150px;">Delete</button></td>
                    </tr>
                    ';
                } else {
                    $output .= '
                        <td><button type="button" class="btnActive" data-bs-toggle="modal" data-bs-target="#activeModal" style="background-color: green; color: white; border: none; border-radius: 2px; padding: 10px; width: 150px;" >Active</button></td>

                        <td><button type="button" class="btnBlock" data-bs-toggle="modal" data-bs-target="#blockModal" style="background-color: gray; color: white; border: none; border-radius: 2px; padding: 10px; width: 150px;" disabled>Block</button></td>

                        <td><button type="button" class="btnChangeAccess" data-bs-toggle="modal" data-bs-target="#changeAccessModal" style="background-color: #0e0b9e; color: white; border: none; border-radius: 2px; padding: 10px; width: 150px;">Change Access</button></td>

                        <td><button type="button" class="btnDelete" data-bs-toggle="modal" data-bs-target="#deleteModal" style="background-color: red; color: white; border: none; border-radius: 2px; padding: 10px; width: 150px;">Delete</button></td>
                    </tr>';
                }
            }
        echo $output;
    } else {
        echo "<div class='container d-flex justify-content-center'>
            <p class='fs-2'>Data Not Found.</p>
        </div>";
    }

    echo "<script src='viewAllAccounts/setActivev3.js'></script>";
    echo "<script src='viewAllAccounts/setBlockv2.js'></script>";
    echo "<script src='viewAllAccounts/setChangeAccessv2.js'></script>";
    echo "<script src='viewAllAccounts/setDeletev2.js'></script>";
?>
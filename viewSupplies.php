<?php
	session_start();

	if(!isset($_SESSION["username"]) && !isset($_SESSION["password"]))
	{
        header('Location: viewSupplies.php');
        exit();
	}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Jquery -->
    <script src="lib/jquery-3.6.0.min.js"></script>
    <script src="lib/jquery.validate.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/9d1d9a82d2.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="img/icon.png">

    <title>View Supplies</title>
</head>
<body>
    <div class="container-fluid bg-dark">
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboard.php">
                    <div class="container-fluid">
                        <img class="img-fluid" src="img/bulsu-logo-navbar.png" alt="bulsu-logo">
                    </div>
                </a>

                <div class="d-flex justify-content-end mx-5">
                    <div class="dropdown pb-4 mt-4">
                        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php
                                if ($_COOKIE["password"] == "44gyKdy9") {
                                    echo "uploads/".$_COOKIE["image"]; 
                                } else {
                                    include "util/getUserImage.php"; getImage();
                                }
                            ?>" alt="user-image" width="60" height="60" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1" style="cursor: pointer"><?php echo $_COOKIE["username"] ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style="cursor: pointer;">
                            <?php
                                if ($_COOKIE["password"] != "44gyKdy9") {
                                    echo "<li><a class='dropdown-item' href='accountProfile.php'>Account Profile</a></li>";
                                }

                                if ($_COOKIE["account_type"] == "administrator") {
                                    echo "<li><a class='dropdown-item' href='viewAllAccounts.php'>View All Accounts</a></li>";
                                }
                            ?>
                            <?php
                                if ($_COOKIE["account_type"] == "administrator") {
                                    echo "<li><div class='dropdown-divider'></div></li>";
                                    echo "<li><a class='dropdown-item' href='confirmSupply.php'>Confirm Supply</a></li>";
                                    echo "<li><a class='dropdown-item' href='confirmEquipment.php'>Confirm Distribution</a></li>";
                                    echo "<li><a class='dropdown-item' href='confirmCondemn.php'>Confirm Condemn</a></li>";
                                    echo "<li><a class='dropdown-item' href='confirmTransfer.php'>Confirm Transfer</a></li>";
                                    echo "<li><div class='dropdown-divider'></div></li>";
                                }
                            ?>
                            <li><a class="dropdown-item" onclick="signOut()">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="row flex-nowrap border-top border-light">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark p-5">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-tachometer-alt fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="viewSupplies.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-box fs-2" style="color: #1c6cab;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: #1c6cab;">View Supplies</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="distributeEquipment.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-truck-loading fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">Distribute Equipment</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="condemnEquipment.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-trash-alt fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">Condemn Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="transferEquipment.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-exchange-alt fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">Transfer Equipment</span>
                        </a>
                    </li>
                    <li>
                        <a href="generateReport.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-clipboard-list fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">Generate Report</span>
                        </a>
                    </li>
                    <?php
                        if ($_COOKIE["account_type"] == "administrator") {
                            echo '<li>
                                    <a href="viewDemands.php" class="nav-link px-0 align-middle mb-3">
                                        <i class="fas fa-file-invoice fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">View Demands</span>
                                    </a>
                                </li>';
                        }
                    ?>
                    <li>
                        <a href="viewCondemned.php" class="nav-link px-0 align-middle mb-3">
                            <i class="fas fa-archive fs-2" style="color: white;"></i> <span class="ms-1 d-none d-sm-inline fs-5" style="color: white;">View Condemned</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col py-3">
            <h1>View Supplies</h1>
            <hr>
            
            <div class="container shadow-lg p-3 mb-5 bg-body rounded">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3"></div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="form-group">
                                    <img src="img/BULSU-LOGO.png" class="rounded mx-auto d-block" alt="bulsu-logo" style="width: 200px;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="search-box input-group mt-4">
                                    <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
                                    
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSupplyModal">Add Supply</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3"></div>
                    </div>
                </div>

                <div class="container mt-5 table-responsive" style="height: 600px;">
                    <div id="result">
                        
                    </div>
                </div>

                <div class="container d-flex justify-content-center mb-3">
                    <h2>Selected Supply</h2>
                </div>

                <div style="height: 500px;" class="overflow-scroll mb-3">
                    <table class="table table-striped table-hover table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Supply Id</th>
                                <th scope="col">Supply Name</th>
                                <th scope="col">Supply Brand</th>
                                <th scope="col">Supply Unit</th>
                                <th scope="col">Description</th>
                                <th scope="col">Supply Quantity</th>
                                <th scope="col">Distribution Date</th>
                                <th scope="col">Location</th>
                                <th scope="col">Distribution Quantity</th>
                                <th scope="col">Received By</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="selected-supply">

                        </tbody>
                    </table>
                </div>

                <div class="container">
                    <button type="button" id="done" style="background-color: gray; color: white; border: none; border-radius: 2px; padding: 10px;" disabled>submit</button>
                </div>
            </div>
        </div>  
    </div>

    <script src="lib/sweetalert.min.js"></script>
    <script src="script/signOut.js"></script>
    <script src="viewSupplies/loadViewSuppliesData.js"></script>
    <script>
        $(document).on("click", ".btnSelect", function () {
            var $id = $(this).closest("tr").find(".id").text();
            var $name = $(this).closest("tr").find(".name").text();
            var $brand = $(this).closest("tr").find(".brand").text();
            var $unit = $(this).closest("tr").find(".unit").text();
            var $quantity = $(this).closest("tr").find(".quantity").text();
            var $description = $(this).closest("tr").find(".description").text();

            $("#selected-supply").append("<tr><td class='id'>"+$id+"</td><td class='name'>"+$name+"</td><td class='brand'>"+$brand+"</td><td class='unit'>"+$unit+"</td><td class='description'>"+$description+"</td><td class='quantity'>"+$quantity+"</td><td><input type='date' class='distributed_date'></td><td><select class='location'><option value='' selected='true' disabled='disabled'>Select Destination</option><option value='' disabled='disabled'>Executeive Offices</option><option value='Office of the University President'>Office of the University President</option><option value='Office of the Executive Vice President'>Office of the Executive Vice President</option><option value='Office of the Vice President for Research, Development, and Extension'>Office of the Vice President for Research, Development, and Extension</option><option value='Office of the Vice President for Administration and Finance'>Office of the Vice President for Administration and Finance</option><option value='Office of the Vice President for Academic Affairs'>Office of the Vice President for Academic Affairs</option><option value='' disabled='disabled'>Dean\'s Office</option><option value='College of Architecture and Fine Arts'>College of Architecture and Fine Arts</option><option value='College of Arts and Letters'>College of Arts and Letters</option><option value='College of Business Administration'>College of Business Administration</option><option value='College of Communication and Information Technology'>College of Communication and Information Technology</option><option value='College of Criminal Justice Education'>College of Criminal Justice Education</option><option value='College of Education'>College of Education</option><option value='College of Engineering'>College of Engineering</option><option value='College of Hospitality and Tourism Management'>College of Hospitality and Tourism Management</option><option value='College of Industrial Technology'>College of Industrial Technology</option><option value='College of Law'>College of Law</option><option value='College of Nursing'>College of Nursing</option><option value='College of Science'>College of Science</option><option value='College of Social Sciences and Philosophy'>College of Social Sciences and Philosophy</option><option value='College of Sports, Exercise and Recreation'>College of Sports, Exercise and Recreation</option><option value='Graduate School'>Graduate School</option><option value='Laboratory High School'>Laboratory High School</option><option value='' disabled='disabled'>College Libraries</option><option value='College of Architecture and Fine Arts Library'>College of Architecture and Fine Arts Library</option><option value='College of Arts and Letters Library'>College of Arts and Letters Library</option><option value='College of Communication and Information Technology Library'>College of Communication and Information Technology Library</option><option value='College of Education Library'>College of Education Library</option><option value='College of Engineering Library'>College of Engineering Library</option><option value='College of Hospitality and Tourism Management Library'>College of Hospitality and Tourism Management Library</option><option value='College of Industrial Technology Library'>College of Industrial Technology Library</option><option value='College of Law Library'>College of Law Library</option><option value='College of Nursing Library'>College of Nursing Library</option><option value='College of Science Library'>College of Science Library</option><option value='College of Social Sciences and Philosophy Library'>College of Social Sciences and Philosophy Library</option><option value='Graduate School Library'>Graduate School Library</option><option value='' disabled='disabled'>Bulsu Offices</option><option value='Accounting'>Accounting</option><option value='Admission'>Admission</option><option value='Alumni'>Alumni</option><option value='Budget Office'>Budget Office</option><option value='Cashier'>Cashier</option><option value='Center for Bulacan Studies'>Center for Bulacan Studies</option><option value='Central Receiving Unit (Operator)'>Central Receiving Unit (Operator)</option><option value='Chancellor - Main'>Chancellor - Main</option><option value='Chief Admin Officer'>Chief Admin Officer</option><option value='Chief Finance Officer'>Chief Finance Officer</option><option value='Clinic'>Clinic</option><option value='Communications Office'>Communications Office</option><option value='Confucius Institute'>Confucius Institute</option><option value='Electrical Office'>Electrical Office</option><option value='Extension Office'>Extension Office</option><option value='Food Testing Lab'>Food Testing Lab</option><option value='Gate 1'>Gate 1</option><option value='General Services - Facilities Management and Maintenance Office (FMMO)'>General Services - Facilities Management and Maintenance Office (FMMO)</option><option value='Guidance Center'>Guidance Center</option><option value='Hostel'>Hostel</option><option value='Hostel Annex'>Hostel Annex</option><option value='Human Resource Management Office (HRMO) - Payroll'>Human Resource Management Office (HRMO) - Payroll</option><option value='Management Information System (MIS)'>Management Information System (MIS)</option><option value='National Service Training Program (NSTP)'>National Service Training Program (NSTP)</option><option value='Planning and Information'>Planning and Information</option><option value='Procurement Office (BAC)'>Procurement Office (BAC)</option><option value='Project Management Office (PMO)'>Project Management Office (PMO)</option><option value='Public Assistance Desk (Admin)'>Public Assistance Desk (Admin)</option><option value='Records Office'>Records Office</option><option value='Registrar\'s Office'>Registrar\'s Office</option><option value='Research Office'>Research Office</option><option value='Scholarship Office'>Scholarship Office</option><option value='Sports Director - Valencia Hall'>Sports Director - Valencia Hall</option><option value='Student Organization'>Student Organization</option><option value='Student Publication'>Student Publication</option><option value='Supply Office'>Supply Office</option><option value='' disabled='disabled'>Satellite Campus</option> <option value='Bustos Campus'>Bustos Campus</option><option value='Hagonoy Campus'>Hagonoy Campus</option><option value='Meneses Campus'>Meneses Campus</option><option value='Pulilan Extension'>Pulilan Extension</option><option value='Sarmiento Campus'>Sarmiento Campus</option></select></td><td><input type='number' class='distribution_quantity'></td><td><input type='text' class='received_by'></td><td><button type='button' class='btnRemove' style='background-color: #b50505; color: white; border: none; border-radius: 2px; padding: 10px;'>Remove</button></td></tr>");

            $("#done").removeAttr("disabled");
            $("#done").css("background-color", "green");
        });
    </script>

    <script>    
        $(document).on("click", ".btnRemove", function (){
            $(this).closest("tr").remove();

            if($("#table-body").children().length <= 0) {
                $("#done").prop("disabled", true);
                $("#done").css("background-color", "gray");
            }
        });
    </script>

    <script>
        $(document).on("click", "#done", function () {
            var arr_id = [];
            var arr_name = [];
            var arr_brand = [];
            var arr_unit = [];
            var arr_description = [];
            var arr_quantity = [];
            var arr_distributed_date = [];
            var arr_location = [];
            var arr_distribution_quantity = [];
            var arr_received_by = [];

            $('#selected-supply tr').each(function (a, b) {
                var id = $('.id', b).text();
                var name = $('.name', b).text();
                var brand = $('.brand', b).text();
                var unit = $(".unit", b).text();
                var description = $(".description", b).text();
                var quantity = $(".quantity", b).text();
                var distributed_date = $(".distributed_date", b).val();
                var location = $(".location", b).val();
                var distribution_quantity = $(".distribution_quantity", b).val();
                var received_by = $(".received_by", b).val();

                if(id != "") {
                    arr_id.push(id);
                    arr_name.push(name);
                    arr_brand.push(brand);
                    arr_unit.push(unit);
                    arr_description.push(description);
                    arr_quantity.push(quantity);
                    arr_distributed_date.push(distributed_date);
                    arr_location.push(location);
                    arr_distribution_quantity.push(distribution_quantity);
                    arr_received_by.push(received_by);
                }

                // for(var i = 0; i < arr_id.length; i++) {
                //     console.log(arr_id[i] + " " + arr_name[i] + " " + arr_brand[i] + " " + arr_unit[i] + " " + arr_distributed_date[i] + " " + arr_quantity[i] + " " + arr_description[i] + " " + arr_location[i] + " " + arr_distribution_quantity[i] + " " + arr_received_by[i]);
                // }
            });

            $.ajax ({
                type: "POST",
                url: 'viewSupplies/toDistributeSupply.php',
                data: {
                    id: arr_id,
                    name: arr_name,
                    brand: arr_brand,
                    unit: arr_unit,
                    description: arr_description,
                    quantity: arr_quantity,
                    distributed_date: arr_distributed_date,
                    location: arr_location,
                    distribution_quantity: arr_distribution_quantity, 
                    received_by: arr_received_by
                },
                success: function(data) {
                    window.location.href = "reports/supplyReceipt.php";
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });
    </script>

    <script>
        function resetSupplyForm() {
            document.getElementById("add-supply").reset();
        }
    </script>
    <script>
        function changeUnit(e){
            document.getElementById("supply_unit_edit").value = e.target.value;
        }
    </script>
    <script>
        function changeUnit(e){
            document.getElementById("supply_unit_edit").value = e.target.value;
        }
    </script>
    <?php
        if(isset($_SESSION["status"]) && $_SESSION["status"] != "")
        {
        ?>
            <script>
                swal({
                    title: "<?php echo $_SESSION["title"] ?>",
                    text: "<?php echo $_SESSION["text"] ?>",
                    icon: "<?php echo $_SESSION["icon"] ?>",
                    button: "Okay",
                });
            </script>
        <?php
            unset($_SESSION["status"]);
            unset($_SESSION["title"]);
            unset($_SESSION["text"]);
            unset($_SESSION["icon"]);
        }
    ?>

    <style>
        .error {
            color: red;
            padding-top: 5px;
            padding-left: 10px;
        }
    </style>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
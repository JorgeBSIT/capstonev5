<?php
    session_start();

    if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
    {
        header('Location: dashboard.php');
        exit();
    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Jquery -->
    <script src="lib/jquery-3.6.0.min.js"></script>
    <script src="lib/jquery.validate.min.js"></script>

    <!-- Custom Css -->
    <style>
        body, html {
            height: 100%;
            background-color: rgba(19,46,72,255);
        }

        .bg {
            /* The image used */
            background-image: url("img/main-bg.png");

            /* Full height */
            height: 100%;
            width: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: repeat-y;
            background-size: cover;
        }
    </style>

    <link rel="icon" type="image/x-icon" href="img/icon.png">

    <title>Sign In</title>
</head>
<body>
    <div class="bg">
        <div class="row">
            <div class="col-sm-4"></div>

            <div class="col-sm-4">
                <div class="container opacity-75 d-flex justify-content-center" style="padding-top: 200px;">
                    <div class="container shadow p-3 mb-5 bg-body rounded" style="background-color: white; padding: 20px; border-radius: 0.5em;">
                        <div class="row m-3">
                            <img src="img/BULSU-LOGO.png" class="rounded mx-auto d-block" alt="Bulsu Logo" style="width: 200px;">
                        </div>

                        <div class="row">
                            <div class="container d-flex justify-content-center mb-3">
                                <h1>Sign-In</h1>
                            </div>
                        </div>

                        <form action="index/toSignIn.php" id="sign-in-form" method="POST">
                            <div class="container">
                                <div class="row">
                                    <div class="form-group mb-3">
                                        <input type="text" name="username" placeholder="Username" class="form-control form-cntrol-sm" id="username">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <input type="password" name="password" placeholder="Password" class="form-control form-cntrol-sm" id="password">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group mb-3">
                                        <button type="submit" name="submit" class="btn form-control form-control-sm btn btn-primary">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-4"></div>
        </div>
    </div>

    <script src="signin/validateSignIn.js"></script>
    <script src="lib/sweetalert.min.js"></script>
    
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
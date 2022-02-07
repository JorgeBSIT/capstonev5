<?php
    include "../php/connect.php";

    $delete = "DELETE FROM cart_transfer_equipment";
    $result = mysqli_query($con, $delete);

    mysqli_close($con);
?>
<?php
    include "../php/connect.php";

    $delete = "DELETE FROM cart_condemn_equipment";
    $result = mysqli_query($con, $delete);

    mysqli_close($con);
?>
<?php
    include "../php/connect.php";

    date_default_timezone_set("Asia/Kuala_Lumpur");

    $arr_name_temp_previous_2 = [];
    $arr_qty_temp_previous_2 = [];
    $arr_unit_temp_previous_2 = [];
    $index = 0;

    // GET THE CURRENT YEAR DATA FROM distributed_supply TABLE
    $dt = new DateTime(date("Y-m-d"));
    $year = $dt->format("Y");
    $year = $year - 2;

    $select = "SELECT * FROM distributed_supply ORDER BY name";
    $result = mysqli_query($con, $select);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $dt = new DateTime($row["distributed_date"]);
            $getCurrentYear = $dt->format("Y");

            if($year == $getCurrentYear) {
                $arr_name_temp_previous_2[$index] = $row["name"];
                $arr_qty_temp_previous_2[$index] = $row["distributed_quantity"];
                $arr_unit_temp_previous_2[$index] = $row["unit"];
                $index++;
            }
        }
    }

    // echo "LAST LAST YEAR DATA<br>";
    // for($i = 0; $i < count($arr_name_temp_previous_2); $i++) {
    //     echo $arr_name_temp_previous_2[$i] . " - " . $arr_qty_temp_previous_2[$i] . " - " . $arr_unit_temp_previous_2[$i] . "<br>";
    // }

    echo "<br>";

    $arr_name_previous_2 = [];
    $arr_qty_previous_2 = [];
    $arr_unit_previous_2 = [];

    // INITIALIZE THE ARRAYS
    for($i = 0; $i < count($arr_name_temp_previous_2); $i++) {
        $arr_name_previous_2[$i] = " ";
        $arr_qty_previous_2[$i] = 0;
        $arr_unit_previous_2[$i] = " ";
    }

    // FILTER THE DATA AND COMBINE ALL NAMES WITH EACH OTHER
    $occurence = 1;

    for($i = 0; $i < count($arr_name_temp_previous_2); $i++) {
        for($j = 0; $j < count($arr_name_temp_previous_2); $j++) {
            if($arr_name_temp_previous_2[$i] == $arr_name_previous_2[$j]) {
                $occurence++;
            }
        }

        if($occurence <= 1) {
            $arr_name_previous_2[$i] = $arr_name_temp_previous_2[$i];
            $arr_unit_previous_2[$i] = $arr_unit_temp_previous_2[$i];
        }

        $occurence = 1;
    }

    // COMPUTE THE TOTAL OF ALL DIFFERENT SUPPLIES
    for($i = 0; $i < count($arr_qty_temp_previous_2); $i++) {
        for($j = 0; $j < count($arr_qty_temp_previous_2); $j++) {
            if($arr_name_previous_2[$i] == $arr_name_temp_previous_2[$j]) {
                $arr_qty_previous_2[$i] = $arr_qty_previous_2[$i] + $arr_qty_temp_previous_2[$j];
            }
        }
    }

    $arr_name_previous_2_final = [];
    $arr_qty_previous_2_final = [];
    $arr_unit_previous_2_final = [];
    $index = 0;

    // REMOVE THE EMPTY SPACES AND ZEROES
    for($i = 0; $i < count($arr_name_previous_2); $i++) {
        if($arr_name_previous_2[$i] != " ") {
            $arr_name_previous_2_final[$index] = $arr_name_previous_2[$i];
            $arr_qty_previous_2_final[$index] = $arr_qty_previous_2[$i];
            $arr_unit_previous_2_final[$index] = $arr_unit_previous_2[$i];
            $index++;
        }
    }

    echo "TOTAL LAST LAST YEAR<br>";
    for($i = 0; $i < count($arr_name_previous_2_final); $i++) {
        echo $arr_name_previous_2_final[$i] . " - " . $arr_qty_previous_2_final[$i] . " - " . $arr_unit_previous_2_final[$i] . "<br>";
    }

    echo "<br>";

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $arr_name_temp_previous_1 = [];
    $arr_qty_temp_previous_1 = [];
    $arr_unit_temp_previous_1 = [];
    $index = 0;

    // GET THE CURRENT YEAR DATA FROM distributed_supply TABLE
    $dt = new DateTime(date("Y-m-d"));
    $year = $dt->format("Y");
    $year = $year - 1;

    $select = "SELECT * FROM distributed_supply ORDER BY name";
    $result = mysqli_query($con, $select);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $dt = new DateTime($row["distributed_date"]);
            $getCurrentYear = $dt->format("Y");

            if($year == $getCurrentYear) {
                $arr_name_temp_previous_1[$index] = $row["name"];
                $arr_qty_temp_previous_1[$index] = $row["distributed_quantity"];
                $arr_unit_temp_previous_1[$index] = $row["unit"];
                $index++;
            }
        }
    }

    // echo "LAST YEAR DATA<br>";
    // for($i = 0; $i < count($arr_name_temp_previous_1); $i++) {
    //     echo $arr_name_temp_previous_1[$i] . " - " . $arr_qty_temp_previous_1[$i] . " - " . $arr_unit_temp_previous_1[$i] . "<br>";
    // }

    echo "<br>";

    $arr_name_previous_1 = [];
    $arr_qty_previous_1 = [];
    $arr_unit_previous_1 = [];

    // INITIALIZE THE ARRAYS
    for($i = 0; $i < count($arr_name_temp_previous_1); $i++) {
        $arr_name_previous_1[$i] = " ";
        $arr_qty_previous_1[$i] = 0;
        $arr_unit_previous_1[$i] = " ";
    }

    // FILTER THE DATA AND COMBINE ALL NAMES WITH EACH OTHER
    $occurence = 1;

    for($i = 0; $i < count($arr_name_temp_previous_1); $i++) {
        for($j = 0; $j < count($arr_name_temp_previous_1); $j++) {
            if($arr_name_temp_previous_1[$i] == $arr_name_previous_1[$j]) {
                $occurence++;
            }
        }

        if($occurence <= 1) {
            $arr_name_previous_1[$i] = $arr_name_temp_previous_1[$i];
            $arr_unit_previous_1[$i] = $arr_unit_temp_previous_1[$i];
        }

        $occurence = 1;
    }

    // COMPUTE THE TOTAL OF ALL DIFFERENT SUPPLIES
    for($i = 0; $i < count($arr_qty_temp_previous_1); $i++) {
        for($j = 0; $j < count($arr_qty_temp_previous_1); $j++) {
            if($arr_name_previous_1[$i] == $arr_name_temp_previous_1[$j]) {
                $arr_qty_previous_1[$i] = $arr_qty_previous_1[$i] + $arr_qty_temp_previous_1[$j];
            }
        }
    }

    $arr_name_previous_1_final = [];
    $arr_qty_previous_1_final = [];
    $arr_unit_previous_1_final = [];
    $index = 0;

    // REMOVE THE EMPTY SPACES AND ZEROES
    for($i = 0; $i < count($arr_name_previous_1); $i++) {
        if($arr_name_previous_1[$i] != " ") {
            $arr_name_previous_1_final[$index] = $arr_name_previous_1[$i];
            $arr_qty_previous_1_final[$index] = $arr_qty_previous_1[$i];
            $arr_unit_previous_1_final[$index] = $arr_unit_previous_1[$i];
            $index++;
        }
    }

    echo "TOTAL LAST YEAR<br>";
    for($i = 0; $i < count($arr_name_previous_1_final); $i++) {
        echo $arr_name_previous_1_final[$i] . " - " . $arr_qty_previous_1_final[$i] . " - " . $arr_unit_previous_1_final[$i] . "<br>";
    }

    echo "<br>";

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $arr_name_temp_current = [];
    $arr_qty_temp_current = [];
    $arr_unit_temp_current = [];
    $index = 0;

    // GET THE CURRENT YEAR DATA FROM distributed_supply TABLE
    $dt = new DateTime(date("Y-m-d"));
    $year = $dt->format("Y");
    
    $select = "SELECT * FROM distributed_supply ORDER BY name";
    $result = mysqli_query($con, $select);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $dt = new DateTime($row["distributed_date"]);
            $getCurrentYear = $dt->format("Y");

            if($year == $getCurrentYear) {
                $arr_name_temp_current[$index] = $row["name"];
                $arr_qty_temp_current[$index] = $row["distributed_quantity"];
                $arr_unit_temp_current[$index] = $row["unit"];
                $index++;
            }
        }
    }

    // echo "CURRENT YEAR DATA<br>";
    // for($i = 0; $i < count($arr_name_temp_current); $i++) {
    //     echo $arr_name_temp_current[$i] . " - " . $arr_qty_temp_current[$i] . " - " . $arr_unit_temp_current[$i] . "<br>";
    // }

    echo "<br>";

    $arr_name_current = [];
    $arr_qty_current = [];
    $arr_unit_current = [];

    // INITIALIZE THE ARRAYS
    for($i = 0; $i < count($arr_name_temp_current); $i++) {
        $arr_name_current[$i] = " ";
        $arr_qty_current[$i] = 0;
        $arr_unit_current[$i] = " ";
    }

    // FILTER THE DATA AND COMBINE ALL NAMES WITH EACH OTHER
    $occurence = 1;

    for($i = 0; $i < count($arr_name_temp_current); $i++) {
        for($j = 0; $j < count($arr_name_temp_current); $j++) {
            if($arr_name_temp_current[$i] == $arr_name_current[$j]) {
                $occurence++;
            }
        }

        if($occurence <= 1) {
            $arr_name_current[$i] = $arr_name_temp_current[$i];
            $arr_unit_current[$i] = $arr_unit_temp_current[$i];
        }

        $occurence = 1;
    }

    // COMPUTE THE TOTAL OF ALL DIFFERENT SUPPLIES
    for($i = 0; $i < count($arr_qty_temp_current); $i++) {
        for($j = 0; $j < count($arr_qty_temp_current); $j++) {
            if($arr_name_current[$i] == $arr_name_temp_current[$j]) {
                $arr_qty_current[$i] = $arr_qty_current[$i] + $arr_qty_temp_current[$j];
            }
        }
    }

    $arr_name_current_final = [];
    $arr_qty_current_final = [];
    $arr_unit_current_final = [];
    $index = 0;

    // REMOVE THE EMPTY SPACES AND ZEROES
    for($i = 0; $i < count($arr_name_current); $i++) {
        if($arr_name_current[$i] != " ") {
            $arr_name_current_final[$index] = $arr_name_current[$i];
            $arr_qty_current_final[$index] = $arr_qty_current[$i];
            $arr_unit_current_final[$index] = $arr_unit_current[$i];
            $index++;
        }
    }

    echo "TOTAL CURRENT YEAR<br>";
    for($i = 0; $i < count($arr_name_current_final); $i++) {
        echo $arr_name_current_final[$i] . " - " . $arr_qty_current_final[$i] . " - " . $arr_unit_current_final[$i] . "<br>";
    }

    echo "<br>";

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    echo "DEMAND FORECASTING<br>";
    $arr_name_forecast_temp = [];
    $arr_qty_forecast_temp = [];
    $arr_unit_forecast_temp = [];
    $arr_range = [];

    for($i = 0; $i < count($arr_name_current_final); $i++) {
        $arr_range[$i] = 0;
        $arr_name_forecast_temp[$i] = "";
        $arr_qty_forecast_temp[$i] = 0;
        $arr_unit_forecast_temp[$i] = "";
    }

    for($i = 0; $i < count($arr_name_current_final); $i++) {
        for($j = 0; $j < count($arr_name_previous_1_final); $j++) {
            if($arr_name_current_final[$i] == $arr_name_previous_1_final[$j]) {
                for($k = 0; $k < count($arr_name_previous_2_final); $k++) {
                    if($arr_name_current_final[$i] == $arr_name_previous_2_final[$k]) {
                        $arr_name_forecast_temp[$i] =  $arr_name_current_final[$i];
                        $arr_unit_forecast_temp[$i] =  $arr_unit_current_final[$i];

                        $arr_qty_forecast_temp[$i] = ($arr_qty_previous_2_final[$k] + $arr_qty_previous_1_final[$j]) / 2;
                        $arr_qty_forecast_temp[$i] = abs($arr_qty_current_final[$i] - $arr_qty_forecast_temp[$i]) / 2;

                        if($arr_qty_forecast_temp[$i] <= 99) {
                            $arr_qty_forecast_temp[$i] = $arr_qty_forecast_temp[$i] / 10;
                            $arr_qty_forecast_temp[$i] = $arr_qty_forecast_temp[$i] / 2;
                        } else if($arr_qty_forecast_temp[$i] <= 999) {
                            $arr_qty_forecast_temp[$i] = $arr_qty_forecast_temp[$i] / 10;
                            $arr_qty_forecast_temp[$i] = $arr_qty_forecast_temp[$i] / 100;
                            $arr_qty_forecast_temp[$i] = $arr_qty_forecast_temp[$i] / 2;
                        }
        
                        if($arr_qty_forecast_temp[$i] <= 1.0 && $arr_qty_forecast_temp[$i] >= 0.90) {
                            $arr_range[$i] = 1.0;
                        } else if($arr_qty_forecast_temp[$i] <= 0.90 && $arr_qty_forecast_temp[$i] >= 0.80) {
                            $arr_range[$i] = 0.9;
                        } else if($arr_qty_forecast_temp[$i] <= 0.80 && $arr_qty_forecast_temp[$i] >= 0.70) {
                            $arr_range[$i] = 0.8;
                        } else if($arr_qty_forecast_temp[$i] <= 0.70 && $arr_qty_forecast_temp[$i] >= 0.60) {
                            $arr_range[$i] = 0.7;
                        } else if($arr_qty_forecast_temp[$i] <= 0.60 && $arr_qty_forecast_temp[$i] >= 0.50) {
                            $arr_range[$i] = 0.6;
                        } else if($arr_qty_forecast_temp[$i] <= 0.50 && $arr_qty_forecast_temp[$i] >= 0.40) {
                            $arr_range[$i] = 0.5;
                        } else if($arr_qty_forecast_temp[$i] <= 0.40 && $arr_qty_forecast_temp[$i] >= 0.30) {
                            $arr_range[$i] = 0.4;
                        } else if($arr_qty_forecast_temp[$i] <= 0.30 && $arr_qty_forecast_temp[$i] >= 0.20) {
                            $arr_range[$i] = 0.3;
                        } else if($arr_qty_forecast_temp[$i] <= 0.20 && $arr_qty_forecast_temp[$i] >= 0.10) {
                            $arr_range[$i] = 0.2;
                        } else if($arr_qty_forecast_temp[$i] <= 0.10 && $arr_qty_forecast_temp[$i] >= 0.01) {
                            $arr_range[$i] = 0.1;
                        } else {
                            $arr_range[$i] = 0;
                        }

                        $arr_qty_forecast_temp[$i] = ($arr_range[$i] * $arr_qty_current_final[$i]) + (1 - $arr_range[$i]) * ($arr_qty_previous_1_final[$j] + $arr_qty_previous_2_final[$k]);
                    }
                }
            }
        }
    }

    for($i = 0; $i < count($arr_name_forecast_temp); $i++) {
        echo $arr_name_forecast_temp[$i] . " - " . $arr_qty_forecast_temp[$i] . " - " . $arr_unit_forecast_temp[$i] . " - " . $arr_range[$i] . "<br>";
    }

    mysqli_close($con);
?>
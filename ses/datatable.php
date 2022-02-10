<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Jquery -->
    <script src="../lib/jquery-3.6.0.min.js"></script>
    <script src="../lib/jquery.validate.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Supply Id</th>
                <th scope="col">Supply Name</th>
                <th scope="col">Quantity</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
                include "../php/connect.php";

                $select = "SELECT * FROM test_tbl";
                $result = mysqli_query($con, $select);
                $counter = 1;

                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        echo "
                        <tr>
                            <th scope='row'>".$counter++."</th>
                            <td class='id'>".$row["id"]."</td>
                            <td class='name'>".$row["name"]."</td>
                            <td class='quantity'>".$row["qty"]."</td>
                            <td><button type='button' class='btnSelect'>Select</button></td>
 
                        ";
                    }
                }
            ?>
        </tbody>
    </table>

    <div style="height: 100px;"></div>

    <div class="container">
        <table class="table" id="selected-table">
            <thead>
                <tr>
                    <th scope="col">Supply Id</th>
                    <th scope="col">Supply Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="table-body">

            </tbody>
        </table>
    </div>

    <div style="height: 100px;"></div>

    <div class="container">
        <button type="button" id="done" disabled>submit</button>
    </div>

    <script>
        $(document).on("click", ".btnSelect", function () {
            var $id = $(this).closest("tr").find(".id").text();
            var $name = $(this).closest("tr").find(".name").text();
            var $quantity = $(this).closest("tr").find(".quantity").text();

            $("#table-body").append("<tr><td class='id'>"+$id+"</td><td class='name'>"+$name+"</td><td class='quantity'>"+$quantity+"</td><td><input type='number' class='qty'></td><td><button type='button' class='btnRemove'>Remove</button></td></tr>");

            $("#done").removeAttr("disabled");
        });
    </script>

    <script>
        $(document).on("click", ".btnRemove", function (){
            $(this).closest("tr").remove();

            if($("#table-body").children().length <= 0) {
                $("#done").prop("disabled", true);
            }
        });
    </script>

    <script>
        $(document).on("click", "#done", function () {
            var arr_id = [];
            var arr_name = [];
            var arr_quantity = [];
            var arr_qty = [];

            $('#selected-table tr').each(function (a, b) {
                var id = $('.id', b).text();
                var name = $('.name', b).text();
                var quantity = $('.quantity', b).text();
                var qty = $(".qty", b).val();

                if(id != "") {
                    arr_id.push(id);
                    arr_name.push(name);
                    arr_quantity.push(quantity);
                    arr_qty.push(qty);
                }
            });

            $.ajax ({
                type: "POST",
                url: 'add.php',
                data: {
                    id: arr_id,
                    name: arr_name,
                    quantity: arr_quantity,
                    qty: arr_qty,
                },
                success: function(data) {
                    console.log(data);
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });
    </script>

    <!--//////////////////////////////////////////////////////////////////////////////////////////-->

    <div class="chart-container pie-chart">
        <canvas id="bar_chart"></canvas>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <script>
    $(document).ready(function() {

        makechart();

        function makechart()
        {
            $.ajax({
                url:"aaa.php",
                method:"POST",
                data:{action:'fetch'},
                dataType:"JSON",
                success:function(data)
                {
                    var id = [];
                    var name = [];
                    var qty = [];
                    var color = [];

                    for(var i = 0; i < data.length; i++)
                    {
                        id.push(data[i].id);
                        name.push(data[i].name);
                        qty.push(data[i].qty);
                        color.push(data[i].color);
                    }

                    var chart_data = {
                        labels:name,
                        datasets:[
                            {
                                label:'Vote',
                                backgroundColor:color,
                                color:'#fff',
                                data:qty
                            }
                        ]
                    };

                    var options = {
                        responsive:true,
                        scales:{
                            yAxes:[{
                                ticks:{
                                    min:0
                                }
                            }]
                        }
                    };

                    var group_chart3 = $('#bar_chart');

                    var graph3 = new Chart(group_chart3, {
                        type:'bar',
                        data:chart_data,
                        options:options
                    });
                }
            })
        }
    });
    </script>

    <div style="height: 150px;"></div>

    <div class="chart-container pie-chart">
        <canvas id="doughnut_chart"></canvas>
    </div>

    <script>
    $(document).ready(function() {

        makechart();

        function makechart()
        {
            $.ajax({
                url:"aaa.php",
                method:"POST",
                data:{action:'fetch'},
                dataType:"JSON",
                success:function(data)
                {
                    var id = [];
                    var name = [];
                    var qty = [];
                    var color = [];

                    for(var i = 0; i < data.length; i++)
                    {
                        id.push(data[i].id);
                        name.push(data[i].name);
                        qty.push(data[i].qty);
                        color.push(data[i].color);
                    }

                    var chart_data = {
                        labels:name,
                        datasets:[
                            {
                                label:'Vote',
                                backgroundColor:color,
                                color:'#fff',
                                data:qty
                            }
                        ]
                    };

                    var options = {
                        responsive:true,
                        scales:{
                            yAxes:[{
                                ticks:{
                                    min:0
                                }
                            }]
                        }
                    };

                    var group_chart2 = $('#doughnut_chart');

                    var graph2 = new Chart(group_chart2, {
                        type:"doughnut",
                        data:chart_data
                    });
                }
            })
        }
    });
    </script>

    <div style="height: 150px;"></div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
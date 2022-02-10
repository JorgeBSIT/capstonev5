<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>
<body>
	<form action="" id="form-search">
	  	<input type="checkbox" name="vehicle" value="Bike"> I have a bike<br>
		<input type="checkbox" name="vehicle" value="Car"> I have a car<br>
		<input type="checkbox" name="vehicle" value="Boat"> I have a boat<br>
	</form>
	<button id="save" name="save">Serialize form values</button>

    <script>
        $(document).on('click','#save',function(e) {
            var vehicle = [];
            /*Initializing array with Checkbox checked values*/
            $("input[name='vehicle']:checked").each(function(){
                vehicle.push(this.value);
            });

            $.ajax({
                data:  {
                    vehicle: vehicle
                },
                type: "post",
                url: "test2.php",
                success: function(data){
                    console.log(data);
                }
            });
        });
    </script>
</body>
</html>
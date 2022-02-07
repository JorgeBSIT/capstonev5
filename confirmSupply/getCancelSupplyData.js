$(".btnCancel").click(function (){
    var $distribution_no = $(this).closest("tr").find(".distribution_no").text();
    var $id = $(this).closest("tr").find(".id").text();
    var $name = $(this).closest("tr").find(".name").text();
    var $brand = $(this).closest("tr").find(".brand").text();
    var $unit = $(this).closest("tr").find(".unit").text();
    var $description = $(this).closest("tr").find(".description").text();
    var $distributed_date = $(this).closest("tr").find(".distributed_date").text();
    var $location = $(this).closest("tr").find(".location").text();
    var $distributed_quantity = $(this).closest("tr").find(".distributed_quantity").text();
    var $received_by = $(this).closest("tr").find(".received_by").text();

    document.getElementById("supply_id_cancel").value = $id;
    document.getElementById("supply_name_cancel").value = $name;
    document.getElementById("supply_brand_cancel").value = $brand;
    document.getElementById("supply_unit_cancel").value = $unit;
    document.getElementById("supply_description_cancel").value = $description;
    document.getElementById("distribution_no_cancel").value = $distribution_no;
    document.getElementById("distribution_date_cancel").value = $distributed_date;
    document.getElementById("location_cancel").value = $location;
    document.getElementById("distribution_quantity_cancel").value = $distributed_quantity;
    document.getElementById("received_by_cancel").value = $received_by;
});
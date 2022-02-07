$(".btnDelete").click(function (){
    var $id = $(this).closest("tr").find(".id").text();
    var $name = $(this).closest("tr").find(".name").text();
    var $brand = $(this).closest("tr").find(".brand").text();
    var $receivers_name = $(this).closest("tr").find(".receivers_name").text();
    var $unit = $(this).closest("tr").find(".unit").text();
    var $quantity = $(this).closest("tr").find(".quantity").text();
    var $date_arrived = $(this).closest("tr").find(".date_arrived").text();
    var $description = $(this).closest("tr").find(".description").text();

    document.getElementById("supply_id_delete").value = $id;
    document.getElementById("supply_name_delete").value = $name;
    document.getElementById("supply_brand_delete").value = $brand;
    document.getElementById("supply_receivers_name_delete").value = $receivers_name;
    document.getElementById("supply_unit_delete").value = $unit;
    document.getElementById("supply_quantity_delete").value = $quantity;
    document.getElementById("supply_date_arrived_delete").value = $date_arrived;
    document.getElementById("supply_description_delete").value = $description;
});
$(".btnEdit").click(function (){
    var $id = $(this).closest("tr").find(".id").text();
    var $name = $(this).closest("tr").find(".name").text();
    var $brand = $(this).closest("tr").find(".brand").text();
    var $receivers_name = $(this).closest("tr").find(".receivers_name").text();
    var $unit = $(this).closest("tr").find(".unit").text();
    var $quantity = $(this).closest("tr").find(".quantity").text();
    var $date_arrived = $(this).closest("tr").find(".date_arrived").text();
    var $description = $(this).closest("tr").find(".description").text();

    document.getElementById("supply_id_edit").value = $id;
    document.getElementById("supply_name_edit").value = $name;
    document.getElementById("supply_brand_edit").value = $brand;
    document.getElementById("supply_receivers_name_edit").value = $receivers_name;
    document.getElementById("supply_unit_edit").value = $unit;
    document.getElementById("supply_quantity_edit").value = $quantity;
    document.getElementById("supply_date_arrived_edit").value = $date_arrived;
    document.getElementById("supply_description_edit").value = $description;
});
$(".btnSelect").click(function (){
    var $id = $(this).closest("tr").find(".id").text();
    var $name = $(this).closest("tr").find(".name").text();
    var $brand = $(this).closest("tr").find(".brand").text();
    var $receivers_name = $(this).closest("tr").find(".receivers_name").text();
    var $quantity = $(this).closest("tr").find(".quantity").text();
    var $date_arrived = $(this).closest("tr").find(".date_arrived").text();
    var $description = $(this).closest("tr").find(".description").text();

    document.getElementById("equipment_id_select").value = $id;
    document.getElementById("equipment_name_select").value = $name;
    document.getElementById("equipment_brand_select").value = $brand;
    document.getElementById("equipment_receivers_name_select").value = $receivers_name;
    document.getElementById("equipment_quantity_select").value = $quantity;
    document.getElementById("equipment_date_arrived_select").value = $date_arrived;
    document.getElementById("equipment_description_select").value = $description;
});
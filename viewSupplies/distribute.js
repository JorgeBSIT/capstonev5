$(".btnDistribute").click(function (){
    var $id = $(this).closest("tr").find(".id").text();
    var $name = $(this).closest("tr").find(".name").text();
    var $brand = $(this).closest("tr").find(".brand").text();
    var $unit = $(this).closest("tr").find(".unit").text();
    var $quantity = $(this).closest("tr").find(".quantity").text();
    var $description = $(this).closest("tr").find(".description").text();

    document.getElementById("supply_id_distribute").value = $id;
    document.getElementById("supply_name_distribute").value = $name;
    document.getElementById("supply_brand_distribute").value = $brand;
    document.getElementById("supply_unit_distribute").value = $unit;
    document.getElementById("supply_quantity_distribute").value = $quantity;
    document.getElementById("supply_description_distribute").value = $description;
});
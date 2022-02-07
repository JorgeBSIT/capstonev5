$(".btnSelect").click(function (){
    var $distribution_no = $(this).closest("tr").find(".distribution_no").text();
    var $id = $(this).closest("tr").find(".id").text();
    var $name = $(this).closest("tr").find(".name").text();
    var $brand = $(this).closest("tr").find(".brand").text();
    var $description = $(this).closest("tr").find(".description").text();
    var $distribution_date = $(this).closest("tr").find(".distribution_date").text();
    var $location = $(this).closest("tr").find(".location").text();
    var $distribution_quantity = $(this).closest("tr").find(".distribution_quantity").text();
    var $in_charge = $(this).closest("tr").find(".in_charge").text();

    document.getElementById("equipment_distribution_no_select").value = $distribution_no;
    document.getElementById("equipment_id_select").value = $id;
    document.getElementById("equipment_name_select").value = $name;
    document.getElementById("equipment_brand_select").value = $brand;
    document.getElementById("equipment_description_select").value = $description;
    document.getElementById("equipment_date_distribution_select").value = $distribution_date;
    document.getElementById("equipment_location_select").value = $location;
    document.getElementById("equipment_quantity_select").value = $distribution_quantity;
    document.getElementById("equipment_in_charge_select").value = $in_charge;
});
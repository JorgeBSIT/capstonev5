$(".btnConfirm").click(function (){
    var $distribution_no = $(this).closest("tr").find(".distribution_no").text();
    var $id = $(this).closest("tr").find(".id").text();
    var $name = $(this).closest("tr").find(".name").text();
    var $brand = $(this).closest("tr").find(".brand").text();
    var $description = $(this).closest("tr").find(".description").text();
    var $distributed_date = $(this).closest("tr").find(".distribution_date").text();
    var $location = $(this).closest("tr").find(".location").text();
    var $distributed_quantity = $(this).closest("tr").find(".distribution_quantity").text();
    var $in_charge = $(this).closest("tr").find(".in_charge").text();

    document.getElementById("equipment_id").value = $id;
    document.getElementById("equipment_name").value = $name;
    document.getElementById("equipment_brand").value = $brand;
    document.getElementById("equipment_description").value = $description;
    document.getElementById("distribution_no").value = $distribution_no;
    document.getElementById("distribution_date").value = $distributed_date;
    document.getElementById("location").value = $location;
    document.getElementById("distribution_quantity").value = $distributed_quantity;
    document.getElementById("in_charge").value = $in_charge;
});
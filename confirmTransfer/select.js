$(".btnConfirm").click(function (){
    var $distribution_no = $(this).closest("tr").find(".distribution_no").text();
    var $id = $(this).closest("tr").find(".id").text();
    var $name = $(this).closest("tr").find(".name").text();
    var $brand = $(this).closest("tr").find(".brand").text();
    var $description = $(this).closest("tr").find(".description").text();
    var $distribution_date = $(this).closest("tr").find(".distribution_date").text();
    var $location = $(this).closest("tr").find(".location").text();
    var $distribution_quantity = $(this).closest("tr").find(".distribution_quantity").text();
    var $in_charge = $(this).closest("tr").find(".in_charge").text();
    var $transferred_date = $(this).closest("tr").find(".transferred_date").text();
    var $p_in_charge = $(this).closest("tr").find(".p_in_charge").text();

    document.getElementById("distribution_no").value = $distribution_no;
    document.getElementById("id").value = $id;
    document.getElementById("name").value = $name;
    document.getElementById("brand").value = $brand;
    document.getElementById("description").value = $description;
    document.getElementById("distribution_date").value = $distribution_date;
    document.getElementById("location").value = $location;
    document.getElementById("distribution_quantity").value = $distribution_quantity;
    document.getElementById("in_charge").value = $in_charge;
    document.getElementById("transferred_date").value = $transferred_date;
    document.getElementById("p_in_charge").value = $p_in_charge;
});
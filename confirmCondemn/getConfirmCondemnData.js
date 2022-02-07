$(".btnConfirm").click(function (){
    var $condemn_no = $(this).closest("tr").find(".condemn_no").text();
    var $distribution_no = $(this).closest("tr").find(".distribution_no").text();
    var $id = $(this).closest("tr").find(".id").text();
    var $name = $(this).closest("tr").find(".name").text();
    var $brand = $(this).closest("tr").find(".brand").text();
    var $description = $(this).closest("tr").find(".description").text();
    var $date_distributed = $(this).closest("tr").find(".date_distributed").text();
    var $location = $(this).closest("tr").find(".location").text();
    var $in_charge = $(this).closest("tr").find(".in_charge").text();
    var $condemn_date = $(this).closest("tr").find(".condemn_date").text();
    var $condemn_quantity = $(this).closest("tr").find(".condemn_quantity").text();
    var $status = $(this).closest("tr").find(".status").text();

    document.getElementById("condemn_no").value = $condemn_no;
    document.getElementById("distribution_no").value = $distribution_no;
    document.getElementById("id").value = $id;
    document.getElementById("name").value = $name;
    document.getElementById("brand").value = $brand;
    document.getElementById("description").value = $description;
    document.getElementById("date_distributed").value = $date_distributed;
    document.getElementById("location").value = $location;
    document.getElementById("in_charge").value = $in_charge;
    document.getElementById("condemn_date").value = $condemn_date;
    document.getElementById("condemn_quantity").value = $condemn_quantity;
    document.getElementById("status").value = $status;
});
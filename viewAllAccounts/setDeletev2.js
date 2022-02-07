$(".btnDelete").click(function (){
    var $id = $(this).closest("tr").find(".id").text();
    var $fname = $(this).closest("tr").find(".fname").text();
    var $lname = $(this).closest("tr").find(".lname").text();

    document.getElementById("deleteId").value = $id;
    document.getElementById("deleteName").value = $fname + " " + $lname;
});
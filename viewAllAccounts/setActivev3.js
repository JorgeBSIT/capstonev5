$(".btnActive").click(function (){
    var $id = $(this).closest("tr").find(".id").text();
    var $fname = $(this).closest("tr").find(".fname").text();
    var $lname = $(this).closest("tr").find(".lname").text();

    document.getElementById("activeId").value = $id;
    document.getElementById("activeName").value = $fname + " " + $lname;
});
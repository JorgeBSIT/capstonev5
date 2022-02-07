$(".btnBlock").click(function (){
    var $id = $(this).closest("tr").find(".id").text();
    var $fname = $(this).closest("tr").find(".fname").text();
    var $lname = $(this).closest("tr").find(".lname").text();

    document.getElementById("blockId").value = $id;
    document.getElementById("blockName").value = $fname + " " + $lname;
});
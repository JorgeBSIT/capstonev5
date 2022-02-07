$(".btnChangeAccess").click(function (){
    var $id = $(this).closest("tr").find(".id").text();
    var $fname = $(this).closest("tr").find(".fname").text();
    var $lname = $(this).closest("tr").find(".lname").text();
    var $account_type = $(this).closest("tr").find(".account_type").text();

    document.getElementById("changeAccessId").value = $id;
    document.getElementById("changeAccessName").value = $fname + " " + $lname;
    document.getElementById("level").value = $account_type;
});
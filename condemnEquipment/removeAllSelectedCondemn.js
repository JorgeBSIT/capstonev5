function remove() {
    $.ajax({
        url: 'condemnEquipment/toRemoveAllSelectedCondemn.php',
        type: 'POST',
        dataType: "html",
        success: function (result) {
            $('#selected').html(result);
        },
        error: function () {
            console.log ('error');
        }
   });
}
 
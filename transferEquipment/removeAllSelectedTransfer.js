function remove() {
    $.ajax({
        url: 'transferEquipment/toRemoveAllSelectedTransfer.php',
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
 
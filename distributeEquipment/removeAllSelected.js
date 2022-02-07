function remove() {
    $.ajax({
      url: 'distributeEquipment/toRemoveAllSelected.php',
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
 
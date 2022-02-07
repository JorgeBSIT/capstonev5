$(document).ready(function (){
    $("#add-equipment").validate({
        rules: {
            equipmentId: {
                required: true
            },

            equipmentName: {
                required: true
            },

            equipmentBrand: {
                required: true
            },

            equipmentReceiversName: {
                required: true
            },

            equipmentQuantity: {
                required: true
            },

            equipmentDateArrived: {
                required: true
            }
        },

        messages: {
            equipmentId: "Please generate an Id number.",

            equipmentName: "Please enter the equipment name.",

            equipmentBrand: "Please enter equipment brand.",

            equipmentReceiversName: "Please enter the receiver's name.",

            equipmentQuantity: "Please enter the quantity of the equipment.",

            equipmentDateArrived: "Please enter the date the equipment arrived."
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});